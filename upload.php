<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploading</title>
    <link rel="stylesheet" href="./bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lineawesome/lineawesome/css/line-awesome.css">
    <link rel="stylesheet" href="./DataTables/datatables.css">
    <script src="./jquery.js"></script>
    <script src="./DataTables/datatables.js"></script>
    <script src="./sweetalert2/sweetalert2/dist/sweetalert2.all.js"></script>

</head>
<body>
    
</body>
</html>
<?php
    include "server.php";
    if (isset($_POST['btn'])) {
        
    if (isset($_FILES["csvFile"]) && $_FILES["csvFile"]["error"] == UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES["csvFile"]["tmp_name"];
        $fileName = $_FILES["csvFile"]["name"];

        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if ($fileExtension != "csv") {
            echo "Invalid file format. Please upload a CSV file.";
            exit();
        }

        $file = fopen($fileTmpPath, 'r');
        while (($row = fgetcsv($file)) !== false) {
            // print_r($row)."<br>";
            $sql = "INSERT INTO result2(`NAME`, `MATRIC_NO`, `SUBJECT`, `CA1`, `CA2`, `CA3`, `EXAMS`)VALUES('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."')";
            $res = $conn->query($sql);
            if ($res !== true) {
                echo"<script>
                        swal.fire('Error','Uploading Fails...','error')
                    </script>".$conn->error;
            }
            // }else{
            //     echo"<script>
            //             swal.fire('Done','Uploading Successfully','success')
            //         </script>";
            // }
        }
        // break;
        fclose($file);

    } else {
        echo "Error uploading file. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV File Upload</title>
    <link rel="stylesheet" href="./bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lineawesome/lineawesome/css/line-awesome.css">
    <style>
      td{
        font-size:12px;
      }
      th{
        font-size: 10px;
      }
      footer{
       /* width: 100%; */
        /* padding: 10px; */
      }
    </style>
</head>
<body class="" style="background-color: #f1f1f1;">
    <!-- <div class="container"> -->
        
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class=" lert alert-light ">
                    
            <h1 class="text-center text-primary">File Upload</h1>
            <label for="csvFile">Upload Your File:</label>
        <div class="row">
                <div class="col-md-8">
                    <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv" required>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary " name="btn">Import<i class="la la-upload"></i></button>
                    <a href="./form.php" class="btn btn-success ">Form Add<i class="la la-edit"></i></a>
                    <a href="./delete.php" class="btn btn-danger ">Delete all<i class="la la-trash"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<hr>

<!-- <div class="card"> -->
    <!-- <div class=" card-body"> -->
        <table id="myTable" class="display table table-striped table-hover table-border ">
            <thead>
                <tr>
                    <!-- <th>SN</th> -->
                    <th>NAME</th>
                    <th>MATRIC NUMBER</th>
                    <th>SUBJECT</th>
                    <th>FIRST C.A</th>
                    <th>SECOND C.A</th>
                    <th>THIRD C.A</th>
                    <th>EXAMS</th>
                    <th>TOTAL SCORE</th>
                    <th>AVERAGE SCORE</th>
                    <th>REMARK</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM result2";
                    $result = $conn->query($sql);
                    $result->num_rows>0;
                    while($data = $result->fetch_assoc()):;

                        //all subject total
                        $sum = $data['CA1']+
                        $data['CA2']+
                        $data['CA3']+
                        $data['EXAMS'];
                      

                    //average    
                   $avg = $sum/3;

                   //Remark
                   if ($sum >=50) {
                       $pass = "PASS";
                    }else{
                       $pass = "FAIL";
                   }


                ?>
                <tr>
                    <td><?=$data['NAME']; ?></td>
                    <td><?=$data['MATRIC_NO']; ?></td>
                    <td><?=$data['SUBJECT']; ?></td>
                    <td><?=$data['CA1']; ?></td>
                    <td><?=$data['CA2']; ?></td>
                    <td><?=$data['CA3']; ?></td>
                    <td><?=$data['EXAMS']; ?></td>
                    <td><?=$sum; ?></td>
                    <td><?=$avg; ?></td>
                    <td><?=$pass; ?></td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="p-3 text-center text-primary alert alert-primary">
    <p>Copy write @MIKK COMPUTERS</p>
</footer>
    <script>
        let myTable = new DataTable("#myTable", {


        });
    </script>
</body>
</html>
