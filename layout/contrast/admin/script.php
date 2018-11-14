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

    var current_index_td = 1;
    var current_category = "";
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
    //初始化隐藏搜索框
    $("#example").css("display","none");
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

    var struct = {};
    table.on( 'select', function ( e, dt, type, indexes ) {
        var dataRow = table.rows( indexes ).data();
        var clazz = dataRow[0][0];
        var name = dataRow[0][1];
        var tilte = dataRow[0][2];
        var url_data = "data/"+clazz+"/"+name+".json";
        var url_struct = "data/struct/"+clazz+".json";
        //var product = $("#content").load(url,{});
        var data = {};


        if($("table").size()<2){
            $("#content").empty();
            $.get(url_struct, function(result){
                struct = result;
                createTable(struct,2);
            });
        }


        $.get(url_data, function(result){
            data = result;
            fillData(struct,data);
        });
        $("#example").css("display","none");
    })
</script>

<!--构造表格-->
<script>
    function createTable(struct,count_td) {
        //jquery 对象
        // var table = $("<table id='t_info'></table>");

        /*
         //新增一行
         var tr= $("<tr></tr>");
         table.append(tr);

         新增一个单元格
         var td =  $("<td>单元格1</td>");
         tr.append(td);
         */
        var table_title = $("<table id=''></table>");
        $("#content").append(table_title);
        var tr= $("<tr></tr>");
        table_title.append(tr);
        var tds = "<td id='title'class='cz_td'>产品名称</td>";
        for(var i=0;i<count_td;i++){
            tds+="<td class='cz_td'> </td>";
        }
        tr.append(tds);

        var title = $("<div>"+struct.title+"</div>");
        //$("#content").append(title);

        //构造表结构

        for(i_l1 in struct.l1 ){
            //一级
            l1 = struct.l1[i_l1];
            //一级标题
            var l1_title_ele = $("<div class='cz_border_left'>"+l1.title+"</div>");
            $("#content").append(l1_title_ele);
            //一级详情
            var table = $("<table id=table_"+i_l1+" class='spec'></table>");
            for(i_l2 in l1.children){
                var l2 = l1.children[i_l2];
                var tds = "<td class='cz_td'></td>";
                for(var i=0;i<count_td-1;i++){
                    tds+=tds;
                }
                table.append($("<tr><td id='"+l2.name+"' class='spec_item cz_td'>"+l2.title+"</td>"+tds+"</tr>"));
            }
            l1_title_ele.after(table);
        }



    }
    //填充数据
    function fillData(struct,data) {
        if(current_index_td===1){
            $("#title").next().html(data["title"]);
        }else{
            $("#title").next().next().html(data["title"]);
        }

        for(i_l1 in struct.l1 ){
            for(i_l2 in  struct.l1[i_l1].children){
                var l2 =  struct.l1[i_l1].children[i_l2];
                var name = l2.name;
                if(current_index_td===1)
                {
                    $("#"+name).next().html(data[name]);

                }
                else{
                    $("#"+name).next().next().html(data[name]);
                }

            }
        }
        if(current_index_td===1){
            current_index_td = 2;
        }else{
            current_index_td = 1;
        }

    }
</script>
<script type="text/javascript">//点击事件

    function highLightDifferent() {

        $("table.spec").each(function () {
            $(this).find("tr").each(
                function () {

                    var tdArr = $(this).children();
                    var td1 = tdArr.eq(1);
                    var td2 = tdArr.eq(2);
                    if(td1.html().trim()!=td2.html().trim()){
                        $(this).addClass("different");
                    }
                }
            );
        });
    }

    function hideSame() {
        $("table.spec").each(function () {
            $(this).find("tr").each(
                function () {

                    var tdArr = $(this).children();
                    var td1 = tdArr.eq(1);
                    var td2 = tdArr.eq(2);
                    if(td1.html().trim()===td2.html().trim()){
                        $(this).addClass("cz_same");
                    }
                }
            );
        });
    }
    //控制高亮
    $("#cbCheckbox1").click(function () {
        if ($(this).prop("checked")) {//jquery 1.6以前版本 用  $(this).attr("checked")
            highLightDifferent();
        } else {
            $(".different").each(
                function () {
                    $(this).removeClass("different");
                }
            );
        }
    });

    //控制隐藏相同项
    $("#cbCheckbox2").click(function () {
        if ($(this).prop("checked")) {//jquery 1.6以前版本 用  $(this).attr("checked")
            hideSame();
        } else {
            $(".cz_same").each(
                function () {
                    $(this).removeClass("cz_same");
                }
            );
        }
    });

</script>



