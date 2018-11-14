<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ProductSpecItemDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."ProductSpecItemPojo.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";
require_once __DIR__.DIRECTORY_SEPARATOR."ProductCategoryService.php";
/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/7
 * Time: 16:45
 */
class ProductSpecItemService
{
    public $ChinesePinyin;
    public $dao;
    public $ProductCategoryService;
    function __construct()
    {
        $this->dao = new ProductSpecItemDao();
        $this->ChinesePinyin = new ChinesePinyin();
        $this->ProductCategoryService = new ProductCategoryService();
    }

    public function addProcess($product_category_ID,$level,$parent_ID,$rank,$title){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->insert($product_category_ID,$level,$parent_ID,$rank,$title,$name);
    }

    public function updateProcess($ID,$title,$rank){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->update($ID,$title,$rank,$name);
    }

    public function deleteProcess($ID){
        return $this->dao->delete($ID);
    }

    public function level1($product_category_ID){
        $pojos = [];
        $array_ProductSpecItem = $this->dao->level1($product_category_ID);
        foreach ($array_ProductSpecItem as $ProductSpecItem ){
            $pojo = new ProductSpecItemPojo();
            $pojo->ID = $ProductSpecItem["ID"];
            $pojo->product_category_ID = $ProductSpecItem["product_category_ID"];
            $pojo->level = $ProductSpecItem["level"];
            $pojo->rank = $ProductSpecItem["rank"];
            $pojo->title = $ProductSpecItem["title"];
            $pojo->name = $ProductSpecItem["name"];
            $pojos[] = $pojo;
        }
        return $pojos;
    }

    public function level2($product_category_ID,$parent_ID){
        $pojos = [];
        $array_ProductSpecItem = $this->dao->level2($product_category_ID,$parent_ID);
        foreach ($array_ProductSpecItem as $ProductSpecItem ){
            $pojo = new ProductSpecItemPojo();
            $pojo->ID = $ProductSpecItem["ID"];
            $pojo->product_category_ID = $ProductSpecItem["product_category_ID"];
            $pojo->level = $ProductSpecItem["level"];
            $pojo->rank = $ProductSpecItem["rank"];
            $pojo->title = $ProductSpecItem["title"];
            $pojo->name = $ProductSpecItem["name"];
            $pojos[] = $pojo;
        }
        return $pojos;
    }

    public function accordion($product_category_ID){
        //第一级节点
        $pojos_level1 = $this->level1($product_category_ID);
        foreach ($pojos_level1 as $pojo_level1){
            $parent_ID = $pojo_level1->ID;
            //相对应的二级节点
            $pojo_level1->children = $this->level2($product_category_ID,$parent_ID);
        }
        return $pojos_level1;
    }

    public function level1_urlEncode($product_category_ID){
        $pojos = [];
        $array_ProductSpecItem = $this->dao->level1($product_category_ID);
        foreach ($array_ProductSpecItem as $ProductSpecItem ){
            $pojo = new ProductSpecItemPojo();
            $pojo->ID = $ProductSpecItem["ID"];
            $pojo->product_category_ID = $ProductSpecItem["product_category_ID"];
            $pojo->level = $ProductSpecItem["level"];
            $pojo->rank = $ProductSpecItem["rank"];
            $pojo->title = urlencode($ProductSpecItem["title"]);
            $pojo->name = $ProductSpecItem["name"];
            $pojos[] = $pojo;
        }
        return $pojos;
    }

    public function level2_urlEncode($product_category_ID,$parent_ID){
        $pojos = [];
        $array_ProductSpecItem = $this->dao->level2($product_category_ID,$parent_ID);
        foreach ($array_ProductSpecItem as $ProductSpecItem ){
            $pojo = new ProductSpecItemPojo();
            $pojo->ID = $ProductSpecItem["ID"];
            $pojo->product_category_ID = $ProductSpecItem["product_category_ID"];
            $pojo->level = $ProductSpecItem["level"];
            $pojo->rank = $ProductSpecItem["rank"];
            $pojo->title = urlencode($ProductSpecItem["title"]);
            $pojo->name = $ProductSpecItem["name"];
            $pojos[] = $pojo;
        }
        return $pojos;
    }

    public function accordion_urlEncode($product_category_ID){
        //第一级节点
        $pojos_level1 = $this->level1_urlEncode($product_category_ID);
        foreach ($pojos_level1 as $pojo_level1){
            $parent_ID = $pojo_level1->ID;
            //相对应的二级节点
            $pojo_level1->children = $this->level2_urlEncode($product_category_ID,$parent_ID);
        }
        return $pojos_level1;
    }

    public function struts(){
        $struts=[];
        $categories = $this->ProductCategoryService->all();
        $strut["name"] = "";
        $strut["title"] = "";
        $strut["l1"] = "";
        foreach ($categories as $category){
            $strut["name"] = $category->name;
            $strut["title"] = urlencode($category->title);
            $strut["l1"] = $this->accordion_urlEncode($category->ID);
            $struts[] = $strut;
            unset($strut);
        }
       //将数据写入文件
        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."struct".DIRECTORY_SEPARATOR;
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        foreach ($struts as $strut){
            $name = $strut["name"].".json";
            $file = $dir.$name;
            file_put_contents($file,urldecode(json_encode($strut)));
            echo "<a href='file://$file'>".urldecode($strut["title"])."</a><br>";
        }
    }
}