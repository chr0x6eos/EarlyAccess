"""
Authenticates api user
"""
from base64 import b64encode

target_usr = "api"
target_pw = "s3CuR3_API_PW!"

def check(authorization_header:str) -> bool:
    """
    Gets `authorization_header` and verifies them against static credentials (`target_usr`:`target_pw`)
    """
    return b64encode(target_usr.encode() + b":" + target_pw.encode()).decode() == authorization_header.split()[-1]