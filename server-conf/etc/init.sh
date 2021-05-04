#!/bin/bash

input="INPUT-CUSTOM"
output="OUTPUT-CUSTOM"

# Setup closed fw-policy
iptables -P INPUT DROP
iptables -P FORWARD DROP
iptables -P OUTPUT DROP

# Append custom input-rules
iptables -N $input
iptables -A INPUT -j $input

# Append custom output-rules
iptables -N $output
iptables -A OUTPUT -j $output

# Deny all ipv6
ip6tables -P INPUT DROP
ip6tables -P FORWARD DROP
ip6tables -P OUTPUT DROP