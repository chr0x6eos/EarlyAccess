#!/usr/bin/env python3
from selenium import webdriver
from decouple import config
from selenium.webdriver.chrome.options import Options

class XSS:
    host = "https://earlyaccess.htb"
    driver = None
    _password = "" # Default value

    def __init__(self):
        self.driver = webdriver.Chrome('/usr/bin/chromedriver', options=self._set_chrome_options())
        self._password = config("ADMIN_PW")
        if self._password == "":
            raise Exception("No password for admin configured!")

    def _set_chrome_options(self):
        """Sets chrome options for Selenium.
        Chrome options for headless browser is enabled.
        """
        chrome_options = Options()
        #chrome_options.add_argument("--headless")
        chrome_options.add_argument("--no-sandbox")
        chrome_options.add_argument("--disable-dev-shm-usage")
        chrome_options.add_argument('--ignore-certificate-errors')
        chrome_prefs = {}
        chrome_options.experimental_options["prefs"] = chrome_prefs
        chrome_prefs["profile.default_content_settings"] = {"images": 2}
        return chrome_options

    def login(self, tries:int=0):
        try:
            # Max retries exceeded
            if tries > 3:
                raise Exception("Could not login!")
            
            self.driver.get(f"{self.host}/login")
            self.driver.find_element_by_name("email").send_keys("admin@earlyaccess.htb")
            self.driver.find_element_by_name("password").send_keys(self._password)
            self.driver.find_element_by_tag_name("button").click()
            
            return self.driver.current_url
            if self.driver.current_url != f"{self.host}/dashboard":
                tries = tries +1
                self.login(tries) # retry
            
            return self.driver.get_cookies()
        except Exception as ex:
            return ex

    def req(self, url:str):
        return self.driver.get(url)
    
    def close(self):
        self.driver.close()

if __name__ == "__main__":
    xss = XSS()
    print(xss.login())
