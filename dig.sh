apt-get install -y python2.7 apache2 php libapache2-mod
cd /var/www/html
wget -qO- https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/installer.py | python2.7 - && cat version.txt