<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <script src="./sweetalert2/sweetalert2/dist/sweetalert2.all.js"></script>
</head>
<body>
    
</body>
</html>
<?php

if (isset($_POST['btn'])) {
    $name = $_POST['name'];
    $reg_number = $_POST['reg_number'];
    $english = $_POST['english'];
    $maths = $_POST['math'];
    $bio = $_POST['bio'];
    $chem = $_POST['chem'];
    $basic_sci = $_POST['basic_sci'];
    $civic = $_POST['civic'];
    $basic_tech = $_POST['basic_tech'];
    $phy = $_POST['phy'];

    $sql = "INSERT INTO `result1`(`NAME`, `REG_NUMBER`, `ENGLISH`, `MATHEMATICS`, `BIOLOGY`, `CHEMISTRY`, `BASIC_SCIENCE`, `CIVIC_EDUCATION`, `BASIC_TECHNOLOGY`, `PHYSICS`)VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $name, $reg_number, $english, $maths, $bio, $chem, $basic_sci, $civic, $basic_tech, $phy);
    $result = $stmt->execute();
    if ($result == true) {
        echo"
        <script>
            swal.fire('Done','Adding Successfully...','success')
            .then(()=>{window.location='./upload.php'})
        </script>
        ";
    }else{
        echo"
        <script>
            swal.fire('Error','Adding Fail...','error')
            .then(()=>{window.location='./form.php'})
        </script>
        ".$conn->error;

    }
}


?>