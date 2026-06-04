 
 <?php 
 if(isset( $_POST ["btn_submit"])){
    $number = $_POST["number"];
    function isPrime($n){
        if($n < 2) {
            return false;
        };
        for ($i = 2; $i < $n; $i++){
            if( $n % $i == 0){
                return false;
            }
        }
        return true;
    };

    
 $result = isPrime($number) ? " <h3 class = 'green'> {$number} is a prime number.</h3>" : " <h3 class='red'> {$number} is  not a prime number.</h3>";
 }


 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Number</title>
    <style>
       .green{
        color: #3ad817f1;
       } 

       .red{
        color: #f31313fb;
       }

    </style>




</head>
<body>
    <form action=""  method= "post">
     <label for="number">Enter a Number</label><br> 
     <input type="number" name="number" ><br> 
     <input type="submit" name="btn_submit" > 
    </form>

     <?php 
        if(isset($result)){
            echo $result;
        }
     ?>
</body>
</html>