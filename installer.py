# import requests
import urllib
import os
cwd = os.getcwd()
files = ['syn.pl', 'api.php', 'test.php',
         'bypass.pl', 'version.txt', 'index.html', 'http.pl', 'watch.php']

for file in files:
    if os.path.isfile(file):
        os.remove(file)
    url = 'https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/' + file
    urllib.urlretrieve(url, file)
    # open(file, 'wb').write(r.content.replace("REPLACEME", cwd))
    with open(file, 'r') as file_object:
        filedata = file_object.read()
        filedata = filedata.replace("REPLACEME", cwd)
    with open(file, 'w') as file_object:
        file_object.write(filedata)

print "Installing done..."
print cwd + "/api.php key: etherealhehe"
