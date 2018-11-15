<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductCategoryService.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductSpecItemService.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."service".DIRECTORY_SEPARATOR."ProductSpecService.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."fn.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";

$ItemService = new ProductSpecItemService();
$CategoryService = new ProductCategoryService();
$SpecService = new ProductSpecService();
$ChinesePinyin = new ChinesePinyin();
class IndexService
{
    public $ItemService;
    public $CategoryService;
    public $SpecService;
    public $ChinesePinyin;

    function __construct()
    {
        $this->ItemService = new ProductSpecItemService();
        $this->CategoryService = new ProductCategoryService();
        $this->SpecService = new ProductSpecService();
        $this->ChinesePinyin = new ChinesePinyin();
    }

    /*
     * 数据格式[{name:"",title:"",products:[{name:"",title:"",category:""}]}]
     * */
    public function nav(){
        $nav= [];
        $categories = $this->CategoryService->all_onlyNameTile_urlencoded();
        foreach ($categories as $key=>$category){
            $category_ID = $category->ID;
            $category_name = $category->name;
            $category_title = $category->title;
            $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category($category_ID);
            //装箱
            $nav[$key]["name"] = $category_name;
            $nav[$key]["title"] = $category_title;
            $nav[$key]["products"] = $products;
        }
        $data_nav = urldecode(json_encode($nav));

        //写入文件
        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR;
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $name = "nav.json";
        $file = "$dir$name";

        file_put_contents($file,$data_nav);
        return $file;
    }

    function  datatables(){
        $dir = dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR;
        $name = "data_datatables.json";
        $file = "$dir$name";
        if (!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $data = [];
        $category_index = 0;
        // pojo 类型
        $ProductCategories = $this->CategoryService->all();
        foreach ($ProductCategories as $ProductCategory){
            $product_category_ID = $ProductCategory->ID;
            $category_name = $ProductCategory->name;
            $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category($product_category_ID);
            foreach ($products as $product){
                $data[$category_index][0] = $category_name;
                $data[$category_index][1] = $product["name"];
                $data[$category_index][2] = $product["title"];
                $category_index++;
            }

        }
        $datatables["data"] =  $data;
//        echo "<pre>";
//        var_dump($datatables);

        file_put_contents($file,urldecode(json_encode($datatables)));
        echo $file;

    }
}