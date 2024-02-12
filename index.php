<?php
    if(isset($_POST['btn']) && isset($_FILES['file'])) {

        // if (condition) {
        //     # code...
        // }
        $file = $_FILES['file'];
        $filepath = $file['tmp_name'];
        $filename = $file['name'];
        $filesize = $file['size'];

        if ($filesize > 100000) {
            echo "Please remove size file";
        }
            $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($fileExtension != "csv") {
            echo "Invalid file format. Please upload a CSV file.";
            exit();
        }
            
            $file2 = fopen($filepath, "r");
            // $file3 = fgetcsv($file2, ",");

            while ($file3 = fgetcsv($file2, 1000, ",") !== false ) {
                print_r($file3);
            }
        }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link rel="stylesheet" href="../TOOLS/bootstrap5/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Upload File</h3>
           <div class="row">
            <div class="form-group col-md-8">
                    <input type="file" name="file" accept=".csv" id="" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <button name="btn" class="btn btn-primary">Upload</button>
                </div>
           </div>
        </form>
    </div>
</body>
</html>