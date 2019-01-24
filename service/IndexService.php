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
            $products = null;

            if(1==$category_ID){
                $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category_like($category_ID,'MI %');
                //装箱
                $nav[100]["name"] = $category_name;
                $nav[100]["title"] = '小米手机';
                $nav[100]["products"] = $products;
                $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category_like($category_ID,"RedMI %");
                //装箱
                $nav[101]["name"] = $category_name;
                $nav[101]["title"] = '红米手机';
                $nav[101]["products"] = $products;

                $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category_like($category_ID,'MIPad %');
                //装箱
                $nav[102]["name"] = $category_name;
                $nav[102]["title"] = "小米平板";
                $nav[102]["products"] = $products;

                $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category_like($category_ID,'黑鲨%');
                //装箱
                $nav[103]["name"] = $category_name;
                $nav[103]["title"] = "第三方手机";
                $nav[103]["products"] = $products;

            } else if(5 ==$category_ID){
                $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category_asc($category_ID);
                //装箱
                $nav[500]["name"] = $category_name;
                $nav[500]["title"] = $category_title;
                $nav[500]["products"] = $products;
            } else {
                $products = $this->SpecService->all_onlyNameTitle_urlencoded_by_category($category_ID);
                //装箱
                $nav[$key+1000]["name"] = $category_name;
                $nav[$key+1000]["title"] = $category_title;
                $nav[$key+1000]["products"] = $products;
            }

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

    function f3dName(){
        $dir_str = "D:/php/Apache24/htdocs/project/specs/data/3d";
        $dir = dir($dir_str);
        $dirs = [];
        while ($file = $dir->read()){
            $currentDir = iconv("GBK","utf-8",$file);
            $dirs[$currentDir] = $currentDir;
        }
        /*
        unset($dirs[0]);
        unset($dirs[1]);
        */
        echo "<pre>";
       echo json($dirs);
    }
}