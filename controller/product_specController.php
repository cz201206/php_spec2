<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductSpecService.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";

function l1($title,$l2){
    $l1["title"] = $title;
    $l1["l2"] = $l2;
    return $l1;
}

function l2($title,$spec){
    $urlEncode_title = urlencode("title");
    $urlEncode_spec = urlencode("spec");
    $l2[$urlEncode_title] = urlencode($title);
    $l2[$urlEncode_spec] = urlencode($spec);
    return $l2;
}

$service = new ProductSpecService();

switch (@$_POST["action"]){

    //增加
    case "add":
        $structs = $service->struct($_POST["product_category_ID"]);

        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec".DIRECTORY_SEPARATOR."add.php";
        break;
    case "addProcess":

        $product["title"] = urlencode($_POST["title"]);
        $product["l1"] = [];

        //原始数据
        $spec = $_POST["spec"];
        $structs = $service->struct($_POST["product_category_ID"]);

        $l1_title = $structs[0]["title1"];
        $l2s = [];
        foreach ($structs as $key=>$struct){
            //换下个一级参数项
            if($l1_title!=$struct["title1"] ){

                $product["l1"][] = l1(urlencode($l1_title),$l2s);
                //初始化
                $l1_title = $struct["title1"];
                unset($l2s);
            }
            $l2s[] = l2($struct["title2"],$spec[$key]);

            if(($key+1)==sizeof($structs)){
                $product["l1"][] = l1(urlencode($l1_title),$l2s);
            }
        }

        $product = urldecode(json_encode($product));
        echo "<pre>";
        var_dump($product);

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


