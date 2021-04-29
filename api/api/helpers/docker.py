"""Docker-helper class
This script allows interaction with the Docker-API using Dockers Python-SDK\r\n
Available docker-container functions:
- all_containers() -> list ... Returns all containers
- get_container(key:str) -> docker.models.containers.Container ... Returns docker-container object
"""

import docker

# Initialize docker-handler
client = docker.from_env()

def all_containers() -> list:
    """
    Returns all containers on the server as a list
    """
    try:
        containers = client.containers.list()
        return [container.attrs for container in containers]
    except Exception as ex:
        raise Exception(f"Could not list all containers because of an error: {ex}!")

def get_container(key:str) -> docker.models.containers.Container:
    """
    Returns container identified by id (`key`) or name (`key`)
    """
    try:
        return client.containers.get(key)
    except:
        raise Exception(f"Could not find container {key}!")