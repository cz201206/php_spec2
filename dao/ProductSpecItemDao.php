<?php
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."Dao.php";

    Class ProductSpecItemDao extends Dao {
        // 插入数据
        function insert($product_category_ID,$level,$parent_ID,$rank,$title){
            $SQL="INSERT INTO `product_spec_item` (`product_category_ID`, `level`,parent_ID, `rank`, `title`) VALUES (?, ?, ?, ?)";
            $params_types = "iiiis";
            $params = array($product_category_ID,$level,$parent_ID,$rank,$title);
            return $this->execute($SQL, $params_types, $params);
        }

        //删除
        function delete($ID){
            $SQL="DELETE FROM `blood_glucose` WHERE `blood_glucose`.`ID` = ?";
            $params_types = "i";
            $params = array($ID);
            return $this->execute($SQL, $params_types, $params);
        }

        //更新
        function update($ID,$title){
            $SQL = "UPDATE `product_category` SET `title` = ? WHERE `ID` = ?";
            $params_types = "si";
            $params = array($title,$ID);
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

        //附加信息
        function count(){
            $SQL = "SELECT COUNT(*) count FROM product_category WHERE ID>=0;";
            return $this->query_toArray($SQL,null,null);
        }
    }
?>