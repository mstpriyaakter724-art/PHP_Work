<?php 

echo "Hello Myself !"; 

print "Hello Print! ";

print_r ("Hello Print r! ");
echo "<br>";

$firstName = "Hasan";
$lastName = "Ali";
echo " {$firstName} {$lastName}";
echo "<br>"; 

$num1= 40;
$num2= 10;

$sum = $num1 + $num2;
echo " $num1 + $num2 = $sum";
echo "<br>";

$sub = $num1 - $num2;
echo "$num1 - $num2 = $sub";
echo "<br>";

$multi = $num1 * $num2;
echo "$num1 * $num2 =  $multi";
echo "<br>";

$div = $num1 / $num2;
echo "$num1 / $num2 =  $div";
echo "<br>";

$mod = $num1 % $num2;
echo "$num1 % $num2 =  $mod";
echo "<br>";

$float1 = 1.5;
$float2 = 4.5;
 echo " $float1 , $float2";
echo "<br>";

const PI = 3.1416;
define ("PI2", 3.1416);
echo PI;
echo "<br>";
echo PI2;

echo "<br>";
// array
$student = [ "Jahid","Karim","Rafsan","Hasib"];

print_r ($student);
echo "<br>";
//associative array
$jahid = ["name" => "Jahid Mahmud" , "age"=> 23, "address"=> "Dhaka"];
print_r ($jahid);
echo "<br>";
print_r ($jahid ["age"]);



?>
<br>
<?=   "Hello Universe" ;?><br><br>

<?= "One day I will become a PHP expert"; ?>
