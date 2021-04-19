#!/usr/bin/env python3
import sys
from re import match

def usage() -> str:
    return (f"Usage: {sys.argv[0]} <game-key>")

def info() -> str:
    return f"""
    # Game-Key validator #

    Can be used to quickly verify the game-key of a user, if the API is down again.

    Keys look like the following:
    AAAAA-BBBBB-CCCCC-DDDDD-EEEEE

    {usage()}
    """

def valid_format(key:str) -> bool:
    """
    Returns True, if `key` is in the right format
    """
    key_format = r"^[A-Z0-9]{5}(-[A-Z0-9]{5}){4}$"
    return bool(match(key_format,key))

def calc_checksum(key:str) -> int:
    """
    Returns checksum of `key`
    """
    groups = key.split("-")[:-1] # Last one is checksum
    return sum([sum(bytearray(group.encode())) for group in groups]) % 256

def first_group_valid(key:str) -> bool:
    """
    Returns True, if first group of `key` is of format `KEY<NUM><NUM>` and characters are not repeating
    """
    group1 = key.split("-")[0]

    # Obfuscate check
    res = [(ord(value) << index+1) % 256 ^ ord(value) for index, value in enumerate(group1[0:3])]

    # First 3 chars are "KEY"
    if res != [221, 81, 145]:
        return False
    
    # Last 2 chars have to be INT
    for value in group1[3:]:
        try:
            int(value) # Check if 
        except:
            return False

    # Set removes duplicates
    return len(set(group1)) == len(group1)

def second_group_valid(key:str) -> bool:
    """
    Returns True, if second group's even and odd chars of have same sum
    """
    group2 = key.split("-")[1]
    p1 = group2[::2] # Index is even
    p2 = group2[1::2] # Index is odd

    return sum(bytearray(p1.encode())) == sum(bytearray(p2.encode()))

def third_group_valid(key:str):
    """
    Returns True, if third group of `key` has sum of 123
    """
    group3 = key.split("-")[2]
    return sum(bytearray(group3.encode())) % 256 == 123

def fourth_group_valid(key:str):
    """
    Returns True, if fourth group of `key` XORed with first group returns certain sequence [12, 4, 20, 117, 0]
    """
    return [ord(a) ^ ord(b) for a, b in zip(key.split("-")[0], key.split("-")[3])] == [12, 4, 20, 117, 0]

def checksum_valid(key:str):
    """
    Returns True, if fifth group (checksum-group) of `key` has same sum as all other groups combined
    """
    group5 = key.split("-")[-1]
    checksum = sum(bytearray(group5.encode())) % 256
    return calc_checksum(key) == checksum

def check_key(key:str) -> bool:
    """
    Returns True, if `key` is valid, otherwise it returns false
    """
    if not valid_format(key):
        print("Key format invalid!")
        return False

    if not first_group_valid(key):
        print("First group invalid!")
        return False

    if not second_group_valid(key):
        print("Second group invalid!")
        return False
    
    if not third_group_valid(key):
        print("Third group invalid!")
        return False

    if not fourth_group_valid(key):
        print("Fourth group invalid!")
        return False
    
    if not checksum_valid(key):
        print("Checksum invalid!")
        return False
    
    return True

if __name__ == "__main__":
    if len(sys.argv) < 2 or len(sys.argv) > 2:
        print(info())
        sys.exit(-1)
    
    key = sys.argv[1]

    if check_key(key):
        print(f"Entered key is valid!")
    else:
        print(f"Entered key is invalid!") 