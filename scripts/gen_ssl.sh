#!/bin/bash
#Generated by Chr0x6eOs to quickly setup SSL on WEBSERVER

country="AT"
state="Vienna"
locality="Vienna"
organization="EarlyAccess Game Corp"
ou="IT"
cn="earlyaccess.htb"
email="chr0x6eos@earlyaccess.htb"

crt="/etc/apache2/ssl/server.crt"
key="/etc/apache2/ssl/server.key"

target="/etc/apache2/sites-enabled/000-default.conf"

if [ "$EUID" -ne 0 ]
 then
    echo "Script has to be run as root! Please run script as root or with sudo!"
    exit
fi

echo "-------------------------------------------------------------"
echo "1.) Generating SSL Certificate..."

echo "openssl req -x509 -nodes -days 365 -newkey rsa:2048 -out /etc/apache2/ssl/server.crt -keyout /etc/apache2/ssl/server.key \
	  -subj \"/C=$country/ST=$state/L=$locality/O=$organization/OU=$ou/CN=$cn/emailAddress=$email\""
	  
echo "Country Name: $country"
echo "State: $state"
echo "Locality Name: $locality"
echo "Organization Name: $organization"
echo "OU: $ou"
echo "Common Name: $cn"
echo "Email Address: $email"

echo "Is this ok?"
echo "(Y/n): "
read ok

if [ "$ok" != "N" ] && [ "$ok" != "n" ] && [ "$ok" != "No" ] && [ "$ok" != "no" ]
 then
	if [ ! -d "/etc/apache2/ssl" ]
	 then
		mkdir "/etc/apache2/ssl"
	fi
	
	#Backup crt if it exists
	if [ -f "$crt" ]
	 then
	    cp "$crt" "$crt.bak"
	fi
	
	#Backup key if it exists
	if [ -f "$key" ]
	 then
		cp "$key" "$key.bak"
	fi
	
	openssl req -x509 -nodes -days 365 -newkey rsa:2048 -out $crt -keyout $key \
	  -subj "/C=$country/ST=$state/L=$locality/O=$organization/OU=$ou/CN=$cn/emailAddress=$email"
 else
	echo "Change params in script!"
	exit
fi

echo "-------------------------------------------------------------"
echo "2.) Activating SSL..."
echo "a2enmod ssl"
	  a2enmod ssl
echo "service apache2 restart"
	  service apache2 restart

echo "-------------------------------------------------------------"
echo "3.) Editing ApacheConf..."
echo "cat $target"
echo "<VirtualHost *:443>" > $target
echo "	SSLEngine On" >> $target
echo "	SSLCertificateFile $crt" >> $target
echo "	SSLCertificateKeyFile $key" >> $target
echo "	ServerAdmin $email" >> $target
echo "	DocumentRoot /var/www/html/public" >> $target
echo "<Directory \"/var/www/html\">" >> $target
echo "AllowOverride all" >> $target
echo "Require all granted" >> $target
echo "</Directory>" >> $target
echo "	ErrorLog \${APACHE_LOG_DIR}/error.log" >> $target
echo "	CustomLog \${APACHE_LOG_DIR}/access.log combined" >> $target 
echo "</VirtualHost>" >> $target
