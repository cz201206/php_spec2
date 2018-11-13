<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <ul class="list-group list-group-flush">

                <?php foreach($pojos as $pojo){ ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <button
                            class="cz_list btn btn-primary"
                            data-controller="product_specController.php"
                            data-data='{"action":"list","product_category_ID":<?=$pojo->ID?>}'>
                            <?=$pojo->title?>
                            <span class="badge badge-light"><?=$pojo->count?></span>
                        </button>


                        <div class="btn-group" role="group" >
                            <button type="button" class="cz_add btn btn-secondary"
                                    data-controller="product_specController.php"
                                    data-data='{"product_category_ID":"<?=$pojo->ID?>","title":"<?=$pojo->title?>"}'
                            > <span class=" oi oi-plus "></span></button>
                            <button class="cz_publish btn btn-primary"
                                    data-controller="product_specController.php"
                                    data-data='{"action":"publish","product_category_ID":"<?=$pojo->ID?>","title":"<?=$pojo->title?>"}'>
                                发布</button>
                        </div>


                    </li>
                <?php }?>
                <li class="list-group-item d-flex justify-content-between align-items-center">

                    <button class="cz_datatables btn btn-primary"
                            data-controller="product_specController.php"
                            data-data='{"action":"datatables"}'>
                        更新搜索数据</button>

                </li>
            </ul>
        </div>
        <div class="col-9">
            <div id="content">  </div>
        </div>
    </div>
</div>

