<?php include "inc/header.php";?>
<?php include "lib/students.php";?>
<?php 
    // error_reporting(0);
    $student = new Student;
    $cur_date = date("Y-m-d");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $attend = $_POST["attend"];
        $insert_attend = $student->insertAttendance($cur_date, $attend);
        
    }
?>
<?php 
    if (isset($insert_attend)) {
        echo $insert_attend;
    }
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn btn-primary" href="add.php">Add Student/Employee</a>
            <a class="btn btn-info pull-right" href="date_view.php">View All</a>
        </h2>
    </div>
    <div class="panel-body">
        <div class="well text-right" style="font-size:18px;">
            <strong>Date :</strong><?php date_default_timezone_set("Asia/Dhaka"); echo date('d-m-Y/h:i:sa');?>
        </div>
        <form action="" method='post'>
            <table class="table table-striped">
                <tr>
                    <th width ='25%'>Serial</th>
                    <th width ='25%'>Employee/Students Name</th>
                    <th width ='25%'>Employee/Students Roll</th>
                    <th width ='25%'>Attendances</th>
                </tr>
                <?php
                    $get_students = $student->getStudents();
                    if ($get_students) {
                        $i = 0;
                        while ($result = $get_students->fetch_assoc()) {
                            $i++;
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $result['name'];?></td>
                    <td><?php echo $result['roll'];?></td>
                    <td>
                        <input type="radio" name="attend[<?php echo $result['roll'];?>]" value="present">P
                        <input type="radio" name="attend[<?php echo $result['roll'];?>]" value="absent">A
                    </td>
                </tr>
                <?php }}?>
                <tr>
                    <td colspan="4">
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include "inc/footer.php";?>