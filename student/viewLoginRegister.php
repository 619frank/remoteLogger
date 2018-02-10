<?php include 'init.php';
      include 'includes/header.php';
      include 'db/db.php';
      include 'studentFunctions.php';
?>
<h1>View Login Register</h1>
<?php 
  if(studentLoggedIn()){
    viewLoginRegister();

  }else{
     header('Location:student.php');    
  }
   


include'includes/footer.php';?>