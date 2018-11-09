<form id="view_product_spec_add" method="post" action="controller/product_specController.php">
    新增<?=$_POST["title"]?>参数
    <?php foreach($structs as $struct){ ?>
    <div class="form-group">
        <label for="input_title"><?=$struct["title2"];?></label>
        <textarea name="spec[]"  class="form-control"></textarea>
    </div>
    <?php }?>
    <hr/>
    <div class="form-group">
        <label>排序</label>
         <input name="rank" type="number"   class="form-control"/>
    </div>
    <input name="product_category_ID" type="hidden" value='<?=$_POST["product_category_ID"]?>'/>
    <input name="action" type="hidden" value="addProcess" />
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

        $('#view_product_spec_add').submit(function() {
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