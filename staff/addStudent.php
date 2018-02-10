<?php include'init.php' ;
      include'includes/header.php';
      include 'db/db.php';
      include'staffFunctions.php';?>

<?php 

if(staffLoggedIn()){

    echo'ADD STUDENT<br>';
    if(!empty($_REQUEST['student_name'])&&!empty($_REQUEST['student_email'])&&!empty($_REQUEST['student_sysno'])&&!empty($_REQUEST['student_password'])&&!empty($_REQUEST['student_course'])){
        
        addStudent();

       
    }else{
        echo 'Please Fill all the fields and click Add';
    }
    
  include'includes/addStudentForm.php';
}else{
    header('Location:staff.php');
}

?>



<?php include'includes/footer.php';?>