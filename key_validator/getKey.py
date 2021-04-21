#!/usr/bin/env python3
import requests
import sys
import re
from string import ascii_uppercase, digits
from itertools import product
from time import sleep

def calc_checksum(key):
    groups = key.split('-')[:-1] # Last one is checksum
    return sum([sum(bytearray(group.encode())) for group in groups])

if __name__ == "__main__":
    if len(sys.argv) == 2:
        """
        Calc checksum instead of bf
        """
        key = sys.argv[1]
        print(calc_checksum(key))
        quit()

    quit()
    values = ascii_uppercase
    req = 0
    possible = product(values, repeat=2)

    for group3 in possible:
        for i in range(0, 10):
            test = "XP" + "".join(group3) + str(i)
            key = f"KEY01-0H0H0-{test}-GAME1-"
            checksum = calc_checksum(key)
            #print(f"[+] Calculated checksum: {checksum}")
            key += f"{checksum}"
            print(f"[*] Trying: {key}")
            req = req + 1
            if "Key is valid" in requests.get(f"http://localhost:8000/verify/{key}").text:
                print(f"Found valid key: {key}, with {req} requests!")
                quit()
            #if req % 5 == 0:
            #    sleep(.1)
