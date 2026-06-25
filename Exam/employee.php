 <?php 

 
class User{
    public static function  Add ($name,$location,$phone){
        global $db;
        $stmt= $db->query( "call create_Department('$name','$location','$phone')");

        return $stmt;
    }



    public static function show(){
        global $db;
        $department_stmt = $db->query("select * from departments");
        $department_res =array_map(fn($e) =>(object)$e, $department_stmt->fetch_all(MYSQLI_ASSOC) ); 
        // $department_res = $department_stmt->fetch_all(MYSQLI_ASSOC);
        return $department_res;
    }

    public static function allData(){
        global $db;
        $stmt = $db->query("select * from allemployees");
        $result = array_map(fn($e) =>(object)$e,
        $stmt->fetch_all(MYSQLI_ASSOC));
        return $result; 
    }
}
 ?>