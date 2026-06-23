 <?php
    require_once "db_config.php";



    class Student
    {

        public $id;
        public $name;
        public $batch;

        public function __construct($id, $name, $batch)
        {
            $this->id = $id;
            $this->name = $name;
            $this->batch = $batch;
        }


        static function all()
        {
            global $db;
            $data = [];
            $stmt = $db->query("select * from datas");
            $student = $stmt->fetch_all(MYSQLI_ASSOC);

            foreach ($student as $value) {
                $data[] = (object)$value;
            }
            return $data;
        }


        static function result($id)
        {
            global $db;
            $stmt = $db->query("select * from datas where id= $id");
            $data = $stmt->fetch_object();
            return $data;
        }
    }

    $foundData = (object)[];

    if (isset($_POST["btn_submit"])) {
        $userid = $_POST["id"];
        $foundData = "";

        if ($userid != "") {
            $foundData = Student::result($userid) ?? "";
        }
    }



    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
 </head>

 <body class="bg-light">
     <div class="container py-5 ">
         <div class="row justify-content-center">
             <div class="col-md-6">
                 <h3 class="">Search Your Data </h3>

                 <?php if (!is_object($foundData) && isset($_POST["btn_submit"])) { ?>
                     <div class="alert alert-info mt-3">
                         <strong>Error!</strong> Data not found.
                     </div>
                 <?php } ?>


                 <form action="" method="post">
                     <div class="mt-3">
                         <input type="text" name="id" id="" placeholder="Enter Your ID" class="form-control">
                     </div>
                     <div>
                         <input type="submit" name="btn_submit" id="" class="btn btn-primary mt-2 w-100">
                     </div>
                 </form>

                 <!-- <?php echo is_object($foundData) ? "" : "Data not found" ?> -->

                 

                 <table class=" table table-info table-striped mt-3 ">
                     <tr>
                         <th>Id:</th>
                         <th> <?php echo $foundData->id ?? "" ?> </th>
                     </tr>
                     <tr>
                         <th>Name:</th>
                         <th> <?php echo $foundData->name ?? "" ?> </th>
                     </tr>
                     <tr>
                         <th>Batch:</th>
                         <th> <?php echo $foundData->batch ?? "" ?> </th>
                     </tr>
                 </table>



             </div>

         </div>
     </div>
 </body>

 </html>