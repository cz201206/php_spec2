<?php

/**
 * Created by PhpStorm.
 * User: cz
 * Date: 2018/11/6
 * Time: 15:37
 */
class ProductCategoryPojo
{

    public $ID;
    public $name;
    public $title;
    public $rank;

    /**
     * ProductCategoryPojo constructor.
     * @param $ID
     * @param $name
     * @param $title
     * @param $rank
     */
    public function __construct($ID, $name, $title, $rank)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->title = $title;
        $this->rank = $rank;
    }


}