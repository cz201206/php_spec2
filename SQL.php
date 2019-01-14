<?php
require_once 'vendor/autoload.php';
require_once 'pojo/ProductSpecItemPojo.php';
require_once 'pojo/SpecPojo.php';
require_once "util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";
require_once "util".DIRECTORY_SEPARATOR."fn.php";
require_once "dao".DIRECTORY_SEPARATOR."ProductSpecItemDao.php";
require_once "dao".DIRECTORY_SEPARATOR."ProductSpecDao.php";

//请求参数
$product_category_title = $_GET["product_category_title"];//产品类别中文名称
$dataType = $_GET["dataType"];//导入参数 or 参数项依据

//region 公共资源
$ChinesePinyin = new ChinesePinyin();
$SpecItemDAO = new ProductSpecItemDao();
$ProductSpecDao = new ProductSpecDao();
$xlsxPath = __DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."xlsx".DIRECTORY_SEPARATOR;
$product_category_ID = 0;
$sheetIndex = 0 ;

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
        $pojo->rank = $count;
        $pojo->title = $worksheet->getCell($coordinate_model)->getValue();
        $pojo->name = $ChinesePinyin->TransformWithoutTonedeleteCode($pojo->title);
        $cellIterator = $column->getCellIterator();
        foreach ($cellIterator as $cell) {
            $cellValue = $cell->getValue();
            if('产品图'!=$cellValue){
                //单元格相关信息
                $cellColumn = $cell->getColumn();
                $cellRow = $cell->getRow();

                //将单元格值包装为对象
                $coordinate_spec = "B$cellRow";
                $specTitle = $worksheet->getCell($coordinate_spec)->getValue();
                $specName = $ChinesePinyin->TransformWithoutTonedeleteCode($specTitle);
                //特殊处理
                if('详细参数'==$specTitle)$specName = $ChinesePinyin->TransformWithoutTonedeleteCode('机型');
                //将单元格内的换行替换为 <br/>
                $cellValue = str_replace(array("\r\n", "\r", "\n"), '<br/>', $cellValue);

                //将 name 和 参数值 包装为关联数组，并存入 $specs 中
                $specs["$specName"] = $cellValue;

                //只提取两行数据
                //if(2===$cellRow)break;
            }else{

            }
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
    //$product_category_ID 为产品分类 ID 手机为1，电视为2，盒子为3
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
                if (NULL !== $cellValue&&'参数项'!=$cellValue) {
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
                //除去多余项
                if('产品图'!=$cellValue&&'产品卖点'!=$cellValue){
                    $level2Title = $cellValue;
                    $level2ID++;
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
                }else{

                }

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

switch ($product_category_title){
    case "手机" :
        $product_category_ID = 1;//产品类别 ID
        $xlsxPath .= "全机型参数表参数项.xlsx";
        $xlsxPath = iconv("UTF-8", "GBK//IGNORE",$xlsxPath);
        $sheetIndex = 0;
        break;
    case "电视":
        $product_category_ID = 2;//产品类别 ID
        $xlsxPath .= "电视盒子全机型参数表汇总.xlsx";
        $xlsxPath = iconv("UTF-8", "GBK//IGNORE",$xlsxPath);
        $sheetIndex = 0;
        break;
    case "盒子":
        $product_category_ID = 3;//产品类别 ID
        $xlsxPath .= "电视盒子全机型参数表汇总.xlsx";
        $xlsxPath = iconv("UTF-8", "GBK//IGNORE",$xlsxPath);
        $sheetIndex = 1;
        break;
}

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load($xlsxPath);
$worksheet = $spreadsheet->getSheet($sheetIndex);

//执行的操作
switch ($dataType){
    case "specItem":
        importSpectItemToDB($product_category_ID);
        break;
    case "spec":
        importSpecDatas($worksheet, $product_category_ID, $ChinesePinyin, $ProductSpecDao);
        break;
}


//endregion



//region 测试代码
echo "<pre>";
var_dump($_GET);
var_dump($xlsxPath);
//showSpectItem($worksheet);
//endregion
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."SQL".DIRECTORY_SEPARATOR."framework.php"?>

