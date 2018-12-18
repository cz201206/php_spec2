<?php
require 'vendor/autoload.php';
require 'pojo/ProductSpecItemPojo.php';
require_once "util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";
require_once "dao".DIRECTORY_SEPARATOR."ProductSpecItemDao.php";

$ChinesePinyin = new ChinesePinyin();
$SpecItemDAO = new ProductSpecItemDao();

$xlsxPath = "e:/phone.xlsx";
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load($xlsxPath);
$worksheet = $spreadsheet->getActiveSheet();

echo "<pre>";
echo "文件位置：$xlsxPath<p>";


function showSpectItem($worksheet)
{
    $level1Title = "";$level1ID = 0;
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
            if ('A' === $cellColumn) {
                //新一级出现时处理区
                if (NULL !== $cellValue) {
                    $level1Title = $cellValue;
                } else {

                }
                // B 列处理区
            } elseif ('B' === $cellColumn) {
                echo "$level1Title:$cellValue<br/>";
            }
        }

    }
}
function pojos($worksheet,$product_category_ID){
    global $ChinesePinyin;
    $level1s = array();
    $level1 = null;
    $level1Title = "";$level1ID = $product_category_ID*100;
    $level2Title = "";$level2ID = $product_category_ID*1000;
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
            if ('A' === $cellColumn) {
                //新一级出现时处理区
                if (NULL !== $cellValue) {
                    $level1Title = $cellValue;$level1ID++;
                    $level1 = new ProductSpecItemPojo();

                    $level1->ID = $level1ID;
                    $level1->title = $cellValue;
                    $level1->rank = $level1ID;
                    $level1->name = $ChinesePinyin->TransformWithoutTonedeleteCode($cellValue);
                    $level1->product_category_ID = $product_category_ID;//1为手机分类
                    $level1->parent_ID = 0;//一级节点没有父节点
                    $level1->level = 1;//一级节点没有父节点
                    $level1->children = [];

                    //保存当前一级节点
                    $level1s[] = $level1;
                } else {

                }
                // B 列处理区
            } elseif ('B' === $cellColumn) {
                $level2Title = $cellValue;$level2ID++;
                $level2 = new ProductSpecItemPojo();

                $level2->ID = $level2ID;
                $level2->title = $cellValue;
                $level2->rank = $level2ID;
                $level2->name = $ChinesePinyin->TransformWithoutTonedeleteCode($cellValue);
                $level2->product_category_ID = $product_category_ID;//1为手机分类
                $level2->parent_ID = $level1ID;
                $level2->level = 2;
                $level2->children = null;
                $level1->children[] = $level2;
            }
        }

    }
    return $level1s;
}
function importToDB($product_category_ID){
    global $worksheet,$SpecItemDAO;
    $pojos = pojos($worksheet,$product_category_ID);
    foreach($pojos as $pojo){
        $SpecItemDAO->insert_import($pojo->ID,$pojo->product_category_ID,$pojo->level,$pojo->parent_ID,$pojo->rank,$pojo->title,$pojo->name);
        echo "<pre>";
        echo "导入1：$pojo->title<br/>";
        foreach($pojo->children as $pojo2){
            $SpecItemDAO->insert_import($pojo2->ID,$pojo2->product_category_ID,$pojo2->level,$pojo2->parent_ID,$pojo2->rank,$pojo2->title,$pojo2->name);
            echo "导入：$pojo2->title<br/>";
        }
    }
}
importToDB(1);
//showSpectItem($worksheet);

?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."SQL".DIRECTORY_SEPARATOR."framework.php"?>

