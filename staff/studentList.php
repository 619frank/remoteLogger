<?php include'init.php' ;
      include'includes/header.php';
      include 'db/db.php';
      include'staffFunctions.php';?>
<?php

if(staffLoggedIn()){
    echo "STUDENT LIST";
include('includes/studentListForm.php');
if(!empty($_REQUEST['course'])){
    selectStudentList();
    }
}else{
    header('Location:staff.php');
}
?>

<?php include'includes/footer.php';?>