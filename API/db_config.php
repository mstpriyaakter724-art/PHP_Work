 <?php 

 try {
    $db = new mysqli("localhost","root","","school");
 } catch (\Throwable $th) {
    echo $th->getPrevious();
 }
 


 function response(array $data, $status=200){
   http_response_code($status);
   echo json_encode($data);
 }
 
 ?>