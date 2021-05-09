FROM node:14

# Install dependencies
RUN apt-get update && apt-get install -y openssh-server curl openssl

# Enable ssh-key auth
RUN echo 'PubkeyAuthentication yes' >> /etc/ssh/sshd_config
RUN echo 'AuthorizedKeysFile .ssh/authorized_keys' >> /etc/ssh/sshd_config

# Expose SSH
EXPOSE 22

# Create game-adm user
RUN useradd -ms /bin/bash -p $(openssl passwd -salt $(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 10 | head -n 1) -crypt "gamemaster") game-adm

# Setup ssh
RUN mkdir -p /home/game-adm/.ssh
COPY game-server/authorized_keys  /home/game-adm/.ssh/authorized_keys

# Create app directory
WORKDIR /usr/src/app

# Create entrypoint dir
RUN mkdir - p /docker-entrypoint.d

# Execute all scripts in /entrypoint.sh
RUN echo '#!/bin/bash' > /entrypoint.sh
RUN echo 'for ep in /docker-entrypoint.d/*; do' >> /entrypoint.sh
RUN echo 'if [ -x "${ep}" ]; then' >> /entrypoint.sh
RUN echo '    echo "Running: ${ep}"' >> /entrypoint.sh
RUN echo '    "${ep}"' >> /entrypoint.sh
RUN echo '  fi' >> /entrypoint.sh
RUN echo 'done' >> /entrypoint.sh
RUN echo 'tail -f /dev/null' >> /entrypoint.sh
RUN chmod 754 /entrypoint.sh

# Expose port 9999
EXPOSE 9999

# Run server
ENTRYPOINT [ "/entrypoint.sh" ]