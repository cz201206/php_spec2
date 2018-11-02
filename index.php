<?php
    require_once __DIR__.DIRECTORY_SEPARATOR."dao".DIRECTORY_SEPARATOR."IndexDao.php";
    $lenghOfSide = 20;
    $radius = 5;
    $IndexDao = new IndexDao();
    $count = $IndexDao->count()[0]["count"];

    $count_product_category = $count;
?>

<?php require_once __DIR__.DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."index".DIRECTORY_SEPARATOR."framework.php"?>

