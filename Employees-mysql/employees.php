 <?php 
 
 class Employee
 {
    public $id;
    public $name;
    public $phone;
    public $department;
    public $designation;
    public $salary;



    public function __construct($_id,$_name,$_phone,$_department,$_designation,$_salary)
    {
       $this->id= trim($_id);
       $this->name= trim($_name);
       $this->phone=trim($_phone);
       $this->department= trim($_department);
       $this->designation=trim($_designation);
       $this->salary=trim($_salary);
    }


    static function all()
    {
        global $db;
        $employeeData=[];
        $stmt = $db->query("select * from employees");
        $data = $stmt->fetch_all(MYSQLI_ASSOC);

        foreach($data as $value){
            array_push($employeeData, (object) $value);
        }
        return $employeeData;
    }



    function save()
    {
        global $db;
        $stmt= $db->query("insert into employees (name,phone,department,designation,salary)
                values('$this->name', '$this->phone', '$this->department', ' $this->designation',' $this->salary' ) ");

                return "Saved successfully";
    }

    static function find($_id)
    {
        global $db;

        $data = $db->query("select * from employees where id=$_id");
        $student = $data->fetch_object();
        return $student;
    }

    function update()
    {
        global $db;

        $stmt= $db->query(" update employees set
                         name= '$this->name',
                         phone='$this->phone',
                         department= '$this->department',
                         designation= '$this->designation',
                         salary = '$this->salary' where id=$this->id        

                        ");

                return "Updated succesfully"; 
    }

    static function delete($_id)
    {
        global $db;
        $stmt = $db->query("delete from employees where id=$_id");
        return "Delete succesfully";
    }







 }
 
 
 
 ?>