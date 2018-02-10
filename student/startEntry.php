<?php include 'init.php';
      include 'includes/header.php';
      include 'db/db.php';
      include 'studentFunctions.php';
?>
<h1>Make Entry Page</h1>
<?php 
  if(studentLoggedIn()){
    selectStudentNameAndSysnoAndClass();
    startEntry();
    echo 'You have succefully made the Start Entry';
    echo '<br>Now When you finish the session Please Click on the Stop the Entry';



  }else{
     header('Location:student.php');    
  }
   


include'includes/footer.php';?>