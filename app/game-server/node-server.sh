service ssh start

# Switch to game-adm user
su game-adm

# Run server
cd /usr/src/app

# Install dependencies
npm install

node server.js