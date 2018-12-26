<style>
    .aligncenter {
        clear: both;
        display: block;
        margin:auto;
        width: 100%;
        float: inherit;
    }
    .inline{
        display: inline;
    }
    td{
        text-align: center;
    }
</style>

<style>
    .wrap1 {
        clear: left;
        float: left;
        position: relative;
        left: 50%;
    }
    .content1 {
        float: left;
        position: relative;
        right: 50%;
    }
</style>




<table width="700">
    <tr>

        <td  colspan="2">
            <div class="wrap1">
                <div class="content1">
                    <div style="background: #6699cc none repeat scroll 0% 0%;float: left;">
                        <!--        图片机型 -->
                        <div class="" >
                            <img id="img" height="200px"  src="data/img/shouji/hm4x_4G_64G.png" >
                            <div>机型</div>
                        </div>
                    </div>
                    <div style="background: #6699ff none repeat scroll 0% 0%;float: left;">
                            卖点1<p>
                            卖点1<p>
                            卖点1<p>
                    </div>
                </div>
            </div>
        </td>

    </tr>
</table>



        <div  style="width: 700px">
            <div class="wrap1">
                <div class="content1">
                    <div style="float: left;">
                    <figure id="figure" class="figure shadow p-3 mb-5 bg-white rounded"  >
                        <img id="img" height="300px"  src="data/img/shouji/hm4x_4G_64G.png"  >
                        <figcaption id="jixing" class="figure-caption text-center text-white bg-primary">红米1</figcaption>
                    </figure>
                    </div>

                    <!--                            360°视图标题 视图-->
                    <div style="float: left;">
                        <div style="margin-left: 10px;">
                            <!-- Button trigger modal -->
                            <a  id="view_360" href="#" data-toggle="modal" data-target="#exampleModalCenter">
                                360°视图<br/>
                            </a><p>
                                <a  id="view_video" href="#" data-toggle="modal" data-target="#exampleModalCenter_video" >
                                    开箱视频
                                </a>
                                <!--                                360视图 -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:530px">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" >
                                            <iframe width="500px" height="500px" style="border: 0px" src="http://10.237.32.11/3d/hs/"></iframe>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--                                开箱视频-->
                            <div class="modal fade" id="exampleModalCenter_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter_videoTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:600px">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenter_videoTitle"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" >
                                            <iframe width="550px" height="500px" style="border: 0px" src="http://10.237.32.10/portal/Video/Detail.action?id=188"></iframe>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div>
                            卖点一<p>
                            卖点一<p>
                            卖点一<p>
                        </div>
                    </div>

                    <table style="clear: both">
                        <tr>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                    </table>
                </div>



            </div>
        </div>






