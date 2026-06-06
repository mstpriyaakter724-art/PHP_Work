 <?php  
    spl_autoload_register(function($className){
        include_once "$className.php";

    })
 
 ?>

  <!-- <?php 
  spl_autoload_register("className");
  
  function className($className){
   
        include_once "$className.php";
  }
  ?> -->