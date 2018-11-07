<div class="container-fluid">
    <div class="row">
        <div class="col-3">

            <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header"><?=$_GET["title"]?></div>
                <div class="card-body">
                    <a class="a_ajax" href="controller/product_spec_itemController.php?action=add&level=1&product_category_ID=<?=$_GET["ID"]?>&method=post"><span class="oi oi-plus" style="font-size: 0.8rem;"></span> 新增参数项</a>

                    <?php require_once __DIR__.DIRECTORY_SEPARATOR."accordion.php"?>

                </div>
            </div>
        </div>
        <div class="col-9">
            <div id="content">  </div>
        </div>
    </div>
</div>

