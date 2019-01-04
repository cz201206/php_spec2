<!--                            360°视图标题 视图-->
<div style="margin-left: 10px;">
    <!-- Button trigger modal -->
    <a  id="view_360" href="#" data-toggle="modal" data-target="#exampleModalCenter" style="display: none">
        360°视图<br/>
    </a><p>
        <a  id="view_video" href="#" data-toggle="modal" data-target="#exampleModalCenter_video" style="display: none">
            开箱视频
        </a>
    <div id="sellingPoint" style="display: none">
    </div>
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
                    <iframe id="view_360_iframe" width="500px" height="500px" style="border: 0px" ></iframe>
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
                    <iframe id="view_video_iframe" width="550px" height="500px" style="border: 0px" src="http://10.237.32.10/portal/Video/Detail.action?id=188"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>