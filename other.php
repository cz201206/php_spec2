<?php

require_once __DIR__.DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductCategoryService.php";

$service = new ProductCategoryService();

$pojos = $service->all();
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."other".DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR."framework.php"?>

