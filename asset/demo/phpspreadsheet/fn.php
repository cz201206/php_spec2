<?php
require 'vendor/autoload.php';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("e:/phone.xlsx");
$worksheet = $spreadsheet->getActiveSheet();
$coordinate = 'B1';
$cellValue = $worksheet->getCell($coordinate)->getValue();

//根据坐标显示一个单元格的值
function showCellValue($worksheet, $coordinate){
    $cellValue = $worksheet->getCell($coordinate)->getValue();
    if(NULL===$cellValue){
        echo '此单元格为空';
    }else{
        echo $cellValue;
    }

}
function iterate($worksheet)
{
    echo '<table>' . PHP_EOL;
    foreach ($worksheet->getRowIterator() as $row) {
        echo '<tr>' . PHP_EOL;
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
        //    even if a cell value is not set.
        // By default, only cells that have a value
        //    set will be iterated.
        $i = 0;
        foreach ($cellIterator as $cell) {
            echo '<td>' . ++$i .
                $cell->getValue() .
                '</td>' . PHP_EOL;
        }
        echo '</tr>' . PHP_EOL;
    }
    echo '</table>' . PHP_EOL;
}
function iterate1($worksheet)
{

    $level1 = '';

    echo '<table>' . PHP_EOL;
    foreach ($worksheet->getRowIterator() as $row) {
        echo '<tr>' . PHP_EOL;
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
        //    even if a cell value is not set.
        // By default, only cells that have a value
        //    set will be iterated.

        foreach ($cellIterator as $cell) {

            $cellValue = $cell->getValue();

            if('A'===$cell->getColumn()){
                if(NULL!== $cellValue){
                    $level1 = $cellValue;
                    echo '<td>' .
                        $cell->getValue() .
                        '</td>' . PHP_EOL;
                }else{
                    echo '<td>' ."$level1".
                        $cell->getValue() .
                        '</td>' . PHP_EOL;
                }

            }else{
                echo '<td>' .
//                    $cell->getValue() .
                    $cell->getFormattedValue() .
                    '</td>' . PHP_EOL;
            }

        }
        echo '</tr>' . PHP_EOL;
    }
    echo '</table>' . PHP_EOL;
}

//showCellValue($worksheet,$coordinate);
//iterate($worksheet);
//iterate1($worksheet);

?>