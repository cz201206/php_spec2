<form id="view_product_spec_update" method="post" action="controller/product_specController.php">
    修改参数
    <div class="form-group">
        <label >产品名称</label>
        <input name="jixing"  type="text" class="form-control"></input>
    </div>
    <?php foreach($structs as $struct){ ?>
    <div class="form-group">
        <label for="input_title"><?=$struct["title2"];?></label>
        <textarea name="<?=$struct["name2"];?>"  class="form-control" wrap="soft"></textarea>
    </div>
    <?php }?>
    <div class="form-group">
        <label >排序</label>
        <input name="rank"  type="number" class="form-control" value="<?=$pojo['rank']?>"></input>
    </div>
    <input name="ID" type="hidden" value='<?=$_POST["ID"]?>'/>
    <input name="product_category_ID" type="hidden" value='<?=$_POST["product_category_ID"]?>'/>
    <input name="action" type="hidden" value="updateProcess" />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>



<script type="text/javascript">
    function TransferString_rn(content)
    {
        var string = content;
        try{
            string=string.replace(/<br\/>/g,"\r\n")
        }catch(e) {
            alert(e.message);
        }
        return string;
    }
    var data = <?=$pojo['spec']?>;

    $("input").each(function () {
        var type = $(this).attr("type");
        var name = $(this).attr("name");
        if("hidden"!=type && data.hasOwnProperty(name)){

            $(this).val(data[name]);
        }
    });
    $("textarea").each(function () {
        var name = $(this).attr("name");
        if(data.hasOwnProperty(name)) {
            $(this).val(TransferString_rn(data[name]));
        }
    });

</script>

<script>

    function TransferString(content)
    {
        var string = content;
        try{
            string=string.replace(/\r\n/g,"<br>")
            string=string.replace(/\n/g,"<br>");
        }catch(e) {
            alert(e.message);
        }
        return string;
    }



    //ajax上传文件
    $(function(){
        var options = {
            beforeSubmit:  showRequest,  //提交前处理
            success:       showResponse,  //处理完成
            resetForm: false,
            target:    $("#content")
        };
        $('#view_product_spec_update').submit(function() {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function showRequest(formData, jqForm, options) {
        $(formData).each(
            function () {
                var type = $(this).attr("type");
                if("textarea" ===type ){
                    var value = $(this).attr("value");
                    $(this).attr("value", TransferString(value)) ;
                    console.log($(this));
                }
            }
        );
        //显示处理界面
        $("#content").html("处理中，请稍候...");
    }
    function showResponse(responseText, statusText)  {
        //alert("Thank you for your comment!"+responseText);
    }

</script>