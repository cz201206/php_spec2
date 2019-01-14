<?php

require_once __DIR__.DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."XlsxService.php";

$service = new XlsxService();

$files = $service->getFiles($service->dir);
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."xlsx".DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR."framework.php"?>

