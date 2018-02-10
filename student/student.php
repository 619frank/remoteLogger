<?php include 'init.php';
      include 'includes/header.php';
      include 'db/db.php';
      include 'studentFunctions.php';
?>
<h1>HOME</h1>
<?php 
  if(studentLoggedIn()){
     echo 'Welcome'; 
  }
   else{
         echo 'Please Enter UserName and Password to login';
      include'includes/studentLoginForm.php'; 
}
   


include'includes/footer.php';?>