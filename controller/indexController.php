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
}