
    <?php 
    $errors = [];

    
        $name = "";
        $email =  "";
        $city =  "";
        $subjects = [];
    
        $address = "";
        $gender =  "";


    if (isset($_POST["btn_submit"])){
    
        // print_r($_POST);

        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $city = $_POST["city"] ?? "";
        $subjects = $_POST["subject"] ??[];
        $subject = implode("|" , $subjects);
        $address = $_POST["address"] ?? "";
        $gender = $_POST["gender"] ?? "";



            $patterm_name = "/^[a-zA-Z _.]{4,}$/";
            if($name == ""){
                $errors["name"] = "Name filed is required !";
            }elseif(!preg_match($patterm_name,$name)){
               $errors["name"] = "Invalid Name ! Give at list 4 charecter"; 
            }



            $patterm_email = "/^[a-zA-Z0-9_]{3,}[@][a-z]{2,}[.][a-z]{2,}$/";
             if($email == ""){
                $errors["email"] = "email filed is required !";
            }elseif(!preg_match($patterm_email, $email)){
                 $errors["email"] = "Invalid email !";
            }

             if($city == ""){
                $errors["city"] = "city filed is required !";
            }

             if($subject == ""){
                $errors["subject"] = "subject filed is required !";
            }

             if($address == ""){
                $errors["address"] = "address filed is required !";
            }

             if($gender == ""){
                $errors["gender"] = "gender filed is required !";
            }



        // echo " $name  $email  $city    $address  $gender  ";
            $data =" $name,$email,$city,$subject,$address,$gender";
            file_put_contents("students_data.txt", $data , FILE_APPEND);

        }
 
 
    ?>









<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form</title>
    </head>
<body>
    <form action="" method="post">
        <div>
            <label for="name">User name</label><br>
            <input type="text" name="name" id="name" value ="<?php echo $name ?>"><br>
             <?php echo isset($errors["name"]) ? "<span style = 'font-size: 11px; color:red'>{$errors["name"]}</span>": "";
             ?>
        </div> <br>
        <div>
            <label for="email">User email</label><br>
            <input type="text" name="email" id="email" value="<?php echo $email ?>"> <br>
              <?php echo isset($errors["email"]) ? "<span style = 'font-size: 11px; color:red'>{$errors["email"]}</span>": "";
             ?>         
        </div> <br>
        <div>
            <label for="city" >City</label><br>
            <select name="city" id="city">
                <option disabled selected>Select your city</option>
                <option <?php echo $city == "Dhaka" ? "selected" : "" ?> value="Dhaka">Dhaka</option>
                <option <?php echo $city == "Rajshahi" ? "selected" : "" ?> value="Rajshahi">Rajshahi</option>
                <option <?php echo $city == "Barishal" ? "selected" : "" ?>  value="Barishal">Barishal</option>
                <option <?php echo $city == "Sylhet" ? "selected" : "" ?> value="Sylhet">Sylhet</option>
                <option <?php echo $city == "Sylhet" ? "selected" : "" ?> value="Shariatpur">Shariatpur</option>
            </select><br>
            <?php echo isset($errors["city"]) ? "<span style = 'font-size: 11px; color:red'>{$errors["city"]}</span>": "";
             ?>
        </div> <br>
        <div>
            <label for="gender">Gender</label><br>
            <input <?php echo $gender == "Male" ? "checked" : "" ?> type="radio" name="gender" id="Male" value="Male">Male

            <input <?php echo $gender == "Female" ? "checked" : "" ?>  type="radio" name="gender" id="Female" value="Female">Female <br>

            <?php echo isset($errors["gender"]) ? "<span style = 'font-size: 11px; color:red'>{$errors["gender"]}</span>": "";
             ?>
        </div> <br>
        <div>
            <label for="subject">Subject</label><br>
            <input <?= in_array("PHP",$subjects) ? "checked": ""?> type="checkbox" name="subject[]" id="PHP" value="PHP">PHP
             <input <?php echo in_array("CSS",$subjects) ? "checked": ""?> type="checkbox" name="subject[]" id="CSS" value="CSS">CSS
              <input <?php  echo in_array("Bootstrap",$subjects) ? "checked": ""?> type="checkbox" name="subject[]" id="Bootstrap" value="Bootstrap">Bootstrap
               <input <?php echo in_array("MYSQL",$subjects) ? "checked": ""?> type="checkbox" name="subject[]" id="MYSQL" value="MYSQL">MYSQL
                <input <?php echo in_array("Javascript",$subjects) ? "checked": ""?> type="checkbox" name="subject[]" id="Javascript" value="Javascript">Javascript <br>
                <?php echo isset($errors["subject"]) ? "<span style = 'font-size: 11px; color:red'>{$errors["subject"]}</span>": "";
             ?>
        </div> <br>
        <div>
            <label for="address">Address</label><br>
            <textarea name="address" id="address"><?php echo $address ?></textarea> <br>
            <?php echo isset($errors["address"]) ? "<span style = 'font-size: 11px; color:red'>{$errors["address"]}</span>": "";
             ?>
        </div> <br>
        <div>
            <input type="submit" name="btn_submit" id="">
        </div> <br>
    </form>





</body>
</html>