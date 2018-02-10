<?php include 'init.php'; 
     include'includes/header.php';
     include 'db/db.php';
     include'staffFunctions.php';
?>
<?php
    if(staffLoggedIn()){
        header('Location:staff.php');
        }else{
            $staff_uname = $_REQUEST['staff_uname'];
            $staff_pass = $_REQUEST['staff_pass'];
            validateStaff();
            getStaffId();
            header('Location:staff.php');
    }
?>
<?php include'includes/footer.php';?>