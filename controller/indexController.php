<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."IndexService.php";

$service = new IndexService();

switch (@$_POST["action"]){
    case "nav":
        echo $service->nav();
        break;
    case "datatables":
        $service->datatables();
        break;
    case "3dNames":
        echo "响应3dNames";
        $service->f3dName();
        break;

    case "iterate":
        echo "响应3dNames";
        $service->f3dName();
        break;
    case "insert":
        echo "响应3dNames";
        $service->f3dName();
        break;
    case "update":
        echo "响应3dNames";
        $service->f3dName();
        break;
}