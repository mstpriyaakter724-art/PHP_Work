 <?php 
 
 class Product {

 public $id;
 public $name;
 public $price;
 public $manufacturer_id;

public function
__construct()
{
}

public function set($id,$name,$price,$manufacturer_id)
{
 $this->id=$id;
 $this->name=$name;
 $this->price=$price;
 $this->manufacturer_id=$manufacturer_id;
}

public function create(){
    global $db;

    $stmt=$db->query("insert into products (name,price,manufacturer_id)values('$this->name','$this->price','$this->manufacturer_id') ");
    return $db->insert_id;
}

public function update(){
    global $db;

    $stmt=$db->query("update products set 
                    name='$this->name',
                    price='$this->price',
                    manufacturer_id= $this->manufacturer_id
                    where id= $this->id
    ");
    return $stmt;
}


public static function all(){
    global $db;
    $stmt = $db->query("select * from products");
    return array_map(fn($e) =>(object) $e,$stmt->fetch_all(MYSQLI_ASSOC) );
}

public static function find($id){
    global $db;
    $stmt = $db->query("select * from products where id=$id");
    return $stmt->fetch_object();
}

public static function delete($id){
    global $db;
    $stmt = $db->query("delete from products where id=$id");
    return $stmt;
}



 }
 
 
 
 ?>