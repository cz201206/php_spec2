<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/public/lib/DataTables/1.10.15/datatables.min.js"></script>
<script src="/public/lib/DataTables/extensions/Select/js/dataTables.select.min.js"></script>
<script src="/public/lib/jquery/jquery.form.js" ></script>
<script src="/public/project/specs/js/fn.js"></script>
<!--变量-->
<script type="text/javascript">//对象获取，变量声明定义
    /*
    //canvas jquery 对象
    var canvas_Navbar = $("#canvas_Navbar");
    //canvas js 对象
    var ctx=canvas_Navbar[0].getContext("2d");
*/
    var table = null;
    var current_index_td = 1;
    var current_category = "";
    var jixing = "";
    var var3dNames = {"heishayouxishouji":"heishayouxishouji","MI5SPlus":"MI5SPlus","MI5X":"MI5X","MI6":"MI6","MI6X":"MI6X","MI8":"MI8","MI8pingmuzhiwenban":"MI8pingmuzhiwenban","MI8qingchunban":"MI8qingchunban","MI8SE":"MI8SE","MI8toumingtansuoban":"MI8toumingtansuoban","MIMAX2":"MIMAX2","MIMAX3":"MIMAX3","MIMIX2quantaoci":"MIMIX2quantaoci","MIMIX2S":"MIMIX2S","MIMIX3":"MIMIX3","MINote3":"MINote3","MIPad4WIFI":"MIPad4WIFI","MIPlay":"MIPlay","MIX":"MIX","RedMI5":"RedMI5","RedMI6":"RedMI6","RedMI6Pro":"RedMI6Pro","RedMINote5":"RedMINote5","RedmiNote7":"RedmiNote7","RedMIS2":"RedMIS2","\u5c0f\u7c73\u7c73\u5bb6\u7a7a\u6c14\u68c0\u6d4b\u4eea":"小米米家空气检测仪"};
    var url_video = "http://10.237.32.10/project/portal/client/videoDetail.php?ID=";
    var video = {"heishayouxishouji":"172","heishayouxishoujiHelo":"191","RedmiNote7":"195"};
</script>

<!--方法-->
<script>
    function showFigure(data) {

        $("#figure").hide();
        //360度检测
        if(jixing in var3dNames) {
            $("#view_360_iframe").attr("src","data/3d/"+jixing);//src="http://10.237.32.11/3d/hs/"
            $("#view_360").show();
        }else{
            $("#view_360").hide();
        }
        //开箱视频检测
        if(jixing in video){
            var src = url_video+""+video[jixing];
            $("#view_video_iframe").attr("src",src);
            $("#view_video").show();
        }
        else{
            $("#view_video").hide();
        }

        //产品卖点检测
        if(data.chanpinmaidian){

            $("#sellingPoint").html(data.chanpinmaidian);
            $("#sellingPoint").show();
        }else {
            $("#sellingPoint").hide();
        }

        //图片，机型显示
        $("#figure").show();
    }
    //检测是否需要重新绘制参数表格
    function isReDrawTable(category) {
        if($("table.spec").size()<=1 || current_category!=category){
            current_index_td = 1;
            return true;
        }else{
            return false;
        }
    }
    //禁用表单元素
    function enableInput(inputs) {
        inputs.each().attr("disabled","");
    }
    //启用表单元素
    function disableInput(inputs) {
        inputs.each().attr("disabled","disabled");

    }

