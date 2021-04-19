#!/usr/bin/env python3
from z3 import *
import itertools

# Get working key using z3
def genKey():
    # Length is 15
    key = [Int(c) for c in "AAAAA-BBBBB-CCCCC-DDDDD-EEEEE"]

    s = Solver()

    # Define - in key
    #ord("-") == 45
    s.add(key[5] == 45)
    s.add(key[11] == 45)
    s.add(key[17] == 45)
    s.add(key[23] == 45)

    # All chars alphanumeric
    for x in range(len(key)):
        if x not in [5,11,17,23]:
            s.add(key[x] > 47, key[x] < 91)

    # Add first group
    for a, b in itertools.combinations(range(0,4), 2):
        s.add(key[a] != key[b])

    # If s.check is true, solution was found
    if s.check():
        m = s.model()
        return "".join([chr(int(str(m[key[i]]))) for i in range(len(m))])
    else:
        return "No solutions found!"

if __name__ == "__main__":
    # Gen key
    print(genKey())