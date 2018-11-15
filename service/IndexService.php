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
}