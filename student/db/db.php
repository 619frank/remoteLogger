<?php
$con = mysqli_connect('localhost','root','frank','remoteLogger');

if(!$con){
    echo'con failure';
}