</script>
<script type="text/javascript">//高亮与隐藏功能

    function highLightDifferent() {

        $("table.spec").each(function () {
            $(this).find("tr").each(
                function () {

                    var tdArr = $(this).children();
                    var td1 = tdArr.eq(1);
                    var td2 = tdArr.eq(2);
                    if(td1.html().trim()!=td2.html().trim()){
                        //$(this).addClass("different");
                        $(this).addClass("alert-danger");
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


</script>
<script>
    //创建两列空白表格
    function createTable(struct,count_td,category) {
        //行 - 机型
        /*
         var table_title = $("<table id=''></table>");
         $("#content").append(table_title);
         var tr= $("<tr></tr>");
         table_title.append(tr);
         var tds = "<td id='title'class='cz_td'></td>";
         for(var i=0;i<count_td;i++){
         tds+="<td class='cz_td'> </td>";
         }
         tr.append(tds);

         var title = $("<div>"+struct.title+"</div>");
         //$("#content").append(title);
         */
        //构造表结构

        for(i_l1 in struct.l1 ){
            //一级
            l1 = struct.l1[i_l1];
            //一级标题
            var l1_title_ele = $("<div class='cz_border_left_single'>"+l1.title+"</div>");
            $("#content").append(l1_title_ele);
            //一级详情
            var table = $("<table id=table_"+i_l1+" class='spec shadow-lg p-3 mb-5 bg-white rounded'></table>");
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

        current_category = category ;

    }

    //填充机型 填充照片
    function fillData(device_name,struct,data,category) {
        $("#img").attr("src","data/img/"+category+"/"+device_name+".png");
//        $("#jixing").next().html(data["jixing"]);
        $("#jixing").html(data["jixing"]);

        //填充参数
        for(i_l1 in struct.l1 ){
            for(i_l2 in  struct.l1[i_l1].children){
                var l2 =  struct.l1[i_l1].children[i_l2];
                var name = l2.name;
                $("#"+name).next().html(data[name]);

            }
        }
    }
</script>

<!--执行-->
<script>//导航栏生成
    //$("#nav").append();
    var url_nav = "data/nav.json";

    var accordion = $("<div class='accordion' id='accordionExample1'></div>"); $("#nav").append(accordion);

    $.get(url_nav, function(result){
        for(index in result){

            var category = result[index];
            var categoryName = category.name;
            var categoryTitle = category.title;
            var products = category.products;

            var card = $("<div class='card'></div>");accordion.append(card);
            var card_header = $("<div class='card-header' id='heading"+categoryName+index+"'></div>");card.append(card_header);
            var h5 = $("<h5 class='mb-0'></h5>");card_header.append(h5);
            var button = $("<button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapse"+categoryName+index+"' aria-expanded='true' aria-controls='collapse"+categoryName+index+"'>"+categoryTitle+"</button>");h5.append(button);
            var collapse = $("<div id='collapse"+categoryName+index+"' class='collapse' aria-labelledby='heading"+categoryName+index+"' data-parent='#accordionExample1'></div>");card.append(collapse);
            var card_body = $("<div class='card-body'></div>");collapse.append(card_body);
            var ul = $("<ul class='list-group list-group-flush'></ul>");card_body.append(ul);

            for(index_product in products){
                var product = products[index_product];
                var productName = product.name;
                var productTitle = product.title;

                var li = $("<li class='list-group-item'></li>");ul.append(li);
                var span = $("<span class='cz_nav_product' data-category='"+categoryName+"' data-name='"+productName+"'><a href='#'>"+productTitle+"</a></span>");li.append(span);
                span.click(function () {
                    var category = $(this).data("category");
                    var name = $(this).data("name");
                    var url_struct = "data/struct/"+category+".json";
                    var url_data = "data/"+category+"/"+name+".json";

                    if(isReDrawTable(category)){
                        console.log(current_category+"::"+category);
                        $("#content").empty();
                        $.get(url_struct, function(result){
                            struct = result;
                            createTable(struct,1,category);
                        });
                    };


                    $.get(url_data, function(result){
                        data = result;
                        jixing = name;
                        fillData(name,struct,data,category);
                    });

                    //显示图片

                    showFigure(data);
                });
                //$("#nav").append(categoryName+index+"/"+productName+"<p>");
            }

        }



    });
</script>
<script>
    $.ajaxSettings.async = false;
    table = $('#example').DataTable({
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
    //    $("#example").css("display","none");
    $(".cz_search_result").addClass("invisible");
</script>
<script>
    //drawCircle_icon();
</script>

<!--监听-->
<script>
   /*
    $(document).ready(function() {
        alert( $(".cz_nav_product").length);
        //导航栏点击
        $(".cz_nav_product").click(function () {
            alert("点击了导航栏");
            var category = $(this).data("category");
            var name = $(this).data("name");
            var url_struct = "data/struct/"+category+".json";
            var url_data = "data/"+category+"/"+name+".json";

            if(isReDrawTable(category)){
                console.log(current_category+"::"+category);
                $("#content").empty();
                $.get(url_struct, function(result){
                    struct = result;
                    createTable(struct,1,category);
                });
            };


            $.get(url_data, function(result){
                data = result;
                fillData(struct,data);
            });

            //显示图片
            showFigure();
        });
    });
    */
</script>
<script type="text/javascript">//搜索框搜索事件
    //点击搜索按钮的搜索
    $("#cz_button_search").on("click", function() {
        table.search($("#cz_input_search").val()).draw();
//        $("#example").css("display","inline");
        $(".cz_search_result").removeClass("invisible");
    });
    //Enter键事件
    $('#cz_input_search').keyup(function(e){
        if(e.keyCode==13){
            table.search($(this).val()).draw();
//            $("#example").css("display","inline");
            $(".cz_search_result").removeClass("invisible");
        }else if(e.keyCode==8){
            var len = $(this).val().length;
            console.log(len);
            if(len<1)
            $(".cz_search_result").addClass("invisible");
        }
    });
</script>
<script> //复选框点击事件
    //控制高亮
    $("#cbCheckbox1").click(function () {
        if ($(this).prop("checked")) {//jquery 1.6以前版本 用  $(this).attr("checked")
            highLightDifferent();
        } else {
            $(".alert-danger").each(
                function () {
                    //$(this).removeClass("different");
                    $(this).removeClass("alert-danger");
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

    //失去焦点隐藏搜索框
    //
    //    $("#cz_input_search").blur(function(){
    //        $(".cz_search_result").addClass("invisible");
    //    });
</script>
<script type="text/javascript">//搜索结果点击事件

    var struct = {};
    table.on( 'select', function ( e, dt, type, indexes ) {
        console.log("点击了搜索结果项");

        var dataRow = table.rows( indexes ).data();
        var category = dataRow[0][0];
        var name = dataRow[0][1];
        var tilte = dataRow[0][2];
        var url_data = "data/"+category+"/"+name+".json";
        var url_struct = "data/struct/"+category+".json";
        //var product = $("#content").load(url,{});
        var data = {};

        if(isReDrawTable(category)){
            $("#content").empty();
            $.get(url_struct, function(result){
                struct = result;
                createTable(struct,1,category);
            });
        }


        $.get(url_data, function(result){
            data = result;
            fillData(name,struct,data,category);
            jixing = name;
            //显示图片
            showFigure(data);
        });

//        $("#example").css("display","none");
        $(".cz_search_result").addClass("invisible");
    });

</script>










