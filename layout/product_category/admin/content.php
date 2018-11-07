<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a class="a_ajax" href="controller/product_categoryController.php?action=add&method=post"><span class="oi oi-plus" style="font-size: 0.8rem;"></span> 新增品类</a>

                </li>
                <?php foreach($pojos as $pojo){ ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a  id="pojo_<?=$pojo->ID?>" href="product_spec_item.php?action=select&product_category_ID=<?=$pojo->ID?>&title=<?=$pojo->title?>"><?=$pojo->title?></a>
                    <span class="cz_update oi oi-pencil badge-primary badge-pill" style="cursor: pointer;"></span>
                </li>
                <?php }?>
            </ul>
        </div>
        <div class="col-10">
            <div id="content">  </div>
        </div>
    </div>
</div>

