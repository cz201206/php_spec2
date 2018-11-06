<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductCategoryService.php";

$service = new ProductCategoryService();

switch (@$_POST["action"]){
    case "add":
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_category".DIRECTORY_SEPARATOR."add.php";
        break;
    case "addProcess":
        $result = $service->addProcess($_POST["title"]);
        if($result)echo "添加成功";
        else "添加失败";
        break;
}


