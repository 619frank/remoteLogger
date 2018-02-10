<?php include 'init.php';
      include 'includes/header.php';
      include 'db/db.php';
      include 'studentFunctions.php';
?>
<?php 

 
if(studentLoggedIn()){
    header('Location:student.php');
    }
else{

if(!empty($_REQUEST['student_email'])&&!empty($_REQUEST['student_password'])){

    $student_email=$_REQUEST['student_email'];
    $student_password=$_REQUEST['student_password'];
    validateStudent();
    getStudentId();
    echo '<br>Please use the Menu in the left side to use the full Functionality';
}}




include'includes/footer.php';?>