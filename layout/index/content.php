<div class="container-fluid" style="padding-top: 15px;">
    <div class="row">
        <div class="col-3">
            <button type="button"
                    class="cz_datatables btn btn-primary btn-lg btn-block"
                    data-controller="product_specController.php"
                    data-data='{"action":"datatables"}'>
                更新搜索数据
            </button>
            <button type="button"
                    class="cz_struts btn btn-secondary btn-lg btn-block"
                    data-controller="product_spec_itemController.php"
                    data-data='{"action":"struts"}'>
                更新参数项数据
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

