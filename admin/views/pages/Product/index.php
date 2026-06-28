 <?php 
 
//  print_r($data);
 
 ?>


<div>

<a class="btn btn-primary" href="<?php echo $base_url?>/product/create">Create</a>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Manufecturer_id</th>
      
    </tr>
  </thead>
  <tbody>
    <?php  
    
     foreach ($data as $key => $product){
        $key++;
       echo "
           <tr>
            <th scope='col'>$key</th>
            <th scope='col'>$product->name</th>
            <th scope='col'>$product->price</th>
            <th scope='col'>$product->manufacturer_id</th>
            <th scope='col' class='btn-group'>
              <a class='btn btn-secondary' href='$base_url/product/edit/$product->id'>Edit</a>
              <a class='btn btn-danger' href='$base_url/product/delete/$product->id'>Delete</a>
            </th>
          </tr>
       ";
     }

    ?>
  </tbody>
</table>