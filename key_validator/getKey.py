#!/usr/bin/env python3
import requests
import sys
import re
from string import ascii_uppercase, digits
from itertools import product
from time import sleep

def calc_checksum(key:str) -> int:
    groups = key.split('-')[:-1] # Last one is checksum
    return sum([sum(bytearray(group.encode())) for group in groups])

def calc_g3(magic_num:int, known:str="X"):
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

def calc_key(magic_num:int=-1, known:str="X") -> str:
    if magic_num == -1:
        if len(known) == 2:
            # Not set, so calc all possible keys
            for i in range(346, 405+1):
                group3 = calc_g3(magic_num=i, known=known)
                key = f"KEY01-0H0H0-{group3}-GAME1-"
                checksum = calc_checksum(key)
                key += str(checksum)
                print(f"Key for magic_num {i}: {key}")
            return ""
        else:
            # Not set, so calc all possible keys
            for i in range(331, 415+1):
                group3 = calc_g3(i)
                key = f"KEY01-0H0H0-{group3}-GAME1-"
                checksum = calc_checksum(key)
                key += str(checksum)
                print(f"Key for magic_num {i}: {key}")
            return ""
    else:
        group3 = calc_g3(magic_num)
        key = f"KEY01-0H0H0-{group3}-GAME1-"
        checksum = calc_checksum(key)
        key += str(checksum)
        return key

def bf_key():
    values = ascii_uppercase
    req = 0
    possible = product(values, repeat=2)

    for group3 in possible:
        for i in range(0, 10):
            test = "XP" + "".join(group3) + str(i)
            key = f"KEY01-0H0H0-{test}-GAME1-"
            checksum = calc_checksum(key)
            #print(f"[+] Calculated checksum: {checksum}")
            key += str(checksum)
            print(f"[*] Trying: {key}")
            req = req + 1
            if "Key is valid" in requests.get(f"http://localhost:8000/verify/{key}").text:
                print(f"Found valid key: {key}, with {req} requests!")
                quit()
            #if req % 5 == 0:
            #    sleep(.1)

if __name__ == "__main__":
    if len(sys.argv) == 2:
        """
        Calc checksum instead of bf
        """
        magic_num = int(sys.argv[1])
        print(calc_key(magic_num, known="XP"))
    else:
        print(calc_key(known="XP"))
