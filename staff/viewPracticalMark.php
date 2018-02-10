<?php include'init.php' ;
      include'includes/header.php';
      include 'db/db.php';
      include'staffFunctions.php';?>
<?php

echo '<p>VIEW PRACTICAL MARK</p>';

if(staffLoggedIn()){
    include'includes/viewPracticalMarkForm.php';

    if(isset($_REQUEST['student_course'])){
        $_SESSION['student_course']=$_REQUEST['student_course'];
        rollNoSelectionForView();
    }
    if(isset($_REQUEST['student_email'])){
        $_SESSION['student_email']=$_REQUEST['student_email'];

        if(($_SESSION['student_course']=="1st BCA") ||($_SESSION['student_course']== "2nd BCA") ||($_SESSION['student_course']== "3rd BCA")){
            viewPracticalMarkBCA();
            unset($_SESSION['student_course']);
            unset($_SESSION['student_email']);
        }
        elseif(($_SESSION['student_course']=="1st CS")||($_SESSION['student_course']=="2nd CS") ||($_SESSION['student_course']== "3rd CS")){
            viewPracticalMarkCS();
            unset($_SESSION['student_course']);
            unset($_SESSION['student_email']);
        }
        elseif(($_SESSION['student_course']=="1st Msc") ||($_SESSION['student_course']== "2nd Msc") ||($_SESSION['student_course']== "3rd Msc")){
            viewPracticalMarkMSC();
            unset($_SESSION['student_course']);
            unset($_SESSION['student_email']);
        }
    
    }

}else{
    header("Location:staff.php");
}
?>



<?php include'includes/footer.php';?>