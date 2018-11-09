<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <ul class="list-group list-group-flush">

                <?php foreach($pojos as $pojo){ ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a
                            class="btn btn-primary"
                            href="product_spec_item.php?action=select&ID=<?=$pojo->ID?>&product_category_ID=<?=$pojo->ID?>&title=<?=$pojo->title?>">
                            <?=$pojo->title?>
                            <span class="badge badge-light"><?=$pojo->count?></span>
                        </a>


                        <div class="btn-group" role="group" >
                            <button type="button" class="cz_add oi oi-plus btn btn-secondary"
                                    data-controller="product_specController.php"
                                    data-data='{"product_category_ID":"<?=$pojo->ID?>","title":"<?=$pojo->title?>"}'
                            > </button>
                        </div>


                    </li>
                <?php }?>
            </ul>
        </div>
        <div class="col-9">
            <div id="content">  </div>
        </div>
    </div>
</div>

