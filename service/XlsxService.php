<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."XlsxDao.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."pojo".DIRECTORY_SEPARATOR."XlsxPojo.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."util".DIRECTORY_SEPARATOR."ChinesePinyin.class.php";
require_once dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

class XlsxService
{
    public $arr_categoryID;
    public $xlsx;

    public $files = [];
    public $dir;


    public $dao;
    public $ChinesePinyin;
    function __construct()
    {
        $this->dao = new XlsxDao();
        $this->ChinesePinyin = new ChinesePinyin();
        $this->arr_categoryID = array(
            "shouji"=>1,
            "dianshi"=>2,
            "hezi"=>3
        );

        $this->xlsx =  dirname(__DIR__).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."xlsx";
        $this->dir =  $this->xlsx;
    }

    function getCategoryID($path){
        if(false !==strpos($path,'shouji'))return 1;
        else if(false !==strpos($path,'dianshi'))return 2;
        else if(false !==strpos($path,'hezi'))return 3;
        else return 0;
    }
    public function getFiles($dir)
    {
        //global $files;
        @$handle = opendir($dir);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    $path = $dir . DIRECTORY_SEPARATOR . $file;
                    if(is_dir($path)){
                        $this->getFiles($path);
                    }else{
                        //转码
                        //$path = $dir . DIRECTORY_SEPARATOR . $file;
                        $title = iconv("GBK", "utf-8", $file);
                        $path = $dir . DIRECTORY_SEPARATOR . $title;
                        $XlsxPojo = new XlsxPojo();
                        $XlsxPojo->path = $path;
                        $XlsxPojo->title= $title;
                        $XlsxPojo->categoryID= $this->getCategoryID($path);
                        $this->files[] = $XlsxPojo;
                    }
                }
            }
        }
        closedir($handle);
        return  $this->files;
    }

    public function iterate($xlsxPath){
        $sheetIndex = 0 ;
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($xlsxPath);
        $worksheet = $spreadsheet->getSheet($sheetIndex);

        echo '<table>' . PHP_EOL;
        foreach ($worksheet->getRowIterator() as $row) {
            echo '<tr>' . PHP_EOL;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            //    even if a cell value is not set.
            // By default, only cells that have a value
            //    set will be iterated.
            foreach ($cellIterator as $cell) {
                echo '<td>' .
                    $cell->getValue() .
                    '</td>' . PHP_EOL;
            }
            echo '</tr>' . PHP_EOL;
        }
        echo '</table>' . PHP_EOL;
    }

//region 旧库
    public function addProcess($title,$rank){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->insert($title,$name,$rank);
    }

    public function updateProcess($ID,$title,$rank){
        $name = $this->ChinesePinyin->TransformWithoutTonedeleteCode($title);
        return $this->dao->update($ID,$title,$name,$rank);
    }

    public function all(){
        $pojos = [];
        $array_product_category = $this->dao->all();
        foreach ($array_product_category as $product_category ){
            $pojos[] = new ProductCategoryPojo(
                $product_category["ID"],
                $product_category["name"],
                $product_category["title"],
                $product_category["rank"]
            );
        }
        return $pojos;
    }

    public function all_onlyNameTile_urlencoded(){

        $pojos = [];
        $array_product_category = $this->dao->all_onlyNameTile_urlencoded();
        foreach ($array_product_category as $product_category ){
            $pojos[] = new ProductCategoryPojo(
                $product_category["ID"],
                $product_category["name"],
                $product_category["title"],
                null
            );
        }
        return $pojos;
    }

}
//endregion