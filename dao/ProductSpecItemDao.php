<?php
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."Dao.php";

    Class ProductSpecItemDao extends Dao {
        // 插入数据
        function insert($product_category_ID,$level,$parent_ID,$rank,$title,$name){
            $SQL="INSERT INTO `product_spec_item` (`product_category_ID`, `level`,parent_ID, `rank`, `title`, `name`) VALUES (?, ?, ?, ?, ?, ?)";
            $params_types = "iiiiss";
            $params = array($product_category_ID,$level,$parent_ID,$rank,$title,$name);
            return $this->execute($SQL, $params_types, $params);
        }

        // 插入数据 - 批量导入
        function insert_import($ID,$product_category_ID,$level,$parent_ID,$rank,$title,$name){
            $SQL="INSERT INTO `product_spec_item` (`ID`,`product_category_ID`, `level`,parent_ID, `rank`, `title`, `name`) VALUES (?,?, ?, ?, ?, ?, ?)";
            $params_types = "iiiiiss";
            $params = array($ID,$product_category_ID,$level,$parent_ID,$rank,$title,$name);
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
        function update($ID,$title,$rank,$name){
            $SQL = "UPDATE `product_spec_item` SET `title` = ? , rank=?,name=? WHERE `ID` = ?";
            $params_types = "siis";
            $params = array($title,$rank,$name,$ID);
            return $this->execute($SQL, $params_types, $params);
        }
        //首页数据
        function index(){
            $SQL = "SELECT * FROM `blood_glucose` order by timeID asc  LIMIT 10";
            return $this->query_toArray($SQL,null,null);
        }

        //level1
        function level1($product_category_ID){
            $SQL = "SELECT `ID`, `product_category_ID`, `level`, `rank`, `title`,`name`
                     FROM `product_spec_item` 
                     where product_category_ID=? and level=1
                     order by rank asc; ";
            $params_types = "i";
            $params = array($product_category_ID);
            return $this->query_toArray($SQL,$params_types,$params);
        }

        //level2
        function level2($product_category_ID,$parent_ID){
            $SQL = "SELECT `ID`, `product_category_ID`, `level`, `rank`, `title`,`name`
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