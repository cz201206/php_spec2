<?php
require 'vendor/autoload.php';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("e:/phone.xlsx");
$worksheet = $spreadsheet->getActiveSheet();
$level1Title = "";

$name = "";
$title = "";
$level = "";
$rank = "";
$product_category_ID = "";
$parent_ID = "";
//多行数据
foreach ($worksheet->getRowIterator() as $row) {

    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,

    //一行数据
    foreach ($cellIterator as $cell) {
        $cellColumn = $cell->getColumn();
        $cellRow = $cell->getRow();
        $cellValue = $cell->getValue();
        // A 列处理区
        if('A'===$cellColumn){
            //新一级出现时处理区
            if(NULL!== $cellValue){
                $level1Title = $cellValue;
            }else{

            }
            // B 列处理区
        }elseif ('B'===$cellColumn){
            echo "$level1Title:$cellValue<br/>";
        }
    }

}

?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."test".DIRECTORY_SEPARATOR."framework.php"?>

