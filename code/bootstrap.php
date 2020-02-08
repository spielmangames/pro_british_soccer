<?php

// system settings
ini_set('display_errors', true);

// constants
define('PROJECT_PATH', dirname(realpath(__DIR__)));

// libs
require_once(PROJECT_PATH . '/code/lib/helper/functions.php');

// inside files
require_once(PROJECT_PATH . '/code/model/club.php');
require_once(PROJECT_PATH . '/code/model/printer.php');
