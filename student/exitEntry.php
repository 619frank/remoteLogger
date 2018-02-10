<?php include 'init.php';
      include 'includes/header.php';
      include 'db/db.php';
      include 'studentFunctions.php';
?>
<h1>Exit Entry Page</h1>
<?php 
  if(studentLoggedIn()){
     
    selectLastEntrySno();
    updateExitEntry();
    updatAvgTime();

    echo '<br><br> You have successfully Made the Exit Entry<br>';
    
  }else{
     header('Location:student.php');    
  }
   


include'includes/footer.php';?>