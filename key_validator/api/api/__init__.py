from api.config import FlaskConfig, gen_magic
from flask import Flask
from flask_apscheduler import APScheduler


app = Flask(__name__)
scheduler = APScheduler()

def update_magic():
    app.config['magic_num'] = gen_magic()

# Configure app
app.config.from_object(FlaskConfig)
update_magic()

# Update magic num every 30 minutes
scheduler.add_job(id='Generate magic', func=update_magic, trigger='interval', minutes=30)
scheduler.start()

# Load application
import api.routes # Main route handling