<?php
function validateStaff(){
    global $staff_uname;
    global $staff_pass;
    if(isset($staff_uname)&&isset($staff_pass)){
        global $con;
        $sql = 'SELECT staff_uname, staff_pass FROM staff where staff_uname="' . $staff_uname . '" AND staff_pass="' . $staff_pass . '"';
        $result = mysqli_query($con, $sql);
    
        while ($final = mysqli_fetch_assoc($result)) {
            $_SESSION['staff_uname'] = $final['staff_uname'];
            $selected_staff_password = $final['staff_pass'];
        }
    
        if ($staff_uname == $_SESSION['staff_uname'] && $staff_pass == $selected_staff_password) {
            echo 'you have logged in successfully';
        } else {
            echo 'couldn\'t login you';
        }
    }else{
        echo 'Please Enter username and Password';
    }
    
}

function getStaffId(){
    global $con;
    $sql = 'select staff_id from staff where staff_uname="'.$_SESSION["staff_uname"].'"';
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result)){
        $_SESSION['staff_id']=$row['staff_id'];
        
    }
    return $_SESSION['staff_id'];
}

function staffLoggedIn(){
    if(isset($_SESSION['staff_uname'])){
    return true;
    }else{
        return false;
    }
}

function addStudent(){
        $student_name=$_REQUEST['student_name'];
        $student_email=$_REQUEST['student_email'];
        $student_sysno=$_REQUEST['student_sysno'];
        $student_password=$_REQUEST['student_password'];
        $student_course=$_REQUEST['student_course'];
    global $con;
    $sql = "INSERT INTO `student` (`student_id`, `student_email`, `student_password`, `student_name`, `student_class`, `system_number`) VALUES (NULL, '$student_email', '$student_password', '$student_name', '$student_course', '$student_sysno')";
    $result=mysqli_query($con,$sql);


    
    function recordInsertBCA(){
        global $con;
        $sql = "INSERT INTO BCA (stud_name, stud_id,student_email) select student_name, student_id,student_email from student where student_email= '".$_REQUEST['student_email']."' ";
        $result=mysqli_query($con,$sql);
    }
    function recordInsertCS(){
        global $con;
        $sql = "INSERT INTO CS (stud_name, stud_id,student_email) select student_name, student_id,student_email from student where student_email= '".$_REQUEST['student_email']."' ";
        $result=mysqli_query($con,$sql);
    }
    function recordInsertMSC(){
        global $con;
        $sql = "INSERT INTO MSC (stud_name, stud_id,student_email) select student_name, student_id,student_email from student where student_email= '".$_REQUEST['student_email']."' ";
        $result=mysqli_query($con,$sql);
    }

    if(($_REQUEST['student_course']=="1st BCA") ||($_REQUEST['student_course']== "2nd BCA") ||($_REQUEST['student_course']== "3rd BCA")){
        recordInsertBCA();
     }
    elseif(($_REQUEST['student_course']=="1st CS")||($_REQUEST['student_course']=="2nd CS") ||($_REQUEST['student_course']== "3rd CS")){
        recordInsertCS();
     }
     elseif(($_REQUEST['student_course']=="1st Msc") ||($_REQUEST['student_course']== "2nd Msc") ||($_REQUEST['student_course']== "3rd Msc")){
        recordInsertMSC();
    }
}

