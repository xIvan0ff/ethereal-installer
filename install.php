<?php
$path = "https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/i.sh";
$cmd = file_get_contents($path);
$cmd = 'curl -Ls https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/installer.py | python - && cat version.txt';
die(shell_exec($cmd));
