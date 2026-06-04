 <?php
    if (isset($_POST["btn_submit"])) {
        $file = $_FILES["img"];
        $name = $file["name"];
        $tmp_name = $file["tmp_name"];
        $size = $file["size"];
        $error = $file["error"];
        $type = $file["type"];
        $img_name = "Rohan";
        $allowed_type = ["application/pdf", "image/jpeg", "image/png"];
        $ex = pathinfo($name, PATHINFO_EXTENSION);
        if (in_array($type, $allowed_type)) {
            if ($size <= 1000 * 1024) {
                if (!$error) {
                    move_uploaded_file($tmp_name, "img/$img_name.$ex");
                    echo ("file has been uploaded succesfully");
                    echo "<embed src = 'img/$img_name.$ex' width= '550'/>";
                }
            } else {
                echo "pls upload 200kb size picture";
            }
        } else {
            echo "$type not allowed.";
        }
        echo "<pre>" . print_r($file, true) . "</pre>";
    }


    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>File Upload</title>
 </head>

 <body>
     <!-- <form action="" method="post" enctype="multipart/form-data">
         <label for="img">Img</label><br>
         <input type="file" name="img" id="img"><br><br>
         <input type="submit" name="btn_submit"> -->
     <!-- </form> -->

    <div >
        <form action="" method="post" enctype="multipart/form-data">
            <div >
                <label for="img">Img</label><br>
                <input type="file" name="img" id="">
            </div><br>
            <div >
                <input type="submit" name="btn_submit">
            </div>
        </form>
    </div>
 </body>

 </html>