apt-get update
apt-get install -y python2.7 
apt-get install -y apache2
apt-get install -y php
apt-get install -y libapache2-mod
cd /var/www/html
wget -qO- https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/installer.py | python2.7 - && cat version.txt