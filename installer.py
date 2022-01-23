# import requests
import os
import sys

if sys.version_info[0] >= 3:
    from urllib.request import urlretrieve
else:
    # Not Python 3 - today, it is most likely to be Python 2
    # But note that this might need an update when Python 4
    # might be around one day
    from urllib import urlretrieve

cwd = os.getcwd()
files = ['syn.pl', 'api.php', 'test.php',
         'bypass.pl', 'version.txt', 'index.html', 'http.pl', 'watch.php', 'install.php', 'uninstall.php']

for file in files:
    if os.path.isfile(file):
        os.remove(file)
    url = 'https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/' + file
    urlretrieve(url, file)
    # open(file, 'wb').write(r.content.replace("REPLACEME", cwd))
    with open(file, 'r') as file_object:
        filedata = file_object.read()
        filedata = filedata.replace("REPLACEME", cwd)
    with open(file, 'w') as file_object:
        file_object.write(filedata)

print("Installing done...")
print(cwd + "/api.php key: etherealhehe")
