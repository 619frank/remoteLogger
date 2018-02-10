<?php include'init.php' ;
      include'includes/header.php';
      include 'db/db.php';
      include'staffFunctions.php';



if(staffLoggedIn()){

        echo 'ADD PRACTICAL MARK';
        include'includes/addPracticalMarkForm.php';

        if(isset($_REQUEST['student_course'])){
            $_SESSION['student_course'] =$_REQUEST['student_course'];
            rollNoSelection();
        }

            if(isset($_REQUEST['student_email'])){
                $_SESSION['student_email']=$_REQUEST['student_email'];
                echo '<br>SELECT SUBJECT';
                if(($_SESSION['student_course']=="1st BCA") ||($_SESSION['student_course']== "2nd BCA") ||($_SESSION['student_course']== "3rd BCA")){
                    echo '<br><b>'.$_SESSION['student_course'].'</b><br>';
                    include'includes/addPracticalMarkFormBCA.php';    
                }
                elseif(($_SESSION['student_course']=="1st CS")||($_SESSION['student_course']=="2nd CS") ||($_SESSION['student_course']== "3rd CS")){
                    echo '<br><b>'.$_SESSION['student_course'].'</b><br>';
                    include'includes/addPracticalMarkFormCS.php';
                }
                elseif(($_SESSION['student_course']=="1st Msc") ||($_SESSION['student_course']== "2nd Msc") ||($_SESSION['student_course']== "3rd Msc")){
                    echo '<br><b>'. $_SESSION['student_course'].'</b><br>';
                    include'includes/addPracticalMarkFormMSC.php';
                }
            
        

        }

        if(isset($_REQUEST['enter_mark'])&&isset($_REQUEST['selected_subject'])){
            $_SESSION['mark']=$_REQUEST['mark'];
            $_SESSION['selected_subject']=$_REQUEST['selected_subject'];

            if(($_SESSION['student_course']=="BCA")||($_SESSION['student_course']=="2nd BCA") ||($_SESSION['student_course']== "3rd BCA")){
                updateStudentMarkBCA();   
                unset($_SESSION['student_course']);
                unset($_SESSION['mark']);
                unset($_SESSION['student_email']);
            }
             elseif(($_SESSION['student_course']=="1st CS")||($_SESSION['student_course']=="2nd CS") ||($_SESSION['student_course']== "3rd CS")){
                updateStudentMarkCS();
                unset($_SESSION['student_course']);
                unset($_SESSION['mark']);
                unset($_SESSION['student_email']);
             }
             elseif(($_SESSION['student_course']=="1st Msc") ||($_SESSION['student_course']== "2nd Msc") ||($_SESSION['student_course']== "3rd Msc")){
                updateStudentMarkMSC();
                unset($_SESSION['student_course']);
                unset($_SESSION['mark']);
                unset($_SESSION['student_email']);
            }

        }
       

    }else{
        header('Location:staff.php');
    }

 include'includes/footer.php';?>