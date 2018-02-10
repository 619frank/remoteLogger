<?php include 'init.php'; 
     include'includes/header.php';
     include 'db/db.php';
     include'staffFunctions.php';
?>
<?php
    if(staffLoggedIn()){
        
    include'includes/changeStudentSemFrom.php';
        if(!empty($_REQUEST['student_from'])&&!empty($_REQUEST['student_to'])){

            $_SESSION['student_from']=$_REQUEST['student_from'];
            $_SESSION['student_to']=$_REQUEST['student_to'];
            changeStudentSem();
            unset($_SESSION['student_from']);
            unset($_SESSION['student_to']);

        }

    }else{
        header('Location:staff.php');
    }
?>
<?php include'includes/footer.php';?>