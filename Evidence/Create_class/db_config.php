 <?php 
 
 try {
    $db = new mysqli("localhost", "root", "","school");
 } catch (\Throwable $th) {
    echo $th->getMessage();
 }
 
 ?>