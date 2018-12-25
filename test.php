<?php
require 'vendor/autoload.php';
require_once "dao".DIRECTORY_SEPARATOR."ProductSpecDao.php";
$ProductSpecDao = new ProductSpecDao();

$db_datas = $ProductSpecDao->all_by_category(1);

?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."test".DIRECTORY_SEPARATOR."framework.php"?>

