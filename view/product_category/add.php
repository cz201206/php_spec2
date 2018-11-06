<form id="view_product_category_add" method="post" action="controller/product_categoryController.php">
    <div class="form-group">
        <label for="input_title">新增产品分类</label>
        <input name="title" type="text" class="form-control" id="input_title" aria-describedby="emailHelp" placeholder="输入产品分类名称">
    </div>
    <input name="action" value="addProcess" type="hidden"/>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<script>
    //ajax上传文件
    $(function(){
        var options = {
            beforeSubmit:  showRequest,  //提交前处理
            success:       showResponse,  //处理完成
            resetForm: false,
            target:    $("#content")
        };

        $('#view_product_category_add').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function showRequest(formData, jqForm, options) {
        //显示处理界面
        $("#content").html("处理中，请稍候...");
    }
    function showResponse(responseText, statusText)  {
        //alert("Thank you for your comment!"+responseText);
    }

</script>