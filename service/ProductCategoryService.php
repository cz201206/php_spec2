<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."ProductCategoryDao.php";

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
}