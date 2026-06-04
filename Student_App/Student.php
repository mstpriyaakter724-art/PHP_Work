<?php
class Student
{
    public $id;
    public $name;
    public $email;
    public $gender;
    public $mobile;

    public function __construct($_id, $_name, $_email, $_gender, $_mobile)
    {

        $this->id = $_id;
        $this->name = $_name;
        $this->email = $_email;
        $this->gender = $_gender;
        $this->mobile = $_mobile;
    }


    function save()
    {
        $data = PHP_EOL . "$this->id,$this->name,$this->email,$this->gender,$this->mobile";
        file_put_contents("Students_data.txt", $data, FILE_APPEND);
        // print_r($data);
    }


    static function find($_id)
    {
        $data = file("Students_data.txt");
        $result = "";
        foreach ($data as $key => $value) {
            list($sid, $name, $email, $gender, $mobile)= explode(",", $value);

            if ($sid == $_id) {
                $result = compact("sid", "name", "email", "gender", "mobile");
            }
        }
        return $result;
    }





    static function show()
    {
        $data = file("Students_data.txt",FILE_SKIP_EMPTY_LINES| FILE_IGNORE_NEW_LINES);
        $html = "
            <table class='table'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Action</th>

                        </tr>
                    </thead>
            <tbody>
        ";
        foreach($data as $key => $value){
            list($id, $name,$email,$gender,$mobile)= explode(",", $value);

            $html.="
                <tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$gender</td>
                    <td>$mobile</td>
                    <td>Edit | Delete</td>
                </tr>

            ";
        }
        return $html.="
                    </tbody>
                </table>";
    }


//     public function __toString()
//     {
//        echo  "$this->id,$this->name,$this->email,$this->gender,$this->mobile";
//     }
}

// $student = new Student(9,"Rasel","rasel@gmail.com", "male", "018905678435");
// $student->save();
// print_r($student);
?>


