<?php

ob_start();

session_start(); // turn on sessions 

require_once('functions.php');
require_once('validation_functions.php');

$errors = [];
$message = '';
