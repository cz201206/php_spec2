<?php

/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/12
 * Time: 16:14
 */
class ListDao
{

    public function all($product_category_ID){
        //全部数据
        function all(){
            $SQL = "SELECT `ID`, `name`, `title`, `rank` FROM `product_category` order by rank asc; ";
            return $this->query_toArray($SQL,null,null);
        }
    }

}