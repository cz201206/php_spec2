<div class="container-fluid" style="padding-top: 15px;">
    <div class="row">
        <div class="col-3">
            <button type="button"
                    style="margin-bottom: 15px;"
                    class="cz_struts btn btn-outline-primary btn-block"
                    data-controller="product_spec_itemController.php"
                    data-data='{"action":"struts"}'>
                生成 参数项（结构）
            </button>
            <button type="button"
                    style="width: 48%"
                    class="cz_nav btn btn-outline-primary"
                    data-controller="indexController.php"
                    data-data='{"action":"nav"}'>
                生成 导航栏
            </button>
            <button type="button"
                    style="width: 48%"
                    class="cz_datatables btn btn-outline-primary float-right"
                    data-controller="product_specController.php"
                    data-data='{"action":"datatables"}'>
                生成 搜索数据
            </button>
        </div>
        <div class="col-6">
            <div id="content"></div>
        </div>
        <div class="col-3">
            <div type="label" class="label label-success">
                产品分类总数 <span class="badge badge-light"><?=$count_product_category?></span>
                <span class="sr-only">unread messages</span>
            </div>
        </div>
    </div>
</div>






<div id="div_table1"></div>

