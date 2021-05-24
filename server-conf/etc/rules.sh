#!/bin/bash

# https://vmalli.com/managing-custom-iptables-rules-on-a-debian-docker-host/

input="INPUT-CUSTOM"
output="OUTPUT-CUSTOM"

# Clear previous rules
iptables -F $input
iptables -F $output
iptables -F DOCKER-USER

# Accepts all loopback (lo0) traffic
iptables -A $input -i lo -j ACCEPT -m comment --comment "IN: Accept loopback traffic"
iptables -A $output -o lo -j ACCEPT -m comment --comment "OUT: Accept loopback traffic"

# Accept established connections
iptables -A $input -m state --state RELATED,ESTABLISHED -j ACCEPT -m comment --comment "IN: Accept established, related"
iptables -A $output -m state --state RELATED,ESTABLISHED -j ACCEPT -m comment --comment "OUT: Accept established, related"

# Accept echo-requests & replies
iptables -A $input -p icmp -m icmp --icmp-type echo-request -j ACCEPT -m comment --comment "IN: Accept echo-request"
iptables -A $input -p icmp -m icmp --icmp-type echo-reply -j ACCEPT -m comment --comment "IN: Accept echo-reply"
iptables -A $output -p icmp -m icmp --icmp-type echo-request -j ACCEPT -m comment --comment "OUT: Accept echo-request"
iptables -A $output -p icmp -m icmp --icmp-type echo-reply -j ACCEPT -m comment --comment "OUT: Accept echo-reply"

# Accept SSH
iptables -A $input -p tcp -m state --state NEW --dport 22 -j ACCEPT -m comment --comment "IN: Accept SSH"
iptables -A $output -p tcp -m state --state NEW --dport 22 -j ACCEPT -m comment --comment "OUT: Accept SSH"

# Accept HTTP & HTTPS
iptables -A $input -p tcp -m multiport --dport 80,443 -j ACCEPT -m comment --comment "IN: Accept HTTP/S"

# Accept UDP outbound
iptables -A $output -p udp -j ACCEPT -m comment --comment "OUT: Accept UDP-Traffic"

# Accept game-server port outbound
iptables -A $output -p tcp --dport 9999 -j ACCEPT -m comment --comment "OUT: Accept game-server"

# Docker rules
iptables -A DOCKER-USER -m state --state RELATED,ESTABLISHED -j ACCEPT -m comment --comment "DOCKER: Accept established, related"
iptables -A DOCKER-USER -s 172.18.0.102 -p udp -j ACCEPT -m comment --comment "DOCKER-OUT: Accept UDP-Traffic from webserver"
iptables -A DOCKER-USER -s 172.18.0.102 -p tcp -m multiport --sport 80,443 -j ACCEPT -m comment --comment "DOCKER-OUT: Accept HTTP/S-responses from webserver"
iptables -A DOCKER-USER -s 172.18.0.102 -p tcp -m multiport --dport 80,443 -j ACCEPT -m comment --comment "DOCKER-OUT: Accept HTTP/S-requests from webserver"
iptables -A DOCKER-USER -s 172.18.0.2   -p tcp -m multiport --dport 80,443 -j ACCEPT -m comment --comment "DOCKER-OUT: Accept HTTP/S-requests from admin-simulation"
iptables -A DOCKER-USER -s 172.18.0.0/16 ! -d 172.18.0.0/16 -j DROP -m comment --comment "DOCKER-OUT: Deny all tcp to internet"
iptables -A DOCKER-USER -j ACCEPT # Allow any other docker-traffic

# Apply changes
iptables -A $input -j RETURN
iptables -A $output -j RETURN
iptables -A DOCKER-USER -j RETURN