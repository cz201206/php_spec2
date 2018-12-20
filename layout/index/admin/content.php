<div class="container-fluid">
    <div class="row ">
        <div class="col-3">

            <div id="nav"></div>


        </div>
        <div class="col-9">

            <div class="input-group">
                <input id="cz_input_search" type="text" class="form-control" placeholder="搜索">
				<button id="cz_button_search" class=" btn btn-outline-primary " type="button">Go!</button>
            </div>
            <div class="cz_search_result " style="position:relative">
            <div class=" shadow-lg p-3 mb-5 bg-white rounded" style="position:absolute;left:1px;top:1px;width: 100%;">

            <table id="example" class="display " style="width: 100%;" >
                <thead>
                    <tr>
                        <th>分类名</th>
                        <th>产品名</th>
                        <th></th>
                    </tr>
                </thead>
            </table>

            </div>
            </div>


                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-1>

                        </div>
                        <div class="col-10">
                        <div class="d-flex justify-content-center">

                            <figure class="figure shadow p-3 mb-5 bg-white rounded" >
                                <img id="img" height="200px" src="data/img/shouji/hm1.png" class="figure-img img-fluid rounded">
                                <figcaption id="jixing" class="figure-caption text-center text-white bg-primary">机型</figcaption>
                            </figure>
                            <div style="margin-left: 10px;">



                                <!-- Button trigger modal -->
                                <a  href="#" data-toggle="modal" data-target="#exampleModalCenter">
                                    360°视图
                                </a>

                                <!-- Modal -->
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
                                                <iframe width="500px" height="500px" style="border: 0px" src="http://localhost/3d/hs/"></iframe>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>





                            <div id="content" class="align-middle"></div>
                        <div class="col-1">

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

