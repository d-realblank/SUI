<?php

use function PHPSTORM_META\type;

include_once 'dbh.inc.php';
include_once 'functions.inc.php';

$name = '';
$email = '';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['type'];

    if (empty($type)||empty($email)||empty($name)) {
        header("location: ../user_list.php?error=emptyinput");
    }

    $conn->query("INSERT INTO users (usersFName, usersEmail, userType) VALUES('$name', '$email', '$type')");

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: ../user_list.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE usersId=$id");

    $_SESSION['message'] = "User has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: ../user_list.php");
}

if (isset($_GET['edit'])) {
    if (isset($_POST['submit'])) {
        $id = $_GET['edit'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $add = $_POST['add'];
        $app = $_POST['app'];
        $ct = $_POST['ct'];
        $cntry = $_POST['cntry'];
        $pcode = $_POST['pcode'];
        $province = $_POST['province'];
        $phone = $_POST['phone'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $type = $_POST['type'];

        if (invalidEmail($email) !== false) {
            header("location: ../user_list.php?error=invalidemail");
            exit();
        }
    
        $sql = "UPDATE `users` SET usersFName= '$fname', usersLName= '$lname', usersAdd= '$add', usersApp= '$app', usersCT= '$ct', usersCntry= '$cntry', usersPcode= '$pcode', usersProv= '$province', usersPhone= '$phone', usersMob= '$mobile', usersEmail= '$email', userType= '$type' WHERE usersId=$id;";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("location: ../user_list.php?error=none");
        }
    }
}