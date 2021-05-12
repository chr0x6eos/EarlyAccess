#!/usr/bin/env python3
import sys, requests
from os import system
from time import sleep
from bs4 import BeautifulSoup
from decouple import config
from datetime import datetime

# Selenium imports
from selenium import webdriver
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

# Ignore ssl-errors
import urllib3
urllib3.disable_warnings()

class AdminAutomation:
    host = 'https://earlyaccess.htb'
    driver = None
    _email = 'admin@earlyaccess.htb'
    _password = '' # Default value

    def __init__(self, password:str='', timeout:int=15):
        '''
        Initializes python-class that access webpage as admin and reads all messages to automatically trigger XSS
        '''
        caps = DesiredCapabilities().CHROME
        caps["pageLoadStrategy"] = "eager" # Don't wait for full page load

        self.driver = webdriver.Chrome('/usr/bin/chromedriver', desired_capabilities=caps, options=self._set_chrome_options())
        self.driver.set_page_load_timeout(timeout) # define timeout

        self._password = password
        if self._password == '':
            raise Exception('No password for admin configured!')

    def _set_chrome_options(self):
        '''
        Sets chrome options for Selenium:
        - headless browser is enabled
        - sandbox is disbaled
        - dev-shm usage is disabled
        - SSL certificate errors are ignored
        '''
        chrome_options = Options()
        
        options = [
        '--headless',
        '--no-sandbox', '--disable-dev-shm-usage', '--ignore-certificate-errors', 
        '--disable-extensions', '--no-first-run', '--disable-logging',
        '--disable-notifications', '--disable-permissions-api', '--hide-scrollbars',
        '--disable-gpu', '--window-size=800,600'
        ]

        # Setup all options
        for option in options:
            chrome_options.add_argument(option)
        chrome_prefs = {}
        chrome_options.experimental_options['prefs'] = chrome_prefs
        chrome_prefs['profile.default_content_settings'] = {'images': 2}
        return chrome_options

    def login(self) -> bool:
        '''
        Login as admin
        - Returns: `True` if successful and `False` of unsuccessful
        '''       
        self.driver.get(f'{self.host}/login')

        # Enter email
        WebDriverWait(self.driver, 10).until(EC.presence_of_element_located((By.NAME, 'email')))
        self.driver.find_element_by_name('email').send_keys('admin@earlyaccess.htb')
        
        # Enter password
        WebDriverWait(self.driver, 10).until(EC.presence_of_element_located((By.NAME, 'password')))
        self.driver.find_element_by_name('password').send_keys(self._password)
        
        # Submit using button
        WebDriverWait(self.driver, 10).until(EC.element_to_be_clickable((By.TAG_NAME, 'button')))
        self.driver.find_element_by_tag_name('button').click()
        
        # Verify that we got redirected
        if self.driver.current_url != f'{self.host}/dashboard':
            return False
        
        print(f'[{datetime.now()}] Successfully logged in!\r\n')
        return True

    def read_messages(self):
        '''
        Read all messages currently available to admin
        '''
        print(f'[{datetime.now()}] Checking messages...')
        self.driver.get(f'{self.host}/messages/inbox')

        links = [element.get_attribute('href') for element in self.driver.find_elements_by_name('inbox-header')]
        err_links = [] # Add timeout links to array to access again later
        if len(links) > 0:
            for link in links:
                if link:
                    try:
                        self.driver.get(link) # Visit message

                        if self.driver.current_url == link:
                            print(f'[{datetime.now()}] Visiting: {self.driver.current_url}\r\n')
                            
                            # Reply if not redirected
                            if self.reply(link):
                                print(f'[{datetime.now()}] Sent reply!')
                        else:
                            print(f'[{datetime.now()}] After visiting {link}, got redirect to: {self.driver.current_url}\r\n')
                    except Exception as ex:
                        '''Timeout or other exception occurred on url.
                        Add to err_links array to visiting again later.
                        This way one falty link does not stop the automation.
                        '''
                        print(f'[{datetime.now()}] Error after visiting: {link} (Current URL: {self.driver.current_url}). Error: {ex}\r\n')
                        err_links.append(link) # Retry after every other link is visited
        
        # Revisit links that caused errors again
        if len(err_links) > 0:
             for link in err_links:
                if link:
                    try:
                        self.driver.get(link) # Visit message
                        if self.driver.current_url == link:
                            print(f'[{datetime.now()}] Revisited: {self.driver.current_url}\r\n')

                            # Reply if not redirected
                            if self.reply(link):
                                print(f'[{datetime.now()}] Sent reply!')
                        else:
                            print(f'[{datetime.now()}] After revisiting {link}, got redirect to: {self.driver.current_url}\r\n')
                    except Exception as ex:
                        print(f'[{datetime.now()}] Error after revisiting: {link} (Current URL: {self.driver.current_url}). Error: {ex}\r\n')
                    
    def reply(self, link:str):
        '''
        Click on message (link) and if able, reply to message
        '''
        print(f'[{datetime.now()}] Trying to reply...')
        try:
            try:
                # Check if we got redirected
                if self.driver.current_url != link:
                    return False # Got redirected, so no reply
                
                WebDriverWait(self.driver, 10).until(EC.element_to_be_clickable((By.ID, 'reply')))
                self.driver.find_element_by_id('reply').click()

            except:
                return False
        
            WebDriverWait(self.driver, 10).until(EC.presence_of_element_located((By.ID, 'subject')))
            subject_element = self.driver.find_element_by_id('subject')

            # Do not reply twice
            if 'We have received your message!' in subject_element.get_attribute('value'):
                return False
            
            subject = 'We have received your message!'
            if subject_element.get_attribute('value') != '':
                subject = f' - {subject}'
            subject_element.send_keys(subject)
            
            WebDriverWait(self.driver, 10).until(EC.presence_of_element_located((By.ID, 'message')))
            self.driver.find_element_by_id('message').send_keys('We appreciate you contacting us.\r\n One of our colleagues has already read your message and is currently working on it! We will get back in touch with you soon. Have a great day!')

            WebDriverWait(self.driver, 10).until(EC.element_to_be_clickable((By.ID, 'contact')))
            self.driver.find_element_by_id('contact').click()

            return True
        except:
            return False

    def close(self):
        '''
        Release driver resource
        '''
        if self.driver:
            self.driver.close()
            self.driver.quit()
            self.driver = None

if __name__ == '__main__':
    # Kill all old (failed) processes -> cleanup
    system('pkill -f chrome')

    admin = None
    #try:
    if len(sys.argv) < 2:
        raise Exception('Specify a password!')
    admin = AdminAutomation(sys.argv[1])
    # Try to login
    tries = 0
    while not admin.login():
        if tries > 5:
            raise Exception('Could not login!')
        tries += 1
        sleep(1)
    # If login successful, visit all messages
    admin.read_messages()
    # Close webdriver
    admin.close()
    quit()
    """except Exception as ex:
        print(f'[-] Error: {ex}')
        # Clean exit, even on error
        if admin is not None:
            admin.close()
        quit()
    """