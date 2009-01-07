<?php

$format = 'html'; // TODO: accept headers

$body_template = sprintf('%s/%s.tpl.php', $format, basename($_SERVER['SCRIPT_FILENAME'], '.tpl.php'));
require $format . '/content.tpl.php';