function selectStudentList(){
    $student_course =$_REQUEST['course'];
    global $con;
    $sql = "select `student_email`, `student_password`, `student_name`, `system_number` from student where student_class='$student_course' ";
    $result=mysqli_query($con,$sql);
    echo "<table border='1'>
    <tr>
    <th>Student Name</th>
    <th>Student RollNo</th>
    <th>Student System_number</th>
    <th>Student Password</th>
    
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_name'] . "</td>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['system_number'] . "</td>";
    echo "<td>" . $row['student_password'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table>";
    
    mysqli_close($con);
}


function selectAllStudentName(){
    global $con;
    
    $sql = "select `student_email` from student where student_class='".$_SESSION['student_course']."' ";
    $result=mysqli_query($con,$sql);

    echo '<form action ="deleteStudent.php" method="POST" >Select Student to Delete<br>
          <select name ="student_email">';

    while($row=mysqli_fetch_array($result)){
        echo '<option>'.$row[student_email].'</option>';
       
    }
    echo '</select> <input type=submit value="delete"></form>';

   
}
function actualDelete(){
        global $con;
    function recordDeleteBCA(){
        global $con;
        $sql="delete from BCA where student_email='".$_SESSION['student_email']."'";
        $result=mysqli_query($con,$sql);
    }
    function recordDeleteCS(){
        global $con;
        $sql="delete from CS where student_email='".$_SESSION['student_email']."'";
        $result=mysqli_query($con,$sql);
    }
    function recordDeleteMSC(){
        global $con;
        $sql="delete from MSC where student_email='".$_SESSION['student_email']."'";
        $result=mysqli_query($con,$sql);
    }


    if(($_SESSION['student_course']=="1st BCA") ||($_SESSION['student_course']== "2nd BCA") ||($_SESSION['student_course']== "3rd BCA")){
        recordDeleteBCA();
    }
    elseif(($_SESSION['student_course']=="1st CS")||($_SESSION['student_course']=="2nd CS") ||($_SESSION['student_course']== "3rd CS")){
        recordDeleteCS();
    }
    elseif(($_SESSION['student_course']=="1st Msc") ||($_SESSION['student_course']== "2nd Msc") ||($_SESSION['student_course']== "3rd Msc")){
        recordDeleteMSC();
    }


    $sql="delete from student where student_email='".$_SESSION['student_email']."'";
    $result1=mysqli_query($con,$sql);



}


function selectStudentID(){
    global $con;
    $_SESSION['student_name'] =$_REQUEST['student_name'];
    $sql ="select `student_id` from student where student_name='".$_SESSION['student_name']."'";
    $result=mysqli_query($con,$sql);

    while($row=mysqli_fetch_array($result)){
       
        $_SESSION['student_id']=$row['student_id'];
    }
    return $_SESSION['student_id'];
}

function selectStudentName(){
    global $con;
    $sql = "select student_name from student where student_id=".$_SESSION['student_id'];
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result)){
        $_SESSION['student_name']= $row['student_name'];
    }
    return $_SESSION['student_name'];
 }

function rollNoSelection(){
    global $con;
    
    $sql = "select `student_email` from student where student_class='".$_SESSION['student_course']."' ";
    $result=mysqli_query($con,$sql);

    echo '<br><form action ="addPracticalMark.php" method="POST" >Select Student to Add mark<br>
    <select name ="student_email">';

    while($row=mysqli_fetch_array($result)){
        echo '<option>'.$row[student_email].'</option>';
    }
    echo '</select> <input type=submit value="Select Student" name="submit_student_email"></form>';
   

}




function updateStudentMarkBCA(){
    
    global $con;
    $sql = "UPDATE BCA SET ".$_SESSION['selected_subject']."=".$_SESSION['mark']."  WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);
}

function updateStudentMarkCS(){
    
    global $con;
    $sql = "UPDATE CS SET ".$_SESSION['selected_subject']."=".$_SESSION['mark']."  WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);
}

function updateStudentMarkMSC(){
    
    global $con;
    $sql = "UPDATE MSC SET `".$_SESSION['selected_subject']."`=".$_SESSION['mark']."  WHERE `student_email`='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);
}

