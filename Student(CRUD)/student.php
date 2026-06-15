 <?php

    class Student
    {
        public $id;
        public $name;
        public $email;
        public $department;
        public $cgpa;

    
        public function __construct($id, $name, $email, $department, $cgpa)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->department = $department;
            $this->cgpa = $cgpa;
        }

        public static function all()
        {
            global $db;
            $studentData = [];
            $stmt = $db->query("select * from students");
            $data = $stmt->fetch_all(MYSQLI_ASSOC);

            foreach ($data as $value) {
                array_push($studentData, (object)$value);
            }
            return $studentData;
        }

        public function create()
        {
            global $db;
            $stmt = $db->query("insert into students (name,email,department,cgpa)
                                values('$this->name',
                                 '$this->email',
                                 '$this->department',
                                  '$this->cgpa'

                                 )");

            return $db->insert_id;
        }

        public function update() {
            global $db;
            $stmt = $db->query("update  students set name = '$this->name',
                                                     email = '$this->email',
                                                     department = '$this->department',
                                                     cgpa = '$this->cgpa' WHERE ID='$this->id '          
                                                      ");
                   return $stmt;                                   
        }

        public static function find($id) {
            global $db;
            $stmt = $db->query("select * from students where id=$id");
            $data = $stmt->fetch_object();
            return $data;       
        }

        public static function delete($id) {
            global $db;
            $stmt = $db->query("delete from students where id= $id");
            return $stmt;
        }
    }



    ?>