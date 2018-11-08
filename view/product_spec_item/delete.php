<form id="view_product_spec_item_update" method="post" action="controller/product_spec_itemController.php">


    是否要删除: "<?=$_POST['title']?>" &nbsp;
    <input name="action" value="deleteProcess" type="hidden"/>
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

        $('#view_product_spec_item_update').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    });

    function showRequest(formData, jqForm, options) {
        //显示处理界面
        $("#content").html("处理中，请稍候...");

    }
    function showResponse(responseText, statusText)  {
        window.location.reload();
    }

</script>