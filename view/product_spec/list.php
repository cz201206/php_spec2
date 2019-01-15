<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th></th>
        <th>产品名称</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($pojos as $pojo){ ?>

        <tr>
            <td>
                <a href="#"
                   class="cz_find"
                   data-controller="product_specController.php"
                   data-data='{"action":"publish_single","ID":"<?=$pojo['ID']?>","product_category_ID":<?=$pojo['product_category_ID']?>}'<?=$pojo['title']?>>发布</a>
            </td>
            <td>
                <a href="#"
                   class="cz_find"
                   data-controller="product_specController.php"
                   data-data='{"action":"find","ID":"<?=$pojo['ID']?>","product_category_ID":<?=$pojo['product_category_ID']?>}'><?=$pojo['title']?></a>
            </td>
        </tr>

    <?php }?>
    </tbody>
</table>



<script type="text/javascript">
    $(document).ready( function () {
        var table = $('#example').DataTable({"select":true});
        table.on( 'draw', function () {
            $(".cz_find").click(
                function () {
                    console.log
                    var url = "controller/"+$(this).data("controller");
                    var data = $(this).data("data");
                    $("#content").load(url,data);
                }
            );
        });
    } );
    $(".cz_find").click(
        function () {
            console.log
            var url = "controller/"+$(this).data("controller");
            var data = $(this).data("data");
            $("#content").load(url,data);
        }
    );
</script>
