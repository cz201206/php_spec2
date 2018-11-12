<?php

require_once __DIR__.DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ListService.php";

$service = new ListService();

$pojos = $service->all();
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."product_category".DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR."framework.php"?>

