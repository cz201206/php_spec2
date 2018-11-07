<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ProductSpecItemDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."ProductSpecItemPojo.php";
/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/7
 * Time: 16:45
 */
class ProductSpecItemService
{
    public $dao;
    function __construct()
    {
        $this->dao = new ProductSpecItemDao();
    }

    public function addProcess($product_category_ID,$level,$rank,$title){
        return $this->dao->insert($product_category_ID,$level,$rank,$title);
    }

    public function updateProcess($ID,$title){
        return $this->dao->update($ID,$title);
    }

    public function all($product_category_ID){
        $pojos = [];
        $array_ProductSpecItem = $this->dao->all($product_category_ID);
        foreach ($array_ProductSpecItem as $ProductSpecItem ){
            $pojo = new ProductSpecItemPojo();
            $pojo->ID = $ProductSpecItem["ID"];
            $pojo->product_category_ID = $ProductSpecItem["product_category_ID"];
            $pojo->level = $ProductSpecItem["level"];
            $pojo->rank = $ProductSpecItem["rank"];
            $pojo->title = $ProductSpecItem["title"];
            $pojos[] = $pojo;
        }
        return $pojos;
    }
}