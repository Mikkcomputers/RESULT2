<?php
include "./server.php";

$sql = "TRUNCATE `result2`";
$res = $conn->query($sql);
if ($res == true) {
    header("location: ./upload.php");
}else{
    echo"Fail to delete".$conn->error;
}


?>