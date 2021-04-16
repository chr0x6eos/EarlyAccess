#!/usr/bin/env python3
import sys
from time import sleep
from selenium import webdriver
from decouple import config
#from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from datetime import datetime

class AdminAutomation:
    host = "https://earlyaccess.htb"
    driver = None
    _password = "" # Default value

    def __init__(self, password:str=""):
        """
        Initializes XSS python-class that access webpage as admin and reads all messages
        """
        #service = Service('/usr/bin/chromedriver')
        self.driver = webdriver.Chrome('/usr/bin/chromedriver', options=self._set_chrome_options())

        #self._password = config("ADMIN_PW")
        self._password = password
        if self._password == "":
            raise Exception("No password for admin configured!")

    def _set_chrome_options(self):
        """
        Sets chrome options for Selenium:
        - headless browser is enabled
        - sandbox is disbaled
        - dev-shm usage is disabled
        - SSL certificate errors are ignored
        """
        chrome_options = Options()
        chrome_options.add_argument("--headless")
        chrome_options.add_argument("--no-sandbox")
        chrome_options.add_argument("--disable-dev-shm-usage")
        chrome_options.add_argument('--ignore-certificate-errors')
        chrome_prefs = {}
        chrome_options.experimental_options["prefs"] = chrome_prefs
        chrome_prefs["profile.default_content_settings"] = {"images": 2}
        return chrome_options

    def login(self) -> bool:
        """
        Login as admin
        - Returns: `True` if successful and `False` of unsuccessful
        """
        try:           
            self.driver.get(f"{self.host}/login")
            self.driver.find_element_by_name("email").send_keys("admin@earlyaccess.htb")
            self.driver.find_element_by_name("password").send_keys(self._password)
            self.driver.find_element_by_tag_name("button").click()
            
            if self.driver.current_url != f"{self.host}/dashboard":
                return False
            
            print(f"[{datetime.now()}] Successfully logged in!\r\n")
            return True
        except Exception as ex:
            return ex

    def read_messages(self):
        """
        Read all messages currently available to admin
        """
        self.driver.get(f"{self.host}/messages")
        links = [element.get_attribute('href') for element in self.driver.find_elements_by_name("inbox-header")]
        if len(links) > 0:
            for link in links:
                if link:
                    try:
                        self.driver.implicitly_wait(10) # Wait 10 seconds for visiting each message
                        self.driver.get(link) # Visit message
                        print(f"[{datetime.now()}] Visited: {self.driver.current_url}\r\n")
                    except Exception:
                        print(f"[{datetime.now()}] Error on: {self.driver.current_url}\r\n")
    
    def close(self):
        """
        Release driver resource
        """
        if self.driver:
            self.driver.close()

if __name__ == "__main__":
    try:
        if len(sys.argv) < 2:
            raise Exception("Specify a password!")
        admin = AdminAutomation(sys.argv[1])
        # Try to login
        tries = 0
        while not admin.login():
            if tries > 5:
                raise Exception("Could not login!")
            tries += 1
            sleep(1)
        # If login successful, visit all messages
        admin.read_messages()
        # Close webdriver
        admin.close()
        quit()
    except Exception as ex:
        print(f"[-] Error: {ex}")
