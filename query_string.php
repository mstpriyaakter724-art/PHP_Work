
 <?php 
 
 
    //  print_r($_GET);
     if(isset($_GET["a"]) && isset($_GET["b"]) && isset($_GET["c"]) ){
     $a=$_GET["a"];
     $b=$_GET["b"];
     $c=$_GET["c"];
     $result = $a*$b*$c;
     echo "$a * $b * $c =  $result ";
    //  print_r($a*$b*$c);
   }
 ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <h1> Update Student</h1>
</body>
</html>