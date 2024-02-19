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
    $subject = $_POST['subject'];
    $ca1 = $_POST['ca1'];
    $ca2 = $_POST['ca2'];
    $ca3 = $_POST['ca3'];
    $exams = $_POST['exam'];
    
    $sql = "INSERT INTO `result2`(`NAME`, `MATRIC_NO`, `SUBJECT`, `CA1`, `CA2`, `CA3`, `EXAMS`)VALUES(?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiis", $name, $reg_number, $subject, $ca1, $ca2, $ca3, $exams);
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