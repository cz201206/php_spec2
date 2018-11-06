<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ProductCategoryDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."ProductCategoryPojo.php";

class ProductCategoryService
{
    public $dao;
    function __construct()
    {
        $this->dao = new ProductCategoryDao();
    }

    public function addProcess($title){
        return $this->dao->insert($title);
    }

    public function updateProcess($ID,$title){
        return $this->dao->update($ID,$title);
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