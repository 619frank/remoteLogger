<?php include'init.php' ;
      include'includes/header.php';
      include 'db/db.php';
      include'staffFunctions.php';



    if(staffLoggedIn()){
      echo 'Delete Student';
        include'includes/deleteStudentForm.php';
        
        if(!empty($_REQUEST['student_course'])){
            $_SESSION['student_course'] =$_REQUEST['student_course'];
            selectAllStudentName();
           
        } if(isset($_REQUEST['student_email'])){
            $_SESSION['student_email']=$_REQUEST['student_email'];
            actualDelete();
            unset($_SESSION['student_email']);
            unset($_SESSION['student_course']);
        }
        

    }
    else{
    header('Location:staff.php');
     }




 include'includes/footer.php';?>