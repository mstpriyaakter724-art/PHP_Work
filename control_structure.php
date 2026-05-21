<?php 
$isLogin = null;
echo $isLogin ? "Welcome to our site.": " Pls login";
 
echo "<br>";
$isLogout = true;
if($isLogout){
    echo " Continue in this site.";
}else{
    echo " Please login";
}


echo "<br>";
$login = $isLogin ?? "Pls login <br>";
echo $login;

echo  $isLogin ? "Welcome": "Pls login <br>";

echo $isLogin ?? "Pls login <br>";


if ($isLogin){
    echo "Welcome <br>";
}else {
    echo "Pls login <br>";
}

$color = "yellow";
switch($color){
    case "red":
        echo "$color is my favorite color.";
        break;
        case "yellow":
            echo " $color is not my favorite color.";
            break;
            default:
            echo " $color is my favorite color.";
            break;
}

echo "<br>";

 for ($i = 1; $i<=5; $i++){
    echo " I love you AmmiJaan. <br>";
 }

$i=1 ;
while($i <=5){
    echo "Love you Baba. <br> ";
    $i++;
}


$i=1;
do{
echo "{$i}. I'm Priya. <br>";

if( $i >= 10){
    break;
}
$i++;
}while(true);
echo "<br>";
echo "<br>";
//________________________Break______________________________
for($i = 1; $i<=10; $i++){     
if($i == 5){
      break;
    }
echo "$i "; 
}
echo "<br>";
//__________________________Continuw______________________________

for($i = 1; $i<=10; $i++){     
if($i == 5){
       continue;
    }
echo "$i "; 
}













?>