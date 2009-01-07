<?php

list($type, $format) = parse_accept_headers();

$file = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$file = preg_replace('/[^a-z]/', '', $file); // sanitize

$template = sprintf('%s/%s.tpl.php', $format, $file);

header("Content-Type: $type;charset=UTF-8");
require $format . '/content.tpl.php';

function parse_accept_headers($default = 'html'){
  $formats = array(
    'text/html' => 'html',
    'application/xhtml+xml' => 0,
    'application/xml' => 0,
    '*/*' => 'html',
    );

  $accept = array();
  foreach (explode(',', $_SERVER['HTTP_ACCEPT']) as $header){
    $parts = explode(';q=', $header);
    if (count($parts) === 1)
      $parts[1] = 1;
    $accept[$parts[0]] = $parts[1];
  }

  arsort($accept);
  $accept[] = $default;

  foreach ($accept as $format => $q)
    if (array_key_exists($format, $formats) && $formats[$format])
      break;
  
  return array($format, $formats[$format]);
}