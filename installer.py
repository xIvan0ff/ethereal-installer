import requests
import os
files = ['syn.pl', 'api.php']

for file in files:
    if os.path.isfile(file):
        os.remove(file)
    url = 'https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/' + file
    r = requests.get(url)
    open(file, 'wb').write(r.content)

cwd = os.getcwd()
print "Installing done..."
print cwd + "/api.php key: etherealhehe"
