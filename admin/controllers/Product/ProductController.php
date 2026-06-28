 <?php 
 
 
 class ProductController{


 function index(){

$data = Product::all();

view("", compact("data"));

 }





 }
 
 
 
 
 
 
 
 ?>