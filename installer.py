import requests
import os
cwd = os.getcwd()
files = ['syn.pl', 'api.php', 'test.php', 'syn.py']

for file in files:
    if os.path.isfile(file):
        os.remove(file)
    url = 'https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/' + file
    r = requests.get(url)
    open(file, 'wb').write(r.content.replace("REPLACEME", cwd))

print "Installing done..."
print cwd + "/api.php key: etherealhehe"
