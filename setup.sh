#!/bin/bash

set -xe

sudo apt install -y git docker docker-compose

docker pull tomsik68/xampp

git clone https://github.com/WTheo-dev/SAE_Reseaux.git --depth=1

cd SAE_Reseaux && git checkout integration-de-fou-zinzin && cd ..

cp ./SAE_Reseaux/docker-compose.yml . && docker-compose up -d

docker exec sae chmod +x /opt/lampp/htdocs/init-bdd.sh

sleep 10

docker exec sae /opt/lampp/htdocs/init-bdd.sh

IFNAME=$(ip link show | grep " UP" | head -n 1 | cut -d ' ' -f 2 | cut -d ':' -f 1)
CON_NAME="myhotspot"

nmcli con add type wifi ifname $IFNAME con-name $CON_NAME autoconnect yes ssid $CON_NAME
nmcli con modify $CON_NAME 802-11-wireless.mode ap 802-11-wireless.band bg ipv4.method shared

# nmcli con modify $CON_NAME wifi-sec.key-mgmt wpa-psk
# nmcli con modify $CON_NAME wifi-sec.psk "MyStrongHotspotPass"

nmcli con up $CON_NAME

iptables -A INPUT -p tcp -m tcp -m multiport --dports 22,80,443 -j ACCEPT
iptables -A INPUT -m state --state NEW,ESTABLISHED -j ACCEPT
iptables -A OUTPUT -m state --state ESTABLISHED -j ACCEPT
iptables -A FORWARD -j DROP

mkdir -p /etc/iptables/
iptables-save > /etc/iptables/rules.v4
ip6tables-save > /etc/iptables/rules.v6

apt install iptables-persistent -y
