<div class="container">
    <div class="row">
        <div class="col-4">
            <?php foreach($array_card as $key=>$card){ ?>
                <!--抽屉-->
                <div class="accordion" id="accordionExample<?=$key?>"> <!-- 改id1 -->

                    <div class="card"><!-- 一层 -->
                        <!-- 标题 -->
                        <div class="card-header" id="heading<?=$key?>"> <!-- 改id2 -->
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?=$key?>" aria-expanded="true" aria-controls="collapse<?=$key?>"> <!-- 对应 id3(data-target，aria-controls)-->
                                    <?=$card->title?>
                                </button>
                            </h5>
                        </div>
                        <!--  内容  -->
                        <div id="collapse<?=$key?>" class="collapse <?=($card->isShow)?"show":""?>" aria-labelledby="heading<?=$key?>" data-parent="#accordionExample<?=$key?>"> <!-- 改id3,对应 id2 (aria-labelledby),对应 id1 (data-parent) -->
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php foreach($card->navItems as $key=>$navItem){ ?>

                                        <li class="list-group-item"> <a href="<?=$navItem->anchor?>"> <?=$navItem->title?></a></li>

                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- card 复制结尾-->



                </div><!-- accordion 复制结尾-->
            <?php }?>
        </div>
    </div>
</div>
