<form id="view_product_category_update" method="post" action="controller/product_categoryController.php">
    <div class="form-group">
        <label for="input_title">修改产品分类</label>
        <input name="title" type="text" class="form-control" id="input_title" aria-describedby="emailHelp" value="<?=$_POST['title']?>" placeholder="输入产品分类名称">
    </div>
    <input name="action" value="updateProcess" type="hidden"/>
    <input name="ID" value="<?=$_POST['ID']?>" type="hidden"/>
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

        $('#view_product_category_update').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function showRequest(formData, jqForm, options) {
        //显示处理界面
        $("#content").html("处理中，请稍候...");
        title_upadted =formData[0]["value"];
    }
    function showResponse(responseText, statusText)  {
       window.location.reload();
    }

</script>