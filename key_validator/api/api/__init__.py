from api.config import FlaskConfig, gen_magic
from flask import Flask

app = Flask(__name__)
# Configure app
app.config.from_object(FlaskConfig)
app.config['magic_num'] = gen_magic()

# Load application
import api.routes # Main route handling