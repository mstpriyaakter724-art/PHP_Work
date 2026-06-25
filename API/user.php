 <?php 
require_once "db_config.php";



function allusers(){
    global $db;
    $stmt_user = $db->query("select * from users");
    $user_result = $stmt_user->fetch_all(MYSQLI_ASSOC);

    $stmt_role = $db->query("select * from roles");
    $role_result = $stmt_role->fetch_all(MYSQLI_ASSOC);

    return ["users"=> $user_result, "roles"=>$role_result];

   }
 
  echo json_encode(allusers());
 
 ?>