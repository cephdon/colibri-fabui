#!/bin/bash

CONFIG="ctrl_interface=DIR=/run/wpa_supplicant GROUP=netdev\nupdate_config=1\n"
sudo chmod 666 /etc/wpa_supplicant.conf
echo -e $CONFIG > /etc/wpa_supplicant.conf
sudo chmod 644 /etc/wpa_supplicant.conf
sudo ifdown wlan0
sudo ifup wlan0
sudo bash /var/www/fabui/script/bash/internet.sh &
