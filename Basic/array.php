<?php
$students = [ "Rashed", "Khaled", "Mashmud", "Hasan"];
    foreach($students as $key => $student){
         echo"{$key} {$student} <br>";
    }

    for($i = 0; $i < count($students); $i++){
        echo  $students[$i]. "<br>";

    };

    $student = ["name"=> "Rashed", "age"=> 25, "gender"=> "male", "address"=> "dhaka"];
    foreach($student as $key => $value){
        echo "{$key}: {$value} <br>";
    }

echo "<br>";

    $keys = array_keys($student);
    for ($i =0; $i < count ($student); $i++){
        echo $student[$keys[$i]] ."<br>";
    }

    print_r(array_keys($student));



    $students = [
            ["name"=> "Rashed", "age"=> 25, "gender"=> "male", "address"=> "dhaka"],
            ["name"=> "Khaled", "age"=> 28, "gender"=> "male", "address"=> "rajshahi"],
            ["name"=> "Mashmud", "age"=> 22, "gender"=> "male", "address"=> "rangpur"],
            ["name"=> "Nasir", "age"=> 20, "gender"=> "male", "address"=> "chittagong"],
            ["name"=> "Hasan", "age"=> 23, "gender"=> "male", "address"=> "barisah"],
        ];


        echo "<br>";
        echo "<br>";


        foreach($students as $student){
            print_r($student);
            echo "<br>";

            foreach($student as $key => $value){
                echo"{$key} : {$value}";
                echo "<br>";
            }

            echo "<br>";
            echo "<br>";
        }

        echo "<br>";
        echo "<br>";


        foreach($students as $student){
            echo "Name: {$student["name"]} <br>";
            echo "age: {$student["age"]} <br>";
            echo "address: {$student["address"]} <br>";
            echo "<br>";
            echo "<br>";
        } 
        

        $students = [
            (object)["name"=> "Khaled", "age"=> 28, "gender"=> "male", "address"=> "rajshahi"],
            (object)["name"=> "Rashed", "age"=> 25, "gender"=> "male", "address"=> "dhaka"],
            (object)["name"=> "Mashmud", "age"=> 22, "gender"=> "male", "address"=> "rangpur"],
            (object)["name"=> "Nasir", "age"=> 20, "gender"=> "male", "address"=> "chittagong"],
            (object)["name"=> "Hasan", "age"=> 23, "gender"=> "male", "address"=> "barisah"],
        ];

    foreach($students as $student){
        echo "Name: {$student -> name} <br>";
        echo "Age: {$student -> age} <br>";
        echo "Address: {$student -> address} <br>";
        echo "<br>";
        echo "<br>";
    }



    $jsonob = json_encode($students);
    print_r ($jsonob);
    echo "<br>";





//========================array edit==============================

    $students = [ "Rashed", "Khaled", "Mashmud", "Hasan"];
    $student = ["name"=> "Rashed", "age"=> 25, "gender"=> "male", "address"=> "dhaka"];

    echo "<br>";
    echo "<br>";
    echo "<br>";

    $students[4]= "Jamshed";
    $students[0]= "Joy";
    print_r($students);


    echo "<br>";
    echo "<br>";

    $student["gender"] = "Female";
    $student["address"]= "UK";
    $student["name"]= "Elina";
    print_r($student);


     echo "<br>";
     echo "<br>";

   $students = [
                  ["name"=> "Rashed", "age"=> 25, "gender"=> "male", "address"=> "dhaka"],
                  ["name"=> "Khaled", "age"=> 28, "gender"=> "male", "address"=> "rajshahi"],
               ];

    $students[1]["name"]= "Joy";
    $students[2]= ["name"=> "Khaled", "age"=> 28, "gender"=> "male", "address"=> "rajshahi"];

   print_r($students);

     echo "<br>";
     echo "<br>";

    $player1["name"]="Hamza";
    $player1["club"]= "lester_city";
    $player1["age"]=27;
    $player1["address"]="sylhet";

    
    $player2["name"]="Karim";
    $player2["club"]= "lester_city";
    $player2["age"]=27;
    $player2["address"]="sylhet";

    $players[]= $player1 ;
    $players[]= $player2;
    print_r($players);





?>