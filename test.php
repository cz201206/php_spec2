<?php
require 'vendor/autoload.php';

$pattern = array("/r/n",  '/n' );
$cellValue = preg_replace($pattern, '<br/>', $cellValue);
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."test".DIRECTORY_SEPARATOR."framework.php"?>

