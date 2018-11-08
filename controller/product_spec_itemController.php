<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductSpecItemService.php";

$service = new ProductSpecItemService();

switch (@$_POST["action"]){

    //增加
    case "add":
        if($_POST["level"]==1)
            require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec_item".DIRECTORY_SEPARATOR."add_level1.php";
        else
            require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec_item".DIRECTORY_SEPARATOR."add_level2.php";
        break;
    case "addProcess":

        $result = $service->addProcess($_POST["product_category_ID"],$_POST["level"],$_POST["parent_ID"],$_POST["rank"],$_POST["title"]);
        if($result)echo "添加成功";
        else "添加失败";

        break;
    case "select":

        break;

    //更新
    case "update":
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec_item".DIRECTORY_SEPARATOR."update.php";
        break;
    case "updateProcess":
        $result = $service->updateProcess($_POST["ID"],$_POST["title"],$_POST["rank"]);
        if($result)echo "修改成功";
        else "修改失败";
        break;

    //删除
    case "delete":
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec_item".DIRECTORY_SEPARATOR."delete.php";
        break;
    case "deleteProcess":
        $result = $service->deleteProcess($_POST["ID"]);
        if($result)echo "删除成功";
        else "删除失败";
        break;

}


