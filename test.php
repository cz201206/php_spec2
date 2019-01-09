<?php
require 'vendor/autoload.php';

$xlsxPath = __DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."xlsx".DIRECTORY_SEPARATOR."电视盒子全机型参数表汇总.xlsx";
$xlsxPath = iconv("UTF-8", "GBK//IGNORE",$xlsxPath);
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

?>
a
<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."test".DIRECTORY_SEPARATOR."framework.php"?>

