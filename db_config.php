 <?php 
 
 try {
    $db = new mysqli("localhost","root","","school");
    // echo"database connected succesfully";
 } catch (\Throwable $th) {
    echo $th->getMessage();
 }
 
//  $data = $db->query("select * from students");
//  $students = $data->fetch_all(MYSQLI_ASSOC);
 
// //  print_r($students);
 
//  echo "<br>";
//  echo "<br>";
 
//  foreach($students as  $value){
// //     echo $value["id"] ."<br>";
// //     echo $value["name"] ."<br>";
// //     echo $value["email"] ."<br>";
// //     echo $value["gender"] ."<br>";

// //     echo "<br>";
// //     echo "<br>";
// //  }
 
 
 ?>