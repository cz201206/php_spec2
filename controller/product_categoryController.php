<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductCategoryService.php";

$service = new ProductCategoryService();

switch (@$_POST["action"]){

    //增加参数项
    case "add":
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_category".DIRECTORY_SEPARATOR."add.php";
        break;
    case "addProcess":
        $result = $service->addProcess($_POST["title"]);
        if($result)echo "添加成功";
        else "添加失败";
        break;

    //更新
    case "update":
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_category".DIRECTORY_SEPARATOR."update.php";
        break;
    case "updateProcess":
        $result = $service->updateProcess($_POST["ID"],$_POST["title"]);

        if($result)echo "修改成功";
        else "修改失败";
        break;
}


