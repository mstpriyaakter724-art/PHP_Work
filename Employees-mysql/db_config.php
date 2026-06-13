 <?php 
 
 try {
    $db = new mysqli("localhost","root","","HR");
    // echo "database connected";
 } catch (\Throwable $th) {
    echo $th->getMessage();
 }
 
 
 ?>