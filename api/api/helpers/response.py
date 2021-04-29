from flask import Response, jsonify

# Return json response defined by input params
def ok(msg:str='OK', status_code:int=200) -> Response:
    """
    Returns flask.response defined by input parameters:(`data_key`, `data_value`, `msg` and `status_code`):
    - `data_key` defines the keyname of the supplied json-data (can be empty, if no additional data is to be supplied)
    - `data_value` defines the json-data
    - `msg_key` defines what name the message field should have
    - `msg` defines what content the message field should have
    - `status_code` defines the status code of the response
    """
    message = {'status' : status_code, 'message' : msg}
    resp = jsonify(message)
    resp.status_code = status_code
    return resp

# Returns json response with error as message
def error(error, status_code:int=500) -> Response:
    """
    Returns flask.response defined by input parameters (`error` and `status_code`):
    - `error` defines the error to be displayed
    - `status_code` defines the status code of the response
    """
    message = {'status' : status_code, 'message' : str(error)}
    resp = jsonify(message)
    resp.status_code = status_code
    return resp