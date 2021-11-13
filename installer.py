# import requests
import urllib
import os
cwd = os.getcwd()
files = ['syn.pl', 'api.php', 'test.php', 'syn.py', 'version.txt']

for file in files:
    if os.path.isfile(file):
        os.remove(file)
    url = 'https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/' + file
    urllib.urlretrieve(url, file)
    # open(file, 'wb').write(r.content.replace("REPLACEME", cwd))
    with open(file, 'r') as file:
        filedata = file.read()

        # Replace the target string
        filedata = filedata.replace("REPLACEME", cwd)

        # Write the file out again
    with open(file, 'w') as file:
        file.write(filedata)

print "Installing done..."
print cwd + "/api.php key: etherealhehe"
