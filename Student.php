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
      $this->id = trim($_id);
      $this->name = trim($_name);
      $this->email = trim($_email);
      $this->gender = trim($_gender);
      $this->mobile = trim($_mobile);
   }


   function save()
   {

     global $db;
     $stmt = $db->query("insert into students(name,email,gender,mobile)
         values('$this->name',
               '$this->email',
               '$this->gender',
               '$this->mobile'
               )"
        );
      return "Saved successfully";
   }

   static function find($_id)
   {
      global $db;
      $data = $db->query("select * from students where id=$_id");
      $student = $data->fetch_object();
      return $student;
    
   }

   static function all()
   {
      global $db;
      $studentData = [];
      $stmt= $db->query("select * from students");
      $data= $stmt->fetch_all(MYSQLI_ASSOC);

      foreach($data as $value){
         array_push($studentData, (object) $value);
      }
      return $studentData;
   }


   function update()
   {
      global $db;
     $stmt = $db->query("update students set 
               name='$this->name',
               email='$this->email',
               gender='$this->gender',
               mobile='$this->mobile' where id=$this->id
               ");

      return "updated successfully";
   }

   static function delete($_id)
   {
      global $db;
      $stmt = $db->query("delete from students where id=$_id");
      return   "Deleted succesfully";
   }


   private function getData()
   {
      return file("students_data.txt",FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
   }
}

//  $student= new Student(2,"Kazi Ahmed","rasel@gmail.com","male", "011111111");
//  $student->update();

//  print_r( Student::find(2) );
