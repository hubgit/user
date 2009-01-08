<?php
require 'includes/main.inc.php';

user_logout();
goto('index.php', 'Signed out');
