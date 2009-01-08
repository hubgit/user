<?php

require 'includes/main.inc.php';

$path = array_values(array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))));
array_shift($path);

if (empty($path))
  $path[] = 'index';
  
$file = sprintf('path/%s.php', preg_replace('[^a-z]', '', $path[0]));
if (!file_exists($file))
  goto('index');

require $file;

require 'includes/output.inc.php'; 
