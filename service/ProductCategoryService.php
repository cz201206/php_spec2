<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ProductCategoryDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."ProductCategoryPojo.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";

class ProductCategoryService
{
    public $dao;
    public $ChinesePinyin;
    function __construct()
    {
        $this->dao = new ProductCategoryDao();
        $this->ChinesePinyin = new ChinesePinyin();
    }

    public function addProcess($title){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->insert($title,$name);
    }

    public function updateProcess($ID,$title){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->update($ID,$title,$name);
    }

    public function all(){
        $pojos = [];
        $array_product_category = $this->dao->all();
        foreach ($array_product_category as $product_category ){
            $pojos[] = new ProductCategoryPojo(
                $product_category["ID"],
                $product_category["name"],
                $product_category["title"],
                $product_category["rank"]
            );
        }
        return $pojos;
    }

}