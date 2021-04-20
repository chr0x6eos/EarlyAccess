from api import app
from api.helpers.validator import Key # Key verification
import api.helpers.response as resp

@app.route('/', methods=['GET'])
def home():
    return resp.ok(msg='Welcome to the game-key verification API!')

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

@app.errorhandler(404)
def not_found(error=None):
    return resp.error(f'The requested URL was not found on the server.', status_code=404)