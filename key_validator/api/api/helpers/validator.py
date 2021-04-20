#!/usr/bin/env python3
import sys
from re import match

class Key:
    key = ""
    # Default value for group3 is XP000
    magic_value = "XP"
    magic_num = 312 # XP000

    def __init__(self, key:str, magic_num:int=0):
        self.key = key
        if magic_num != 0:
            self.magic_num = magic_num

    def _valid_format(self) -> bool:
        """
        Returns True, if `self.key` is in the right format
        """
        key_format = r"^[A-Z0-9]{5}(-[A-Z0-9]{5})(-[A-Z]{4}[0-9])(-[A-Z0-9]{5})(-[0-9]{1,5})$"
        return bool(match(key_format, self.key))

    def _calc_checksum(self) -> int:
        """
        Returns checksum of `self.key`
        """
        groups = self.key.split('-')[:-1] # Last one is checksum
        return sum([sum(bytearray(group.encode())) for group in groups])
    
    def _first_group_valid(self) -> bool:
        """
        Returns True, if first group of `self.key` is of format `self.key<NUM><NUM>` and characters are not repeating
        """
        group1 = self.key.split('-')[0]

        # Obfuscate check
        res = [(ord(value) << index+1) % 256 ^ ord(value) for index, value in enumerate(group1[0:3])]

        # First 3 chars are "self.key"
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

    def _second_group_valid(self) -> bool:
        """
        Returns True, if second group's even and odd chars have same sum
        """
        group2 = self.key.split('-')[1]
        p1 = group2[::2] # Index is even
        p2 = group2[1::2] # Index is odd

        return sum(bytearray(p1.encode())) == sum(bytearray(p2.encode()))
 
    def _third_group_valid(self):
        """
        Returns True, if third group of `self.key` has sum of `magic_num`, first 2 chars are `magic_value` and format is `magic_valueAA0`
        """
        group3 = self.key.split('-')[2]
        if group3[0:2] == self.magic_value:
            return sum(bytearray(group3.encode())) == self.magic_num
        else:
            return False
  
    def _fourth_group_valid(self):
        """
        Returns True, if fourth group of `self.key` XORed with first group returns certain sequence [12, 4, 20, 117, 0]
        """
        return [ord(a) ^ ord(b) for a, b in zip(self.key.split('-')[0], self.key.split('-')[3])] == [12, 4, 20, 117, 0]

    def _checksum_valid(self):
        """
        Returns True, if fifth group (checksum-group) of `self.key` has same sum as all other groups combined
        """
        checksum = int(self.key.split('-')[-1])
        return self._calc_checksum() == checksum

    def check(self) -> bool:
        """
        Returns True, if `self.key` is valid, otherwise it returns false
        """
        if not self._valid_format():
            raise Exception('Invalid key format!')

        if not self._first_group_valid():
            return False

        if not self._second_group_valid():
            return False
        
        if not self._third_group_valid():
            return False

        if not self._fourth_group_valid():
            return False
        
        if not self._checksum_valid():
            raise Exception('[Critical] Checksum verification failed!')
        
        return True