 <?php


    class ProductController
    {
        function index()
        {
            $data = Product::all();
            view("", compact("data"));
        }


        function create()
        {
            view("",);
          
        }

        function save()
        {
              print_r($_POST);
           if (isset($_POST["btn_submit"])) {
                $product = new Product();

                $product->name = $_POST["name"];
                $product->price = $_POST["price"];
                $product->manufacturer_id = $_POST["manufacturer_id"];

                $product->create();
                redirect();
            }
        }

        function delete()
        {
            $id = $_GET["id"];
            Product::delete($id);
            redirect();
        }

        function edit()
        {
            $data = Product::find($_GET["id"]);
            view("", compact("data"));
        }


        function update()
        {
            //  print_r($_POST);

            if (isset($_POST["btn_submit"])) {
                $product = new Product();

                $product->id = $_POST["id"];
                $product->name = $_POST["name"];
                $product->price = $_POST["price"];
                $product->manufacturer_id = $_POST["manufacturer_id"];

                $product->update();
                redirect();
            }
        }
    }



    ?>