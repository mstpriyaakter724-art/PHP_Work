 <?php



    $result = "";
        if(isset($_POST["btn_submit"])){
            $grade = $_POST["grade"];

        if($grade == "A+" ||$grade == "a+" ){
            $result = "Outstanding";
        }elseif($grade == "A" || $grade == "a" ){
            $result = "Very Good";
        }elseif($grade == "B" || $grade == "b" ){
            $result = "Good";
        }elseif($grade == "C" || $grade == "c"){
            $result = "Poor";
        }else{
               $result = "Fail"; 
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

 <body>
    <form action="" method="post">
        <div class="m-2">
            <h3> <?php echo $result ?></h3>
        </div>
         <div>
         <input type="text" name="grade" id="" placeholder="Enter your Grade" class="m-3">
     </div>
    <div>
         <input class="btn btn-warning ms-3" type="submit" name="btn_submit" id="">
    </div>
    </form>
 </body>

 </html>