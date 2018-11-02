<?php
function getConn(){
    $con = mysqli_connect("localhost","loolsite","fx123321");
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_select_db($con,"db_specs");
    return $con;
}
