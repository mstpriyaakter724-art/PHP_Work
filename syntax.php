<?php
// 1. Introduction to PHP 
// __________________________________________________________________________________________________
// PHP stands for " Hypertext Preprocessor"
// It is a server-side scripting language used for web development.
// PHP code is executed on the server and sent to the browder as HTML.
// __________________________________________________________________________________________________

// 2. PHP Syntax, Tags, and Code Structure

echo " <h1>PHP Basic </h1>";
// echo "<br>";
print " This is printed using print.<br>";
echo " Multiple", " String", "With echo. <br>";
$result = print " Print returns a value: <br>";
echo $result."<br>";  // Output:1
$array = ["Apple", "Banana", "Cherry"];
print_r ($array); 
echo "<br>";

echo "<br> As  string: <br> <pre>" . print_r($array,true). "</pre>";

$val = 42.5;

var_dump($val);

echo "<br>";

$complexArray = [1, "two" , 3.14];
var_dump($complexArray);

echo "<br>";

$data = ["name" => "John", "age" => 30];
var_export ($data);

echo "<br>";

$number = 10;
printf("Formatted number: %b<br>", $number);

echo "<br>";

printf("Formatted number: %o<br>", $number);
echo "<br>";

$name= "Alice !";
printf("Hello, %s<br>", $name);
echo "<br>";

$msg = sprintf("Welcome, %s. You have %.1f points.", "Bob", 85.7);
echo $msg . "<br>";

$name = "Hasan";
echo "<p> His name is {$name}.</p>";


// _______________________String Operator____________________________
echo " <h3> String Operator</h3>";


$text = "Hello PHP World.";
echo "Length: " . strlen($text) . "<br>";    //String length
echo "word Count: " . str_word_count($text). "<br>";   // Word count


echo "Uppercase: " . strtoupper($text). "<br>";     // Uppercase

echo "Lowercase: " . strtolower($text). "<br>";   // Lower case

echo "Trimmed: " . trim($text). "<br>";    // Trim spaces

echo "Replace: " . str_replace("PHP", "Laravel", $text). "<br>";    //Replace

//_______________________Type Casting_________________________________

echo "<h3> Type Casting </h3>";


$val = "100.33";

$intVal = (int) $val;   // Cast to integer

$floatVal = (float) $val;  //Cast to float

$stydent = (object)[ "name" => "Hasan", "age" => 20];

var_dump($stydent);

echo "<br>";
echo "<br>";

var_dump ($val, $intVal, $floatVal);

echo "<br>";
echo "<br>";

printf (" My int Number is %d.", $intVal);



?>