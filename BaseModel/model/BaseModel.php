 <?php 
 include_once "../db_config.php";


 class BaseModel {

 protected static $table;

 static function All(){

 global $db;
 $table = static::$table;
 $stmt = $db->prepare("select * from {$table}");
 $stmt->execute();
 $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
 

    
 }
 }
 
 
 
 
 
 
 ?>