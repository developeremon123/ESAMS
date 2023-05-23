<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/Database.php');
?>
<?php 
    class Student{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }
        public function getStudents(){
            $query =  "SELECT * FROM tbl_student";
            $result = $this->db->select($query);
            return $result;
        }
        public function insertStudents($name,$roll){
            $name = mysqli_real_escape_string($this->db->link, $name);
            $roll = mysqli_real_escape_string($this->db->link, $roll);

            if (empty($name) || empty($roll)) {
                $smg = "<div class ='alert alert-danger'>"."<strong>Error !</strong> Fields must not be empty !"."</div>";
                return $smg;
            }else {
                $stu_query = "INSERT INTO tbl_student(name,roll) VALUES('$name','$roll')";
                $result = $this->db->insert($stu_query);
                
                $att_query = "INSERT INTO tbl_attendence(roll) VALUES('$roll')";
                $result = $this->db->insert($att_query);
                if ($result) {
                    $smg = "<div class ='alert alert-success'>"."<strong> Sussess !</strong> Student Data Inserted Successfully."."</div>";
                    return $smg;
                }else {
                    $smg = "<div class ='alert alert-danger'>"."<strong> Error !</strong> Data Not Inserted."."</div>";
                    return $smg;
                }
            }
        }
        public function insertAttendance($cur_date, $attend = array()) {
            $query = "SELECT DISTINCT att_time FROM tbl_attendence";
            $getData = $this->db->select($query);
            
            while ($result = $getData->fetch_assoc()) {
                $db_date = $result['att_time'];
                if ($cur_date == $db_date) {
                    $smg = "<div class='alert alert-danger'><strong>Error!</strong> Attendance already taken today!</div>";
                    return $smg;
                }
            }
            
            foreach ($attend as $atn_key => $atn_value) {
                if ($atn_value == "present") {
                    $stu_query = "INSERT INTO tbl_attendence (roll, attend, att_time) VALUES ('$atn_key', 'present', NOW())";
                    $result = $this->db->insert($stu_query);
                } elseif ($atn_value == "absent") {
                    $stu_query = "INSERT INTO tbl_attendence (roll, attend, att_time) VALUES ('$atn_key', 'absent', NOW())";
                    $result = $this->db->insert($stu_query);
                }
            }
            
            if ($result) {
                $smg = "<div class='alert alert-success'><strong>Success!</strong> Attendance Inserted.</div>";
                return $smg;
            } else {
                $smg = "<div class='alert alert-danger'><strong>Error!</strong> Attendance Not Inserted!</div>";
                return $smg;
            }
        }
        
        
        public function get_date(){
            $query = "SELECT DISTINCT att_time FROM tbl_attendence";
            $getdate = $this->db->select($query);
            return $getdate;
        }
        
    }


    
 

?>