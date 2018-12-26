<div class="container-fluid">
    <div class="row ">
        <div class="col-3">
            <span class="oi oi-flag" style="font-size: 0.8rem;">导航</span>
            <a href="contrast.html" class="oi oi-contrast float-right" style="font-size: 0.8rem;top:10px;">参数对比</a>
            <div id="nav"></div>


        </div>
        <div class="col-9">
            <span class="oi oi-magnifying-glass" style="font-size: 0.8rem;">搜索</span>
            <div class="input-group">
                <input id="cz_input_search" type="text" class="form-control" placeholder="搜索">
                <button id="cz_button_search" class=" btn btn-outline-primary " type="button">Go!</button>
            </div>
            <div class="cz_search_result " style="position:relative">
                <div class=" shadow-lg p-3 mb-5 bg-white rounded" style="position:absolute;left:1px;top:1px;width: 100%;z-index: 999">

                    <table id="example" class="display " style="width: 100%;" >
                        <thead>
                        <tr>
                            <th>分类名</th>
                            <th>产品名</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>


            <div id="container_spec" class="container">
                <div class="row justify-content-center">
                    <div class="col-1"></div>
                    <div class="col-10">

                        <div class="d-flex justify-content-center">
                            <?php require_once  __DIR__.DIRECTORY_SEPARATOR."figure.php" ?>
                            <?php require_once  __DIR__.DIRECTORY_SEPARATOR."modal.php" ?>
                        </div> <!-- d-flex justify-content-center-->
                        <!--                            参数详情-->
                        <div id="content" class="align-middle"></div>

                    </div>
                    <div class="col-1"></div>
                </div>
            </div>

        </div><!-- col9 -->
    </div>
</div>