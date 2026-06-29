 <?php 
 
 class Customer{


 public $customer_id;
 public $full_name;
 public $email;
 public $country;

public function __construct()
{
}

public function set($customer_id,$full_name,$email,$country){
       
    $this->customer_id= $customer_id;
    $this->customer_id= $full_name;
    $this->customer_id= $email;
    $this->customer_id= $country;
}
 }
 
 ?>