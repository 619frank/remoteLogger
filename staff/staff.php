<?php include'init.php' ;
      include'includes/header.php';
      include 'db/db.php';
      include'staffFunctions.php';?>
  <h1>HOME</h1>
  
   <?php 
   
   if(staffLoggedIn()){
     echo 'You have successfully Logged in';
     echo '<br>USE THE LEFT MENU TO DO THE ADMIN TASKS';
   }else{
    include'includes/staffloginform.php';
   }
    
   
   
   ?>

		<?php include'includes/footer.php';?>