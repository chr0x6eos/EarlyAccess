#!/bin/bash

input="INPUT-CUSTOM"
output="OUTPUT-CUSTOM"

iptables -F $input

# Allows all loopback (lo0) traffic
iptables -A $input -i lo -j ACCEPT -m comment --comment "IN: Accept loopback traffic"
iptables -A $output -o lo -j ACCEPT -m comment --comment "OUT: Accept loopback traffic"

# Allow established connections
iptables -A $input -m state --state RELATED,ESTABLISHED -j ACCEPT -m comment --comment "IN: Accept established, related"
iptables -A $output -m state --state RELATED,ESTABLISHED -j ACCEPT -m comment --comment "OUT: Accept established, related"

# Allow echo-requests & replies
iptables -A $input -p icmp --icmp-type echo-request -j ACCEPT -m comment --comment "IN: Accept echo-request"
iptables -A $input -p icmp --icmp-type echo-reply -j ACCEPT -m comment --comment "IN: Accept echo-reply"
iptables -A $output --icmp-type echo-request -j ACCEPT -m comment --comment "OUT: Accept echo-request"
iptables -A $output --icmp-type echo-reply -j ACCEPT -m comment --comment "OUT: Accept echo-reply"

# Allow SSH
iptables -A $input -p tcp -m state --state NEW --dport 22 -j ACCEPT -m comment --comment "IN: Accept SSH"

# Allow HTTP & HTTPS
iptables -A $input -p tcp --match multiport --dport 80,443 -j ACCEPT -m comment --comment "IN: Accept HTTP/S"

# Allow UDP outbound
iptables -A $output -p udp -j ACCEPT -m comment --comment "OUT: Accept UDP-Traffic"

# Apply changes
iptables -A $input -j RETURN
iptables -A $output -j RETURN

