<?php
session_start();
require('../phpcodes/connection.php');
    print_r($_POST);

if(isset($_POST['subjName'])){
    $subjectName = $_POST['subjName'];
    $facultyID=$_POST['facultyID'];

$query = "INSERT INTO subject(subjectName, facultyID) VALUES(?,?)";
        $stmt=mysqli_prepare($conn,$query);
        $stmt->bind_param('si',$subjectName, $facultyID);

if($stmt->execute()){
    // Check the affected rows to verify if the insertion was successful
    
    $affected_rows = $stmt->affected_rows;

    if($affected_rows > 0) {
        $_SESSION['status'] = "Successfully added";
        $_SESSION['status_code'] = "success";
        header('location: ../subject.php');
    } else {
        // Handle the case where no rows were affected (insertion failed)
        $_SESSION['status'] = "Failed to add record";
        $_SESSION['status_code'] = "error";
        header('location: ../subject.php');


    }
} else {
    // Handle the case where the execute method failed
    $_SESSION['status'] = "Error executing query";
    $_SESSION['status_code'] = "error";
    header('location: ../subject.php');

}

}


?>
