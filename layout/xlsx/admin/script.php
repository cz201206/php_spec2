<script src="/public/lib/jquery/3.3.1/jquery-3.3.1.min.js" ></script>
<script src="/public/lib/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/public/lib/jquery/jquery.form.js" ></script>
<script src="/public/project/specs/js/fn.js"></script>
<script type="text/javascript">//对象获取，变量声明定义

</script>

<script type="text/javascript">//函数定义



</script>

<script type="text/javascript">//函数执行



</script>


<script type="text/javascript">//点击事件
    //单品文件处理
    $(".cz_xlsx").click(
        function () {
            var url = "controller/xlsxController.php";
            var data = $(this).data();
            console.log(data);
            $("#content").load(url,data);
        }
    );
</script>

<script type="text/javascript">//调试信息

</script>