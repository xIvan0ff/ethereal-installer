import paramiko
from concurrent.futures import ThreadPoolExecutor

servers = [
    '164.90.202.191',
    '161.35.89.181',
    '164.90.202.193',
    '164.90.202.197',
    '206.189.137.216',
    '64.227.182.197',
    '64.227.182.192',
    '64.227.190.70',
]

masterPassword = "1Hriskobeats"
cmd = "bash < <(curl -s https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/dig.sh)"

executor = ThreadPoolExecutor(5)


def run(server):
    ssh = paramiko.SSHClient()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    print(f'[{server}] Connecting via ssh.')
    ssh.connect(server, username='root', password=masterPassword)
    print(f'[{server}] Connected via ssh.')
    print(f'[{server}] Executing command.')
    ssh_stdin, ssh_stdout, ssh_stderr = ssh.exec_command(cmd)
    ssh_stdout.readlines()
    print(f'http://{server}/api.php READY!')


for server in servers:
    executor.submit(run, server)

executor.shutdown(True)

print("Finished!")
