<div class="container-fluid">
    <div class="row">
        <div class="col-3">

            <div id="nav"></div>


        </div>
        <div class="col-9">

            <div class="input-group">
                <input id="cz_input_search" type="text" class="form-control" placeholder="搜索">
				<button id="cz_button_search" class=" btn btn-outline-primary " type="button">Go!</button>
            </div>
            <div class="cz_search_result " style="position:relative">
            <div class=" shadow-lg p-3 mb-5 bg-white rounded" style="position:absolute;left:1px;top:1px;width: 100%;">

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

            <table class="cz_table_fn" style="margin-top: 15px;">
                <tr>
                    <td>选项</td>
                    <td>
                        <input type="checkbox" id="cbCheckbox1"/> 高亮不同项
                    </td>
                    <td>
                        <input type="checkbox" id="cbCheckbox2"/> 隐藏相同项
                    </td>
                </tr>
            </table>
            <div id="content">

            </div>
        </div>
    </div>
</div>

