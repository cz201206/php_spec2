<?php
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."Dao.php";

    Class XlsxDao extends Dao {
        // 插入数据
        function insert($title,$name,$rank){
            $SQL="INSERT INTO `product_category` (`ID`, `name`, `title`, `rank`) VALUES (NULL, ?, ?, ?)";
            $params_types = "ssi";
            $params = array($name,$title,$rank);
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
        function update($ID,$title,$name,$rank){
            $SQL = "UPDATE `product_category` SET `title` = ?,name=?,rank=? WHERE `ID` = ?";
            $params_types = "ssii";
            $params = array($title,$name,$rank,$ID);
            return $this->execute($SQL, $params_types, $params);
        }
        //首页数据
        function index(){
            $SQL = "SELECT * FROM `blood_glucose` order by timeID asc  LIMIT 10";
            return $this->query_toArray($SQL,null,null);
        }

        //全部数据
        function all(){
            $SQL = "SELECT `ID`, `name`, `title`, `rank` FROM `product_category` order by rank asc; ";
            return $this->query_toArray($SQL,null,null);
        }

        //全部数据
        function all_onlyNameTile_urlencoded(){
            $SQL = "SELECT  `name`, `title`,ID FROM `product_category` order by rank asc; ";//
            return $this->query_toArray_urlencode($SQL,null,null);
        }

        //附加信息
        function count(){
            $SQL = "SELECT COUNT(*) count FROM product_category WHERE ID>=0;";
            return $this->query_toArray($SQL,null,null);
        }
    }
?>