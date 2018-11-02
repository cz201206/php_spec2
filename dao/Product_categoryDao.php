<?php
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."Dao.php";

    Class Product_categoryDao extends Dao {
        // 插入数据
        function insert($value0){
            $time_insert = date("Y-m-d");
            $timeID = date("Ymd");
            $SQL="INSERT INTO `blood_glucose` (`ID`, `time_insert`, `time_update`, `value0`, `timeID`) values (NULL, '$time_insert', CURRENT_TIMESTAMP, ?, $timeID)";
            $params_types = "d";
            $params = array($value0);
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
        function update($ID,$value0){
            $SQL = "UPDATE `blood_glucose` SET `value0` = ? WHERE `blood_glucose`.`ID` = ?";
            $params_types = "di";
            $params = array($value0,$ID);
            return $this->execute($SQL, $params_types, $params);
        }
        //首页数据
        function index(){
            $SQL = "SELECT * FROM `blood_glucose` order by timeID asc  LIMIT 10";
            return $this->query_toArray($SQL,null,null);
        }

        //附加信息
        function count(){
            $SQL = "SELECT COUNT(*) count FROM product_category WHERE ID>=0;";
            return $this->query_toArray($SQL,null,null);
        }
    }
?>