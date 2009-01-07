<?php

$format = parse_accept_headers();

$file = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$file = preg_replace('/[^a-z]/', '', $file); // sanitize

$template = sprintf('%s/%s.tpl.php', $format, $file);
require $format . '/content.tpl.php';

function parse_accept_headers(){
  $formats = array(
    'text/html' => 'html',
    'application/xhtml+xml' => 0,
    'application/xml' => 0,
    '*/*' => 'html',
    );

  $accept = explode(',', $_SERVER['HTTP_ACCEPT']);
  $accepted = array();
  foreach ($accept as $header){
    $parts = explode(';q=', $header);
    if (count($parts) === 1)
      $parts[1] = 1;
    $accepted[$parts[0]] = $parts[1];
  }

  arsort($accepted);
  $accepted[] = 'html'; // default

  foreach ($accepted as $format => $q)
    if (array_key_exists($format, $formats) && $formats[$format])
      break;
  
  return $formats[$format];
}