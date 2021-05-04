from api import app
from flask import request, Response

from api.helpers.validator import Key # Key verification
import api.helpers.response as resp # Respone-parsing
import api.helpers.auth as auth # Authenticate user
import api.helpers.docker as docker # Docker-API

@app.route('/', methods=['GET'])
def home():
    return resp.ok(msg='Welcome to the game-key verification API! You can verify your keys via: /verify/<game-key>. Admin users can verify the database using /check_db.')

@app.route('/verify/<string:key>', methods=['GET'])
def verify_key(key:str):
    try:
        validator = Key(key, app.config['magic_num'])
        if validator.check():
            return resp.ok('Key is valid!')
        else:
            return resp.error('Key is invalid!', status_code=422)
    except Exception as ex:
        return resp.error(f'Error occured: {ex}', status_code=500)

@app.route('/magic_num', methods=['GET'])
def get_magic():
    """
    Returns magic_num for synchronization
    """
    try:
        return resp.ok(f"magic_num: {app.config['magic_num']}")
    except Exception as ex:
        return resp.error(f'Error occurred: {ex}', status_code=500)

@app.route('/check_db', methods=['GET'])
def check_db():
    """
    Returns status of mysql-container
    """
    try:
        if 'Authorization' in request.headers:
            header = request.headers['Authorization']
            if header and auth.check(header):
                return resp.ok(docker.get_container("mysql").attrs)
        
        # Print error, if no success
        response = Response("Invalid HTTP-Auth!")
        response.headers['WWW-Authenticate'] = 'Basic'
        return response, 401
    except Exception as ex:
        return resp.error(f'Error occurred: {ex}', status_code=500)

@app.errorhandler(404)
def not_found(error=None):
    return resp.error(f'The requested URL was not found on the server.', status_code=404)