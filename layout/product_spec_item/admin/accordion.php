<!--抽屉-->
<div class="accordion" id="accordionExample"> <!-- 改id1 -->

    <?php foreach($pojos as $key=>$pojo){ ?>

        <div class="card"><!-- 一层 -->
            <!-- 标题 -->
            <div class="card-header" id="heading<?=$key?>"> <!-- 改id2 -->
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?=$key?>" aria-expanded="true" aria-controls="collapse<?=$key?>"> <!-- 对应 id3(data-target，aria-controls)-->
                        <?=$pojo->title?>
                    </button>
                </h5>
            </div>
            <!--  内容  -->
            <div id="collapse<?=$key?>" class="collapse <?=($card->isShow)?"show":""?>" aria-labelledby="heading<?=$key?>" data-parent="#accordionExample"> <!-- 改id3,对应 id2 (aria-labelledby),对应 id1 (data-parent) -->
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach($card->navItems as $key=>$navItem){ ?>

                            <li class="list-group-item"> <a href="<?=$navItem->anchor?>"> <?=$navItem->title?></a></li>

                        <?php }?>
                    </ul>
                </div>
            </div>
        </div> <!-- card 复制结尾-->

    <?php }?>

</div><!-- accordion 复制结尾-->