 <?php
    if (isset($_GET["a"]) && isset($_GET["b"]) && isset($_GET["c"])) {

        $a = $_GET["a"];
        $b = $_GET["b"];
        $c = $_GET["c"];
        $result = $a * $b * $c;


        // echo print_r($_GET, true) . "<br>";
        echo "a= $a, b=$b, c=$c <br>";
        echo "$a * $b * $c = {$result} <br>";
        print_r($a * $b * $c);
    }
    ?>