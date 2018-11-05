<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">//对象获取，变量声明定义

    //canvas jquery 对象
    var canvas_Navbar = $("#canvas_Navbar");
    //canvas js 对象
    var ctx=canvas_Navbar[0].getContext("2d");

</script>

<script type="text/javascript">//函数定义

    //绘制圆-图标
    function drawCircle_icon() {
        //context 样式
        var grad  = ctx.createLinearGradient(0,0,0,100);
        grad.addColorStop(0,'#ff0');    // 黄
        grad.addColorStop(0.5,'#00f');  // 蓝
        grad.addColorStop(1,'#0ff');    //青
        ctx.fillStyle = grad;
        //准备绘制
        ctx.beginPath();
        //指定圆参数
        ctx.arc(10,13,<?=$radius?>,0,2*Math.PI);
        ctx.fill();
    }

</script>

<script type="text/javascript">//函数执行

    drawCircle_icon();

</script>

<script type="text/javascript">//调试信息

    var table1 = $("<table id='t_info'></table>");
    var tr1= $("<tr></tr>");
    var td1 =  $("<td>单元格1</td>");
    var tds = new Array();
    table1.append(tr1);

    var column = 6;
    for(var i = 0; i<column;i++){
        tr1.append($("<td>单元格"+i+"</td>"));
    }

    $("#div_table1").append(table1);
    $("#t_info tr td").eq(2).html("替换内容2");
</script>