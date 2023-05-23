<?php include "inc/header.php";?>
<?php include "lib/students.php";?>
<?php 
    // error_reporting(0);
    $student = new Student;
    $cur_date = date('d-m-Y');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $attend = $_POST['attend'];
        $insert_attend =$student->insertAttendance($cur_date,$attend); 
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
            <a class="btn btn-info" href="add.php">Add Student/Employee</a>
            <a class="btn btn-warning pull-right" href="index.php">Take Attendances</a>
        </h2>
    </div>
    <div class="panel-body">
        <div class="well text-right" style="font-size:18px;">
            <strong>Date :</strong><?php date_default_timezone_set("Asia/Dhaka"); echo date('d-m-Y/h:i:sa');?>
        </div>
        <form action="" method='post'>
            <table class="table table-striped">
                <tr>
                    <th width ='35%'>Serial</th>
                    <th width ='45%'>Attendances Date</th>
                    <th width ='20%'>Action</th>
                </tr>
                <?php
                    $get_date = $student->get_date();
                    if ($get_date) {
                        $i = 0;
                        while ($result = $get_date->fetch_assoc()) {
                            $i++;
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $result['att_time'];?></td>
                    <td>
                        <a class="btn btn-success" href="student_view.php?date=<?php echo $result['att_time'];?>">View</a>
                    </td>
                </tr>
                <?php }}?>
                
            </table>
        </form>
    </div>
</div>
<?php include "inc/footer.php";?>