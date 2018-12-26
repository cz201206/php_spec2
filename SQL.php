<?php
require_once 'vendor/autoload.php';
require_once 'pojo/ProductSpecItemPojo.php';
require_once 'pojo/SpecPojo.php';
require_once "util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";
require_once "util".DIRECTORY_SEPARATOR."fn.php";
require_once "dao".DIRECTORY_SEPARATOR."ProductSpecItemDao.php";
require_once "dao".DIRECTORY_SEPARATOR."ProductSpecDao.php";

//region 公共资源
$ChinesePinyin = new ChinesePinyin();
$SpecItemDAO = new ProductSpecItemDao();
$ProductSpecDao = new ProductSpecDao();
$xlsxPath = "";
$product_category_ID = 0;

//确定提取文件
if('手机'===$_GET["product_category_title"]&&'specItem'===$_GET["dataType"]){
    $xlsxPath = "e:/phone.xlsx";
}elseif ('手机'===$_GET["product_category_title"]&&'spec'===$_GET["dataType"]){
    $xlsxPath = "e:/phone_data.xlsx";
}

//确定产品分类 ID
switch ($_GET["product_category_title"]){
    case "手机" : $product_category_ID = 1;break;
}

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load($xlsxPath);
$worksheet = $spreadsheet->getActiveSheet();
//endregion

//region 测试代码
echo "<pre>";
var_dump($_GET);
var_dump($xlsxPath);
/**
 * @param $worksheet
 * @param $product_category_ID
 * @param $ChinesePinyin
 * @param $ProductSpecDao
 */



//endregion


function importSpecDatas($worksheet, $product_category_ID, $ChinesePinyin, $ProductSpecDao)
{
    $count = 0;//列计数
    $rankPartner = 1000; //排序伴侣，逆序
    $pojos_spec = [];
    foreach ($worksheet->getColumnIterator() as $column) {
        $specs = [];
        //提取列的列号
        $ColumnIndex = $column->getColumnIndex();
        //去除两个参数项列
        if ('A' === $ColumnIndex || 'B' === $ColumnIndex) continue;
        $count++;
        //打印提取数据列号
        echo "$ColumnIndex ";
        //机型单元格坐标
        $coordinate_model = $ColumnIndex . '1';
        //提取列数据
        $pojo = new SpecPojo();
        //$pojo->$ID;
        $pojo->product_category_ID = $product_category_ID;
        $pojo->rank = $rankPartner - $count;
        $pojo->title = $worksheet->getCell($coordinate_model)->getValue();
        $pojo->name = $ChinesePinyin->TransformWithoutTonedeleteCode($pojo->title);
        $cellIterator = $column->getCellIterator();
        foreach ($cellIterator as $cell) {
            //单元格相关信息
            $cellColumn = $cell->getColumn();
            $cellRow = $cell->getRow();
            $cellValue = $cell->getValue();

            //将单元格值包装为对象
            $coordinate_spec = "B$cellRow";
            $specName = $ChinesePinyin->TransformWithoutTonedeleteCode($worksheet->getCell($coordinate_spec)->getValue());
            //将单元格内的换行替换为 <br/>
            $cellValue = str_replace(array("\r\n", "\r", "\n"), '<br/>', $cellValue);

            //将 name 和 参数值 包装为关联数组，并存入 $specs 中
            $specs["$specName"] = $cellValue;

            //只提取两行数据
            //if(2===$cellRow)break;
        }
        //最终单元格的数据库格式
        $pojo->spec = json($specs);
        //数据中添加新元素
        $pojos_spec[] = $pojo;

        //导入到数据库中
        $ProductSpecDao->insert($pojo->name, $pojo->title, $pojo->rank, $pojo->product_category_ID, $pojo->spec);

        //先提取两列数据做为测试
        //if( 'D' === $ColumnIndex)break;
    }
//var_dump($pojos_spec);
    echo "<p>总计：$count<p/>";
}
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
function pojos_specItem($worksheet, $product_category_ID){
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
function importSpectItemToDB($product_category_ID){
    global $worksheet,$SpecItemDAO;
    $pojos = pojos_specItem($worksheet,$product_category_ID);
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

//region 执行区
//importSpectItemToDB(1);
//importSpecDatas($worksheet, $product_category_ID, $ChinesePinyin, $ProductSpecDao);
//showSpectItem($worksheet);
//endregion

if('手机'===$_GET["product_category_title"]&&'specItem'===$_GET["dataType"]){
    importSpectItemToDB(1);
}elseif ('手机'===$_GET["product_category_title"]&&'spec'===$_GET["dataType"]){
    importSpecDatas($worksheet, $product_category_ID, $ChinesePinyin, $ProductSpecDao);
}
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."SQL".DIRECTORY_SEPARATOR."framework.php"?>

