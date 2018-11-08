<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/public/lib/jquery/jquery.form.js" ></script>
<script src="/public/project/specs/js/fn.js"></script>
<script type="text/javascript">//对象获取，变量声明定义

    //canvas jquery 对象
    var canvas_Navbar = $("#canvas_Navbar");
    //canvas js 对象
    var ctx=canvas_Navbar[0].getContext("2d");

    var obj =
        {title:"小米8",l1:
            [

                {title:"屏幕",
                    l2:
                        [
                            {title:"长",spec:"4cm"},
                            {title:"宽",spec:"3cm"}
                        ]
                },

                {title:"存储",
                    l2:
                        [
                            {title:"运行内存",spec:"6GB"},
                            {title:"存储内存",spec:"64GB"}
                        ]
                }


            ]
        };

    var obj1 =
        {title:"红米5",l1:
            [

                {title:"屏幕",
                    l2:
                        [
                            {title:"长",spec:"2cm"},
                            {title:"宽",spec:"3cm"}
                        ]
                },

                {title:"存储",
                    l2:
                        [
                            {title:"运行内存",spec:"4GB"},
                            {title:"存储内存",spec:"64GB"}
                        ]
                }


            ]
        };

</script>

<script type="text/javascript">//函数定义

    function createTable(count_td) {
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

        var title = $("<div>"+obj.title+"</div>");
        $("#content").append(title);

        //构造表结构

        for(i_l1 in obj.l1 ){
            //一级
            l1 = obj.l1[i_l1];
            //一级标题
            var l1_title_ele = $("<div>"+l1.title+"</div>");
            $("#content").append(l1_title_ele);
            //一级详情
            var table = $("<table id=table_"+i_l1+"></table>");
            for(i_l2 in l1.l2){
                var l2 = l1.l2[i_l2];
                var tds = "<td></td>";
                for(var i=0;i<count_td-1;i++){
                    tds+=tds;
                }
                table.append($("<tr><td class='spec_item'>"+l2.title+"</td>"+tds+"</tr>"));
            }
            l1_title_ele.after(table);
        }



    }

    function fillData(obj,position) {

        for(i_l1 in obj.l1 ){
            //一级
            l1 = obj.l1[i_l1];

            //一级详情
            var table_id = "table_"+i_l1;

            for(i_l2 in l1.l2){
                var l2 = l1.l2[i_l2];
                $("#"+table_id).find("tr").eq(i_l2).find("td").eq(position).html(l2.spec);
            }

        }

    }

    function td_contrast() {
        var table_0 = $("#table_1");
        $("table").each(function () {
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

    $("#cbCheckbox1").click(function () {
                 if ($(this).prop("checked")) {//jquery 1.6以前版本 用  $(this).attr("checked")
                     td_contrast();
                     } else {
                       $(".different").each(
                           function () {
                               $(this).removeClass("different");
                           }
                       );
                     }
      });
</script>

<script type="text/javascript">//点击事件




</script>

<script type="text/javascript">//函数执行

    drawCircle_icon();
    createTable(2);
    fillData(obj,1);
    fillData(obj1,2);
    td_contrast();
</script>

<script type="text/javascript">//调试信息

</script>
