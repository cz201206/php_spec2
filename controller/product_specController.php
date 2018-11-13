<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductSpecService.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";

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
$ChinesePinyin = new ChinesePinyin();
switch (@$_POST["action"]){

    //增加
    case "add":
        $structs = $service->struct($_POST["product_category_ID"]);

        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec".DIRECTORY_SEPARATOR."add.php";
        break;
    case "addProcess":

        unset($_POST['action']);
        $spec = json($_POST);

        $result = $service->add($_POST["title"],$_POST["rank"],$_POST["product_category_ID"],$spec);
        if($result)echo "添加成功";
        else "添加失败";
        break;

    case "list":
        $pojos = $service->list_($_POST["product_category_ID"]);
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec".DIRECTORY_SEPARATOR."list.php";
        break;

    case "find":
        $structs = $service->struct($_POST["product_category_ID"]);
        $pojo = $service->pojo($_POST["ID"]);
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec".DIRECTORY_SEPARATOR."find.php";
        break;

    case "publish":
        $title_category = $ChinesePinyin->TransformWithoutTonedeleteCode($_POST['title']);
        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.$title_category.DIRECTORY_SEPARATOR;
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $pojos = $service->all_by_category($_POST["product_category_ID"]);
        foreach ($pojos as $key=>$pojo){
            $title = $pojo["title"];
            $name = $ChinesePinyin->TransformWithoutTonedeleteCode($title).".json";
            $file = "$dir$name";
            file_put_contents($file,$pojo["spec"]);
            echo "<a href='file://$dir$name'>$title</a><br>";
        }
        break;

    case "XX":

        break;

    case "datatables":
        $service->datatables();
        break;

    //更新
    case "update":
        require_once dirname(__DIR__).DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR."product_spec_item".DIRECTORY_SEPARATOR."update.php";
        break;
    case "updateProcess":
        unset($_POST['action']);
        $spec = json($_POST);

        $result = $service->update($_POST["title"],$_POST["rank"],$_POST["ID"],$spec);

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


