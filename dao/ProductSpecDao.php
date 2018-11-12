<?php
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."Dao.php";

    Class ProductSpecDao extends Dao {
        // 插入数据
        function insert($title,$spec,$rank,$product_category_ID){
            $SQL="INSERT INTO `product_spec` ( `title`, `spec`, `rank`,`product_category_ID`) VALUES (?, ?, ?, ?)";
            $params_types = "ssii";
            $params = array($title,$spec,$rank,$product_category_ID);
            echo "<pre>";
            var_dump($params);
            return $this->execute($SQL, $params_types, $params);
        }

        //删除
        function delete($ID){
            $SQL="DELETE FROM `product_spec_item` WHERE `ID` = ?";
            $params_types = "i";
            $params = array($ID);
            return $this->execute($SQL, $params_types, $params);
        }

        //更新
        function update($ID,$title,$rank){
            $SQL = "UPDATE `product_spec_item` SET `title` = ? , rank=? WHERE `ID` = ?";
            $params_types = "sii";
            $params = array($title,$rank,$ID);
            return $this->execute($SQL, $params_types, $params);
        }
        //首页数据
        function index(){
            $SQL = "SELECT * FROM `blood_glucose` order by timeID asc  LIMIT 10";
            return $this->query_toArray($SQL,null,null);
        }

        //level1
        function level1($product_category_ID){
            $SQL = "SELECT `ID`, `product_category_ID`, `level`, `rank`, `title`
                     FROM `product_spec_item` 
                     where product_category_ID=? and level=1
                     order by rank asc; ";
            $params_types = "i";
            $params = array($product_category_ID);
            return $this->query_toArray($SQL,$params_types,$params);
        }

        //level2
        function level2($product_category_ID,$parent_ID){
            $SQL = "SELECT `ID`, `product_category_ID`, `level`, `rank`, `title`
                     FROM `product_spec_item` 
                     where product_category_ID=? and parent_ID=?
                     order by rank asc; ";
            $params_types = "ii";
            $params = array($product_category_ID,$parent_ID);
            return $this->query_toArray($SQL,$params_types,$params);
        }

        function struct($product_category_ID){
            $SQL = "
            SELECT item1.title title1,item2.title title2 from product_spec_item item1 
            right JOIN product_spec_item item2 
            on item2.parent_ID = item1.ID
            WHERE item1.product_category_ID=?
            order by item1.rank,item2.rank";
            $params_types = "i";
            $params = array($product_category_ID);
            return $this->query_toArray($SQL,$params_types,$params);
        }

        //region 附加信息

        function count(){
            $SQL = "SELECT COUNT(*) count FROM product_category WHERE ID>=0;";
            return $this->query_toArray($SQL,null,null);
        }

        function info(){
            $SQL = "SELECT category.ID, category.title,(SELECT COUNT(ID) from product_spec spec where category.ID = spec.ID ) count from product_category category";
            return $this->query_toArray($SQL,null,null);
        }

        //endregion
    }
?>