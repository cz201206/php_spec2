<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/public/lib/jquery/jquery.form.js" ></script>
<script src="/public/project/specs/js/fn.js"></script>
<script type="text/javascript">//对象获取，变量声明定义

    //canvas jquery 对象
    var canvas_Navbar = $("#canvas_Navbar");
    //canvas js 对象
    var ctx=canvas_Navbar[0].getContext("2d");

</script>

<script type="text/javascript">//函数定义



</script>

<script type="text/javascript">//点击事件

    //导航栏点击事件
    $(".a_ajax").click(
        function () {
            var a = $(this).attr("href");
            var url = a.substring(0,a.indexOf("?"));
            var data = dataFromAnchor( a );
            $("#content").load(url,data);
            return false;
        }
    );

    //.cz_modify 点击事件
    $(".cz_update").click(
        function () {
            var a = $(this).prev().attr("href");
            var url = "controller/product_categoryController.php";
            var data = dataFromAnchor( a );
            data.action = "update";
            $("#content").load(url,data);
        }
    );


</script>

<script type="text/javascript">//函数执行

    drawCircle_icon();

</script>

<script type="text/javascript">//调试信息

</script>