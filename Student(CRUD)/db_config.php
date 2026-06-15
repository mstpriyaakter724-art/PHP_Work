 <?php

    try {
        $db = new mysqli("localhost", "root", "", "batch71");
        // echo "database connected";
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }



    ?>