<?php

require_once __DIR__.DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductSpecItemService.php";
$service = new ProductSpecItemService();
$pojos = $service->accordion($_GET["product_category_ID"]);
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."product_spec_item".DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR."framework.php"?>

