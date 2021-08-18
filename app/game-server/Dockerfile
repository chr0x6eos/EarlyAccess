FROM node:14

# Install dependencies
RUN apt-get update && apt-get install -y openssh-server curl openssl sudo whois

# Enable ssh-key auth
RUN echo 'PubkeyAuthentication yes' >> /etc/ssh/sshd_config
RUN echo 'AuthorizedKeysFile .ssh/authorized_keys' >> /etc/ssh/sshd_config

# Expose SSH
EXPOSE 22

# Create game-tester user
RUN useradd -ms /bin/bash game-tester

# Create game-adm user
RUN useradd -ms /bin/bash -p $(mkpasswd -m sha-512 gamemaster) game-adm

# Setup ssh
RUN mkdir -p /home/game-tester/.ssh
COPY game-server/authorized_keys /home/game-tester/.ssh/authorized_keys

# Create app directory
WORKDIR /usr/src/app

# Change id of node
RUN groupmod -g 1111 node \
  && usermod -u 1111 -g 1111 node

# Create entrypoint dir
RUN mkdir -p /docker-entrypoint.d

# Execute all scripts in /entrypoint.sh
RUN echo '#!/bin/bash' > /entrypoint.sh
RUN echo 'for ep in /docker-entrypoint.d/*; do' >> /entrypoint.sh
RUN echo 'if [ -x "${ep}" ]; then' >> /entrypoint.sh
RUN echo '    echo "Running: ${ep}"' >> /entrypoint.sh
RUN echo '    "${ep}" &' >> /entrypoint.sh
RUN echo '  fi' >> /entrypoint.sh
RUN echo 'done' >> /entrypoint.sh
RUN echo 'tail -f /dev/null' >> /entrypoint.sh
RUN chmod 754 /entrypoint.sh

# Expose node-server
EXPOSE 9999

# Run server
ENTRYPOINT [ "/entrypoint.sh" ]
