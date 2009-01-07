<?php
require 'includes/functions.inc.php';

user_logout();
goto('index.php', 'Signed out');
