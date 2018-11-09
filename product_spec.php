<?php
require_once __DIR__.DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductSpecService.php";
$service = new ProductSpecService();
$pojos = $service->info();
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."product_spec".DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR."framework.php"?>

