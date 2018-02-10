<?php include 'init.php';
      include 'includes/header.php';
      include 'db/db.php';
      include 'studentFunctions.php';
?>
<h1>Practical Marks</h1>
<?php 
  if(studentLoggedIn()){

    selectStudentNameAndSysnoAndClass();

    if(($_SESSION['student_class']="1st BCA")||($_SESSION['student_class']="2nd BCA")||($_SESSION['student_class']=="3rd BCA")){
        viewPracticalMarkBCA();
    }elseif(($_SESSION['student_class']="1st CS")||($_SESSION['student_class']="2nd CS")||($_SESSION['student_class']=="3rd CS")){
        viewPracticalMarkCS();
    }elseif(($_SESSION['student_class']="1st Msc")||($_SESSION['student_class']="2nd Msc")){
        viewPracticalMarkMSC();
    }

  }else{
     header('Location:student.php');    
  }
   


include'includes/footer.php';?>