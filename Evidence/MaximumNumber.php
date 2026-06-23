 <?php



    $result = "";
    if (isset($_POST["btn_submit"])) {
        $firstNum = $_POST["num1"];
        $secondNum = $_POST["num2"];
        $thirdNum = $_POST["num3"];



        if ($firstNum > $secondNum && $firstNum > $thirdNum) {
            $result = "{$firstNum} is largest number among {$firstNum}, {$secondNum} & {$thirdNum}";
        } elseif ($secondNum > $firstNum && $secondNum > $thirdNum) {
            $result = "{$secondNum} is largest number among {$firstNum}, {$secondNum} & {$thirdNum}";
        } else {
            $result = "{$thirdNum} is largest number among {$firstNum}, {$secondNum} & {$thirdNum}";
        }
    }





    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
   
 </head>

  <body class="bg-light">
     <div class="container py-5 ">
         <div class="row justify-content-center">
             <div class="col-md-6">


                 <h2>Find Largest Number</h2>
              

                 
                 <?php if ($result != "") { ?>
                     <div class="alert alert-success">
                         <?php echo $result; ?>
                     </div>
                 <?php } ?> 

                 <form action="" method="post">
                     <div>
                         <label for="num1" class="form-label">Number-1: </label>
                         <input type="number" name="num1" id="num1" class="form-control">
                     </div>

                     <div>
                         <label for="num2" class="form-label">Number-2: </label>
                         <input type="number" name="num2" id="num2" class="form-control">
                     </div>

                     <div>
                         <label for="num3" class="form-label">Number-3: </label>
                         <input type="number" name="num3" id="num3" class="form-control">
                     </div>
                     <div>
                         <input type="submit" name="btn_submit" class="btn btn-success mt-2 w-100" id="">
                     </div>
                 </form>
             </div>
         </div>
     </div> 



 </body> 

 </html>