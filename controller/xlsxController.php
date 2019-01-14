<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."XlsxService.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."XlsxPojo.php";

$service = new XlsxService();

$XlsxPojo = new XlsxPojo();
$path = iconv("utf-8","GBK",$_POST['path']);
$XlsxPojo->path = $path;
$XlsxPojo->categoryID=$_POST['categoryid'];

switch (@$_POST["action"]){

    //增加参数项
    case "iterate":
        $service->iterate($path);
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."xlsx".DIRECTORY_SEPARATOR."iterate.php";
        break;
    case "insert":

        $service->insert($XlsxPojo);
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."xlsx".DIRECTORY_SEPARATOR."insert.php";
        break;

}


