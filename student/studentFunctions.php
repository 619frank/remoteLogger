<?php
function validateStudent(){
    global $student_email;
    global $student_password;
    if(isset($student_email)&&isset($student_password)){
        global $con;
        $sql = 'SELECT student_email, student_password FROM student where student_email="' . $student_email . '" AND student_password="' . $student_password . '"';
        $result = mysqli_query($con, $sql);
    
        while ($final = mysqli_fetch_assoc($result)) {
            $_SESSION['student_email'] = $final['student_email'];
            $selected_student_password = $final['student_password'];
        }
    
        if ($student_email == $_SESSION['student_email'] && $student_password == $selected_student_password) {
            echo 'you have logged in successfully';
        } else {
            echo 'couldn\'t login you';
        }
    }else{
        echo 'Please Enter username and Password';
    }
    
}


function getStudentId(){
    global $con;
    $sql = 'select student_id from student where student_email="'.$_SESSION["student_email"].'"';
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result)){
        $_SESSION['student_id']=$row['student_id'];
        
    }
    return $_SESSION['student_id'];
}
function studentLoggedIn(){
    if(isset($_SESSION['student_id'])){
    return true;
    }else{
        return false;
    }
}
function selectStudentNameAndSysnoAndClass(){
    global $con;
    $sql="SELECT student_name,system_number,student_class FROM `student` WHERE student_id=".$_SESSION['student_id'];
    $result=mysqli_query($con,$sql);

    while($row=mysqli_fetch_array($result)){
         $_SESSION['student_name']=$row['student_name'];
         $_SESSION['student_class']=$row['student_class'];
         $_SESSION['system_number']=$row['system_number'];
         
    }
     
}

function startEntry(){
    
    global $con;
    $sql ="INSERT INTO `register` (`sno`, `stud_id`, `stud_name`, `student_class`,`sysno`, `signin_time`, `signout_time`, `total_time`) VALUES (NULL, '".$_SESSION['student_id']."', '".$_SESSION['student_name']."', '".$_SESSION['student_class']."','".$_SESSION['system_number']."', CURRENT_TIMESTAMP, NULL, ' ')";
    $result=mysqli_query($con,$sql);
}

function selectLastEntrySno(){

    global $con;
    $sql="SELECT MAX(sno) as sno FROM `register` WHERE stud_id=".$_SESSION['student_id']." LIMIT 1";
    $result=mysqli_query($con,$sql);

    while($row=mysqli_fetch_array($result)){
        $_SESSION['register_sno']=$row['sno'];
    }
}

function updateExitEntry(){
    global $con;
    $sql="UPDATE `register` SET signout_time=CURRENT_TIMESTAMP WHERE sno=".$_SESSION['register_sno'];
    $result=mysqli_query($con,$sql);
}
function updatAvgTime(){
    global $con;
    $sql="SELECT TIME_TO_SEC(TIMEDIFF(signout_time,signin_time)) AS total_time FROM register WHERE sno=".$_SESSION['register_sno'];
    $result=mysqli_query($con,$sql);
    
    while($row=mysqli_fetch_array($result)){
        $total_time=$row['total_time'];
    }
    $sql1="UPDATE `register` SET total_time=$total_time WHERE sno=".$_SESSION['register_sno'];
    $result1=mysqli_query($con,$sql1);

    echo 'You have LoggedIn for '.($total_time/60).' minutes';
}

function totalLoginTime(){
    global $con;
    $sql ="SELECT SUM(total_time) as total_time FROM `register` WHERE stud_id=".$_SESSION['student_id'];
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result)){
        $entire_sum=$row['total_time'];
    }
    echo 'Your Total Login time is '. ($entire_sum/60).' Minutes';
}

function viewLoginRegister(){
    global $con;
    $sql="SELECT stud_name,sysno,signin_time,signout_time,total_time from register where stud_id=".$_SESSION['student_id'];
    $result=mysqli_query($con,$sql);
    
    echo '<br>
            <table border=1>
            <tr>
            <th>Student Name</th>
            <th>System Number</th>
            <th>SignIn Time</th>
            <th>SighOut Time</th>
            <th>Total Time</th>
            </tr>
            <tr>
          ';

    while($row=mysqli_fetch_array($result)){
        echo '<tr>';
        echo '<td>'.$row['stud_name'].'</td>';
        echo '<td>'.$row['sysno'].'</td>';
        echo '<td>'.$row['signin_time'].'</td>';
        echo '<td>'.$row['signout_time'].'</td>';
        echo '<td>'.$row['total_time'].'</td>';
        echo '</tr>';
    }
    echo'</table>';
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

?>



