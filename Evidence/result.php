 <?php
    $retust = "";
    if (isset($_POST["btn_submit"])) {
        $num = $_POST["num"];

        if ($num >= 80) {
            $retust = "A+";
        } elseif ($num >= 70) {
            $retust = "A";
        } else {
            $retust = "Fail";
        }
    }


    ?>

 <!-- <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <form action="" method="post">
        <h2> <?php echo $retust ?></h2>
    <div>
        <label for="num">Number</label>
        <input type="text" name="num" id="num" placeholder="Enter your number">
    </div><br>
    <div>
        <input type="submit" name="btn_submit" id="">
    </div>
    </form>
 </body>
 </html>  -->



 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Grade Calculator</title>

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>

 <body class="bg-light">

     <div class="container vh-100 d-flex justify-content-center align-items-center">

         <div class="card shadow p-4" style="width: 400px;">

             <h2 class="text-center mb-4">Grade Calculator</h2>

             <form action="" method="post">
                 <!-- <h2> <?php echo isset($retust) ? "$retust" : "" ?></h2><br> -->

                 <?php if (!empty($retust)) { ?>
                     <div class="alert alert-success text-center">
                         Grade: <?php echo $retust; ?>
                     </div>
                 <?php } ?>

                 <div class="mb-3">
                     <label for="num" class="form-label">Number</label>
                     <input type="number" class="form-control" name="num" id="num" placeholder="Enter your number">
                 </div>

                 <div class="d-grid">
                     <button type="submit" name="btn_submit" class="btn btn-primary">
                         Submit
                     </button>
                 </div>

             </form>


         </div>

     </div>

 </body>

 </html>