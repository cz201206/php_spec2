<?php
require 'vendor/autoload.php';

$cellValue = "你好啊\r\n天气\n你知道的";
$pattern = array('a',  'c' );
$cellValue = str_replace(PHP_EOL, '替换了', $cellValue);
echo "$cellValue";
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."test".DIRECTORY_SEPARATOR."framework.php"?>

