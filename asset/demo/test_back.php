<?php
require 'vendor/autoload.php';
require_once "dao".DIRECTORY_SEPARATOR."ProductSpecDao.php";
$ProductSpecDao = new ProductSpecDao();

//显示 title  和 name
$db_datas = $ProductSpecDao->all_by_category(1);

?>

<table>
    <?php foreach($db_datas as $data){ ?>

        <tr>
            <td><?=$data["title"]?></td>
            <td><?=$data["name"]?></td>
        </tr>

    <?php }?>
</table>
