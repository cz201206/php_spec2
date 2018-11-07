<?php
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."Dao.php";

    Class ProductSpecItemDao extends Dao {
        // 插入数据
        function insert($product_category_ID,$level,$rank,$title){
            $SQL="INSERT INTO `product_spec_item` (`product_category_ID`, `level`, `rank`, `title`) VALUES (?, ?, ?, ?)";
            $params_types = "iiis";
            $params = array($product_category_ID,$level,$rank,$title);
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
        //全部数据
        function all($product_category_ID){
            $SQL = "SELECT `ID`, `product_category_ID`, `level`, `rank`, `title`
                     FROM `product_spec_item` 
                     where product_category_ID=$product_category_ID 
                     order by rank asc; ";
            return $this->query_toArray($SQL,null,null);
        }

        //附加信息
        function count(){
            $SQL = "SELECT COUNT(*) count FROM product_category WHERE ID>=0;";
            return $this->query_toArray($SQL,null,null);
        }
    }
?>