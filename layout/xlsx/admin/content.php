<table>
    <?php foreach ($files as $file){?>
        <tr>
            <td><a class="cz_xlsx btn btn-light btn-sm" href="#" data-path="<?=$file->path?>" data-categoryID="<?=$file->categoryID?>" data-action="iterate">查看</a></td>
            <td><a class="cz_xlsx btn btn-primary btn-sm" href="#" data-path="<?=$file->path?>" data-categoryID="<?=$file->categoryID?>" data-action="import">导入</a></td>
            <td><a class="cz_xlsx btn btn-danger btn-sm" href="#" data-path="<?=$file->path?>" data-categoryID="<?=$file->categoryID?>" data-action="update">更新</a></td>
            <td><a class="cz_xlsx btn btn-primary btn-sm" href="#" data-path="<?=$file->path?>" data-categoryID="<?=$file->categoryID?>" data-action="importStruct">导入结构</a></td>
            <td><?=$file->title?></td>
        </tr>
    <?php }?>
</table>

<div id="content"></div>
