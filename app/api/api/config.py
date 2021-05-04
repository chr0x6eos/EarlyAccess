from os import urandom
from decouple import config
from random import sample, randrange
from string import ascii_uppercase, digits

# Configuration
class FlaskConfig(object):
    """
    FlaskConfig class containing the Flask configuration

    ...

    - `DEBUG` ... Use for debugging errors
    - `SECRET_KEY` ... Key used to encrypt data
    """
    DEBUG = config('DEBUG') #True
    SECRET_KEY = urandom(32).hex()

def gen_magic():
    """
    Generates random magic number (Example: `XPAB9`)
    """
    magic_value = "XP"
    magic_num = sum(bytearray(magic_value.encode()))  
    magic_num += randrange(ord('A'),ord('Z'))
    magic_num += randrange(ord('P'),ord('Z')) # Fixed higher second char => Protect against fast bruteforce
    magic_num += randrange(ord('0'),ord('9'))
    return magic_num