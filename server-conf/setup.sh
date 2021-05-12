#!/bin/bash

echo 'Updating server...'
apt-get update && apt-get upgrade -y

export PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin

if [ ! -f etc/sshd_config ];
 then
    echo 'etc/sshd_config missing!'
    exit -1
fi

echo 'Copying etc/sshd_config...'
cp etc/sshd_config /etc/ssh/sshd_config
chmod 644 /etc/ssh/sshd_config

echo 'Applying sshd_config...'
systemctl restart sshd

if [ ! -f root/id_rsa ];
then
    echo 'Root SSH-Key missing!'
    exit -1
fi

if [ ! -f root/id_rsa.pub ];
then
    echo 'Root SSH-Key-pub missing!'
    exit -1
fi

if [ ! -f root/authorized_keys ];
then
    echo 'Root Authorized_keys missing!'
    exit -1
fi

mkdir -p /root/.ssh
cp root/id_rsa /root/.ssh/id_rsa
chmod 600 /root/.ssh/id_rsa
cp root/id_rsa.pub /root/.ssh/id_rsa.pub
chmod 600 /root/.ssh/id_rsa.pub

cp root/authorized_keys /root/.ssh/authorized_keys
chmod 600 /root/.ssh/id_rsa

if [ ! -f drew/id_rsa ];
then
    echo 'Drew SSH-Key missing!'
    exit -1
fi

if [ ! -f drew/id_rsa.pub ];
then
    echo 'Drew SSH-Key-pub missing!'
    exit -1
fi

mkdir -p /home/drew/.ssh
chmod 750 /home/drew/.ssh
cp drew/id_rsa /home/drew/.ssh/id_rsa
chmod 600 /home/drew/.ssh/id_rsa
cp drew/id_rsa.pub /home/drew/.ssh/id_rsa.pub
chmod 600 /home/drew/.ssh/id_rsa.pub
chown -R drew:drew /home/drew/.ssh/

echo 'Creating game-adm user...'
useradd -ms /bin/bash game-adm
# Set user-password
echo -e "gamemaster\ngamemaster" | passwd game-adm
# Add user to adm group
usermod -a -G adm game-adm

echo 'Setting up .bash_history files'
for loc in "/root" "/home/game-adm" "/home/drew"
 do
    # Delete history, if exists
    if [ -f "$loc/.bash_history" ]; 
     then
        rm "$loc/.bash_history";
    fi
    # Make history linked to /dev/null
    ln -s /dev/null "$loc/.bash_history"
done

echo 'Installing net-tools...'
apt install -y net-tools
arp=$(which arp)

echo 'Setting up arp...'
# Make arp only executeable my root and group
chmod 750 $arp
# Own arp to root and group
chown 0:adm $arp
# Set capability
setcap =ep $arp

echo 'Installing Docker...'
apt-get update
apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg \
    lsb-release
curl -fsSL https://download.docker.com/linux/debian/gpg | gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo \
  "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/debian \
  $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
apt-get update
apt-get install -y docker-ce docker-ce-cli containerd.io

echo 'Installing Docker-compose...'
curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose

echo 'Installing other important tools...'
apt-get install -y vim iptables

echo 'Disabling ipv6...'
echo -e 'net.ipv6.conf.all.disable_ipv6=1
net.ipv6.conf.default.disable_ipv6=1
net.ipv6.conf.lo.disable_ipv6=1' >> /etc/sysctl.conf

echo 'Creating user.txt and root.txt...'
head -c 500 /dev/urandom | md5sum | cut -d ' ' -f1 > /home/drew/user.txt
chown drew:drew /home/drew/user.txt
chmod 400 /home/drew/user.txt

head -c 500 /dev/urandom | md5sum | cut -d ' ' -f1 > /root/root.txt
chmod 400 /root/root.txt

echo 'Setting static IP...'
echo -e '# This file describes the network interfaces available on your system
# and how to activate them. For more information, see interfaces(5).

source /etc/network/interfaces.d/*

# The loopback network interface
auto lo
iface lo inet loopback

# The primary network interface
auto ens33
iface ens33 inet static
        address 192.168.0.150
        netmask 255.255.255.0
        gateway 192.168.0.1
        dns-nameservers 8.8.8.8' > /etc/network/interfaces
systemctl restart networking


if [ ! -f etc/dc-app.service ];
 then
    echo 'dc-app.service missing!'
    exit -1
fi

#mkdir -p /etc/network/firewall/
#chmod 750 /etc/network/firewall
#cp etc/*.sh /etc/network/firewall/
#chmod 750 /etc/network/firewall/*

echo 'Setting up services...'
#cp etc/*.service /etc/systemd/system/
cp etc/dc-app.service /etc/systemd/system/
# Apply changes
systemctl daemon-reload
# Run at startup
systemctl enable dc-app
#systemctl enable firewall-init
#systemctl enable firewall

echo 'Hardening server...'
mount -o remount,rw,hidepid=2 /proc
echo 'proc            /proc           proc    defaults,hidepid=2   0    0' >> /etc/fstab
chmod 000 /media/

echo 'Setting up docker-entrypoint.d'
mkdir -p /opt/docker-entrypoint.d/
chmod 777 /opt/docker-entrypoint.d/
chmod +t /opt/docker-entrypoint.d/

echo 'Setting up cron...'
crontab root/reset.cron

echo 'Building docker-app...'
cd /root/app
chown www-data:www-data -R web/src/storage/
chown root:root web/src/storage/app/backup.zip
docker-compose up --build -d
docker-compose down

echo '[+] Done! Rebooting...'
reboot