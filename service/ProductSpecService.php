<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ProductSpecDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."ProductSpecInfoPojo.php";
/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/7
 * Time: 16:45
 */
class ProductSpecService
{
    public $dao;
    function __construct()
    {
        $this->dao = new ProductSpecDao();
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
        return $this->dao->insert($title,$rank,$product_category_ID,$spec);
    }

    function struct($product_category_ID){
        return $this->dao->struct($product_category_ID);
    }

    function list_($product_category_ID){
        return $this->dao->list_($product_category_ID);
    }

    function pojo($ID){
        return $this->dao->pojo($ID);
    }

    function  update($title,$rank,$ID,$spec){
        return $this->dao->update($title,$rank,$ID,$spec);
    }

}