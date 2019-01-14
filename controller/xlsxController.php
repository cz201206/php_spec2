<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."XlsxService.php";

$service = new XlsxService();


switch (@$_POST["action"]){

    //增加参数项
    case "iterate":
        $path = iconv("utf-8","GBK",$_POST['path']);
        $service->iterate($path);
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."xlsx".DIRECTORY_SEPARATOR."iterate.php";
        break;
    case "insert":
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."xlsx".DIRECTORY_SEPARATOR."insert.php";
        break;

}


