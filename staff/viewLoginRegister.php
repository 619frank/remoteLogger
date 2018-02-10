<?php include'init.php' ;
      include'includes/header.php';
      include 'db/db.php';
      include'staffFunctions.php';?>

      <h1>VIEW LOGIN REGISTER</h1>
<?php

if(staffLoggedIn()){
 
    include'includes/viewLoginRegisterForm.php';
    if(isset($_REQUEST['student_course_VLR'])&&isset($_REQUEST['date'])){
       $_SESSION['student_course_VLR']=$_REQUEST['student_course_VLR'];
       $_SESSION['date']=date("Y-m-d H:i:s",strtotime($_REQUEST['date']));
       $_SESSION['added_date']=date("Y-m-d H:i:s",strtotime($_REQUEST['date'].'+ 1 day'));

       viewLoginRegister();
    }

    
}else{
    header('Location:staff.php');
}
?>

<?php include'includes/footer.php';?>