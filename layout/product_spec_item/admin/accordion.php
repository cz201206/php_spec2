<!--抽屉-->
<div class="accordion" id="accordionExample"> <!-- 改id1 -->

    <?php foreach($pojos as $key=>$level1){ ?>

        <div class="card"><!-- 一层 -->
            <!-- 标题 -->
            <div class="card-header" id="heading<?=$key?>"> <!-- 改id2 -->
                <h5 class="mb-0">


                    <a id="level1_<?=$level1->ID?>"
                       class="btn btn-link"
                       href="product_spec_item.php?action=update&ID=<?=$level1->ID?>&title=<?=$level1->title?>&rank=<?=$level1->rank?>"
                       type="button" data-toggle="collapse" data-target="#collapse<?=$key?>" aria-expanded="true" aria-controls="collapse<?=$key?>"> <!-- 对应 id3(data-target，aria-controls)-->
                        <?=$level1->rank?>.<?=$level1->title?>
                    </a>

                    <span class="align-bottom float-right cz_update oi oi-pencil badge-primary badge-pill" style="cursor: pointer;margin-top: 8px;"></span>

                </h5>
            </div>
            <!--  内容  -->
            <div id="collapse<?=$key?>" class="collapse <?=($card->isShow)?"show":""?>" aria-labelledby="heading<?=$key?>" data-parent="#accordionExample"> <!-- 改id3,对应 id2 (aria-labelledby),对应 id1 (data-parent) -->
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <a class="a_ajax" href="controller/product_spec_itemController.php?action=add&level=2&parent_ID=<?=$level1->ID?>&product_category_ID=<?=$_GET["product_category_ID"]?>&method=post"><span class="oi oi-plus" style="font-size: 0.8rem;"></span> 新增二级参数项</a>

                        <?php foreach($level1->children as $key=>$level2){ ?>

                            <li class="list-group-item">
                                <span href="product_spec_item.php?action=update&ID=<?=$level2->ID?>&title=<?=$level2->title?>&rank=<?=$level2->rank?>"> <?=$level2->rank?>.<?=$level2->title?></span>
                                <span class="float-right cz_update oi oi-pencil badge-primary badge-pill" style="cursor: pointer;margin-top: 2px;"></span>&nbsp;
                                <span class="float-right cz_delete oi oi-delete badge-danger badge-pill" style="cursor: pointer;margin-top: 2px;"></span>
                            </li>

                        <?php }?>
                    </ul>
                </div>
            </div>
        </div> <!-- card 复制结尾-->

    <?php }?>

</div><!-- accordion 复制结尾-->

