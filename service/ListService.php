<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ListDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."ProductCategoryPojo.php";
/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/12
 * Time: 16:13
 */
class ListService
{
    public $dao;
    function __construct()
    {
        $this->dao = new ListDao();
    }

    public function all($product_category_ID){
        $this->dao->all($product_category_ID);
    }

}