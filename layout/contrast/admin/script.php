<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/public/lib/DataTables/1.10.15/datatables.min.js"></script>
<script src="/public/lib/DataTables/extensions/Select/js/dataTables.select.min.js"></script>
<script src="/public/lib/jquery/jquery.form.js" ></script>
<script src="/public/project/specs/js/fn.js"></script>
<!--绘制圆图标-->
<script type="text/javascript">//对象获取，变量声明定义
    //canvas jquery 对象
    var canvas_Navbar = $("#canvas_Navbar");
    //canvas js 对象
    var ctx=canvas_Navbar[0].getContext("2d");
</script>

<!--搜索表格-->
<script>
    $.ajaxSettings.async = false;
    var table = $('#example').DataTable({
        "ajax":'data/data_datatables.json' ,
        'language': {
            'emptyTable': '没有数据',
            'loadingRecords': '加载中...',
            'processing': '查询中...',
            'search': '',
            'lengthMenu': '每页 _MENU_ 件',
            'zeroRecords': '没有数据',
            'paginate': {
                'first':      '第一页',
                'last':       '最后一页',
                'next':       '下一页',
                'previous':   '上一页'                       },
            'info': '',
            'infoEmpty': '',
            'infoFiltered': ''
        },
        "lengthChange": false,
        "paging": false,
        "select":true,
        "columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [1],
                "visible": false,
                "searchable": false
            },
            { "width": "5%", "targets": [2] }
        ]
    });
    //添加搜索框样式
    $("label input").addClass("form-control");
    $("label input").attr("placeholder","搜索 产品...");
    // 添加搜索框容器样式
    $(".dataTables_filter label").addClass("container zeroPadding");
    //隐藏自带搜索框
    $("label input").hide();
</script>

<!--搜索框-->
<script type="text/javascript">//3.监听搜索事件
    //点击搜索按钮的搜索
    $("#cz_button_search").on("click", function() {
        table.search($("#cz_input_search").val()).draw();
        $("#example").css("display","inline");
    });
    //Enter键事件
    $('#cz_input_search').keydown(function(e){
        if(e.keyCode==13){
            table.search($(this).val()).draw();
            $("#example").css("display","inline");
        }
    });
</script>

<!--点击事件-->
<script type="text/javascript">//3.监听搜索事件
    table.on( 'select', function ( e, dt, type, indexes ) {
        var dataRow = table.rows( indexes ).data();
        console.log(dataRow[0]);
        $("#example").css("display","none");
    })
</script>



