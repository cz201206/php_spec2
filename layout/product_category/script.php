<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
    alert(canvas_Navbar.attr("class"));
</script>