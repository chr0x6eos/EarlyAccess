#!/usr/bin/env python3
import sys
from time import sleep
from selenium import webdriver
from decouple import config
#from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.chrome.options import Options
from datetime import datetime

class AdminAutomation:
    host = 'https://earlyaccess.htb'
    driver = None
    _password = '' # Default value

    def __init__(self, password:str='', timeout:int=5):
        '''
        Initializes XSS python-class that access webpage as admin and reads all messages
        '''
        #service = Service('/usr/bin/chromedriver')
        self.driver = webdriver.Chrome('/usr/bin/chromedriver', options=self._set_chrome_options())
        self.driver.set_page_load_timeout(timeout) # define timeout

        #self._password = config('ADMIN_PW')
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
        chrome_options.add_argument('--headless')
        chrome_options.add_argument('--no-sandbox')
        chrome_options.add_argument('--disable-dev-shm-usage')
        chrome_options.add_argument('--ignore-certificate-errors')
        chrome_prefs = {}
        chrome_options.experimental_options['prefs'] = chrome_prefs
        chrome_prefs['profile.default_content_settings'] = {'images': 2}
        return chrome_options

    def login(self) -> bool:
        '''
        Login as admin
        - Returns: `True` if successful and `False` of unsuccessful
        '''
        try:           
            self.driver.get(f'{self.host}/login')
            self.driver.find_element_by_name('email').send_keys('admin@earlyaccess.htb')
            self.driver.find_element_by_name('password').send_keys(self._password)
            self.driver.find_element_by_tag_name('button').click()
            
            if self.driver.current_url != f'{self.host}/dashboard':
                return False
            
            print(f'[{datetime.now()}] Successfully logged in!\r\n')
            return True
        except Exception as ex:
            return ex

    def read_messages(self):
        '''
        Read all messages currently available to admin
        '''
        self.driver.get(f'{self.host}/messages/inbox')
        links = [element.get_attribute('href') for element in self.driver.find_elements_by_name('inbox-header')]
        err_links = [] # Add timeout links to array to access again later
        if len(links) > 0:
            for link in links:
                if link:
                    try:
                        self.driver.get(link) # Visit message

                        if self.driver.current_url == link:
                            print(f'[{datetime.now()}] Visit: {self.driver.current_url}\r\n')
                            
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
        try:
            try:
                # Check if we got redirected
                if self.driver.current_url != link:
                    return False # Got redirected, so no reply
                WebDriverWait(self.driver, 10).until(EC.presence_of_element_located((By.ID, 'reply')))
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
            self.driver.find_element_by_id('message').send_keys('We appreciate you contacting us.\r\n One of our colleagues has already read your message and is currently working on it! We will get back in touch with you soon. Have a great day!')
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

if __name__ == '__main__':
    try:
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
    except Exception as ex:
        print(f'[-] Error: {ex}')