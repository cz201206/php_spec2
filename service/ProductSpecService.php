<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ProductSpecDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."ProductSpecInfoPojo.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";
require_once __DIR__.DIRECTORY_SEPARATOR."ProductCategoryService.php";
/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/7
 * Time: 16:45
 */
class ProductSpecService
{
    public $dao;
    private $ProductCategoryService;
    public $ChinesePinyin;
    function __construct()
    {
        $this->dao = new ProductSpecDao();
        $this->ProductCategoryService = new ProductCategoryService();
        $this->ChinesePinyin = new ChinesePinyin();
    }

    function info(){
        //需要的信息包括 产品分类列表，对应分类中参数个数
        $arr = $this->dao->info();
        $pojos = [];
        foreach($arr as $row){
            $pojo = new ProductSpecInfoPojo();
            $pojo->ID = $row["ID"];
            $pojo->title = $row["title"];
            $pojo->count = $row["count"];
            $pojos[] = $pojo;
        }
        return $pojos;
    }


    function add($title,$rank,$product_category_ID,$spec){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->insert($name,$title,$rank,$product_category_ID,$spec);
    }

    function struct($product_category_ID){
        return $this->dao->struct($product_category_ID);
    }
    //仅列出个别字段
    function list_($product_category_ID){
        return $this->dao->list_($product_category_ID);
    }

    function all_by_category($product_category_ID){
        return $this->dao->all_by_category($product_category_ID);
    }

    function all_onlyNameTitle_urlencoded_by_category($product_category_ID){
        return $this->dao->all_onlyNameTitle_urlencoded_by_category($product_category_ID);
    }

    function all_onlyNameTitle_urlencoded_by_category_asc($category_ID){
        return $this->dao->all_onlyNameTitle_urlencoded_by_category_asc($category_ID);
    }

    function all_onlyNameTitle_urlencoded_by_category_like($product_category_ID,$like){
        return $this->dao->all_onlyNameTitle_urlencoded_by_category_like($product_category_ID,$like);
    }

    function pojo($ID){
        return $this->dao->pojo($ID);
    }

    function  update($title,$rank,$ID,$spec){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->update($name,$title,$rank,$ID,$spec);
    }

    function  datatables(){
        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR;
        $name = "data_datatables.json";
        $file = "$dir$name";
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $data = [];
        // pojo 类型
        $ProductCategories = $this->ProductCategoryService->all();
        foreach ($ProductCategories as $ProductCategory){
            $product_category_ID = $ProductCategory->ID;
            $category_name = $ProductCategory->name;
            $products = $this->all_by_category($product_category_ID);
            $category_index = 0;
            foreach ($products as $product){
                $data[$category_index][0] = $category_name;
                $data[$category_index][1] = $product["name"];
                $data[$category_index][2] = $product["title"];
                $category_index++;
            }

        }
        $datatables["data"] =  $data;
        file_put_contents($file,json_encode($datatables));
        echo $file;

    }

    function publish(){
        $title_category = $this->ChinesePinyin->TransformWithoutTonedeleteCode($_POST['title']);
        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.$title_category.DIRECTORY_SEPARATOR;
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $pojos = $this->all_by_category($_POST["product_category_ID"]);
        foreach ($pojos as $key=>$pojo){
            $title = $pojo["title"];
            $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title).".json";
            $file = "$dir$name";
            file_put_contents($file,$pojo["spec"]);
            echo "<a href='file://$dir$name'>$title</a><br>";
        }
    }
    function publish_single(){
        $ID = $_POST['ID'];
        $categoryID = $_POST['product_category_ID'];
        $category = $this->ProductCategoryService->find($categoryID);
        $category_name = $category[0]["name"];

        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.$category_name.DIRECTORY_SEPARATOR;
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $pojo = $this->pojo($ID);
        $title = $pojo["title"];
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title).".json";
        $file = "$dir$name";
        file_put_contents($file,$pojo["spec"]);
        echo "<a href='file://$dir$name'>$title</a><br>";

    }

}