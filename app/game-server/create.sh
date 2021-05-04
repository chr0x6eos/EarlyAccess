#!/bin/bash
# Build image
docker build . -t game-server:latest

# Create service
docker service create -p 9999:9999 \
    --name game-server \
    --health-cmd='curl --silent --fail 127.0.0.1:9999 || exit 1' \
    --health-retries=3 \ # Retries to fail to be considered unhealthy and is restarted
    --health-interval=10s \ # Check container every X seconds
    --health-timeout=5s \ # If request takes longer than X seconds it is consider a fail
    game-server