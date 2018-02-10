<?php include 'init.php';
      include 'includes/header.php';
      include 'db/db.php';
      include 'studentFunctions.php';
?>
<h1>TOTAL LOGIN TIME</h1>
<?php 
  if(studentLoggedIn()){
     
    totalLoginTime();
    
  }else{
     header('Location:student.php');    
  }
   


include'includes/footer.php';?>