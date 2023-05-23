<?php include "inc/header.php";?>
<?php include "lib/students.php";?>
<?php 
    $student = new Student;
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $roll = $_POST['roll'];
        $insert_data = $student->insertStudents($name,$roll);
    }
?>
<?php 
    if (isset($insert_data)) {
        echo $insert_data;
    }
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn btn-info " href="index.php">Back</a>
            <!-- <a class="btn btn-primary" href="add.php">Add Student</a> -->
        </h2>
    </div>
    <div class="panel-body " style="max-width:600px; margin:0 auto;">
        <form action="" method='post'>
            <div class="form-group">
                <label for="name">Employee/Student Name</label>
                <input type="text" name="name" id="name"  class="form-control">
            </div>
            <div class="form-group">
                <label for="roll">Employee/Student Roll</label>
                <input type="number" name="roll" id="roll" class="form-control ">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="submit" value="Add Student" >
            </div>
        </form>
    </div>
</div>
<?php include "inc/footer.php";?>