function rollNoSelectionForView(){
    global $con;
    
    $sql = "select `student_email` from student where student_class='".$_SESSION['student_course']."' ";
    $result=mysqli_query($con,$sql);

    echo '<br><form action ="viewPracticalMark.php" method="POST" >Select Student to Add mark<br>
    <select name ="student_email">';

    while($row=mysqli_fetch_array($result)){
        echo '<option>'.$row[student_email].'</option>';
    }
    echo '</select> <input type=submit value="Select Student" name="submit_student_email"></form>';
   

}
function viewPracticalMarkBCA(){
    global $con;
    $sql=" SELECT * FROM `BCA` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>RollNO</th>
    <th>student Name</th>
    <th>C Model</th>
    <th>C Univ</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['c_lab'] . "</td>";
    echo "<td>" . $row['c_lab_univ'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `BCA` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>RollNo</th>
    <th>Student Name</th>
    <th>Computer Graphics Model</th>
    <th>Computer Graphics Univ</th>
    </tr>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['computer_graphics_lab'] . "</td>";
    echo "<td>" . $row['computer_graphics_lab_univ'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `BCA` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>RollNo</th>
    <th>Student Name</th>
    <th>java Lab Model</th>
    <th>Java lab Univ</th>
    <th>Accounts Model</th>
    <th>Accounts Univ</th>
    </tr>";


    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['java_lab'] . "</td>";
    echo "<td>" . $row['java_lab_univ'] . "</td>";
    echo "<td>" . $row['accounts_lab'] . "</td>";
    echo "<td>" . $row['accounts_lab_univ'] . "</td>";
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `BCA` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>RollNo</th>
    <th>Student Name</th>
    <th>Asp Model</th>
    <th>Asp Univ</th>
    </tr>";


    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['asp_lab'] . "</td>";
    echo "<td>" . $row['asp_lab_univ'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `BCA` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>RollNo</th>
    <th>Student Name</th>
    <th>Mysql Model</th>
    <th>Mysql Univ</th>
    </tr>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['mysql_lab'] . "</td>";
    echo "<td>" . $row['mysql_lab_univ'] . "</td>";
    
    echo "</tr><br><br>";
    }
    echo "</table>";

    $sql=" SELECT * FROM `BCA` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>RollNo</th>
    <th>Student Name</th>
    <th>Php Model</th>
    <th>Php Univ</th>
    </tr><br><br>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['php_lab'] . "</td>";
    echo "<td>" . $row['php_lab_univ'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

}

function viewPracticalMarkCS(){

    global $con;
    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM ONE MODEL</th>
    <th>SEM ONE UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_1_mod'] . "</td>";
    echo "<td>" . $row['sem_1_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM TWO MODEL</th>
    <th>SEM TWO UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_2_mod'] . "</td>";
    echo "<td>" . $row['sem_2_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM THREE MODEL</th>
    <th>SEM THREE UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_3_mod'] . "</td>";
    echo "<td>" . $row['sem_3_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM FOUR MODEL</th>
    <th>SEM FOUR UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_4_mod'] . "</td>";
    echo "<td>" . $row['sem_4_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM FIVE MODEL</th>
    <th>SEM FIVE UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_5_mod'] . "</td>";
    echo "<td>" . $row['sem_5_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM SIX MODEL</th>
    <th>SEM SIX UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_6_mod'] . "</td>";
    echo "<td>" . $row['sem_6_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";


    
}

function viewPracticalMarkMSC(){
    global $con;
    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM ONE MODEL</th>
    <th>SEM ONE UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_1_mod'] . "</td>";
    echo "<td>" . $row['sem_1_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM TWO MODEL</th>
    <th>SEM TWO UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_2_mod'] . "</td>";
    echo "<td>" . $row['sem_2_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM THREE MODEL</th>
    <th>SEM THREE UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_3_mod'] . "</td>";
    echo "<td>" . $row['sem_3_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";

    $sql=" SELECT * FROM `CS` WHERE student_email='".$_SESSION['student_email']."'";
    $result=mysqli_query($con,$sql);

    echo "<table border='1'>
    <tr>
    <th>ROLLNO</th>
    <th>STUDENT NAME</th>
    <th>SEM FOUR MODEL</th>
    <th>SEM FOUR UNIV</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['student_email'] . "</td>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['sem_4_mod'] . "</td>";
    echo "<td>" . $row['sem_4_prac'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table><br><br>";
}

function changeStudentSem(){
    global $con;
    $sql ="UPDATE student set student_class=REPLACE(student_class,'".$_SESSION['student_from']."','".$_SESSION['student_to']."')";
    $result =mysqli_query($con,$sql);
}

function viewLoginRegister(){
    global $con;

    // $from = 1;
    // $to=3;

    $sql="SELECT * FROM `register` WHERE student_class='".$_SESSION['student_course_VLR']."'AND signout_time>('".$_SESSION['date']."') AND signout_time<('".$_SESSION['added_date']."')  " ;
    $result=mysqli_query($con,$sql);
    
    echo'<br><table border=1>
        <tr>
        <th>Student Name</th>
        <th>Student Class</th>
        <th>Sysno</th>
        <th>SignIN Time</th>
        <th>SignOut Time</th>
        <th>Total time</th>
        <tr>    
    ';

    while($row=mysqli_fetch_array($result)){
        echo'<tr><td>'.$row['stud_name'].'</td>';
        echo'<td>'.$row['student_class'].'</td>';
        echo'<td>'.$row['sysno'].'</td>';
        echo'<td>'.$row['signin_time'].'</td>';
        echo'<td>'.$row['signout_time'].'</td>';
        echo'<td>'.$row['total_time'].'</td></tr>';
    }
    echo '</table>';
}




?>