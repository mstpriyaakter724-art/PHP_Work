 <?php 
 $db = new mysqli("localhost", "root", "", "hr");

if(isset($_POST["btn_submit"])){
    $id = $_POST["btn_submit"];



    $result = $db->query("call deleteUser(2)");


    // delimiter $$
    // create procudure deleteUser (in _id int(11))
    // begin 
    // delete from user where id = _id;
    // end $$
    // delimiter ;
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
    <form action="#" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="">
        <br><br>
        <input type="submit" name="btn_submit" id="">
    </form>
</body>
</html>