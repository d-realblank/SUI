<?php

if (isset($_POST["submit"])) {
    $fname = $_POST['fname'];
    $lname=$_POST['lname'];
    $addres=$_POST['addres'];
	$aprt=$_POST['aprt'];
    $ct=$_POST['ct'];
    $cntry=$_POST['cntry'];
    $pcode=$_POST['pcode'];
    $province=$_POST['province'];
    $PHONE=$_POST['PHONE'];
    $MOBILE=$_POST['MOBILE'];
    $EMAIL=$_POST['EMAIL'];
    $pass=$_POST['pass'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($fname, $lname, $addres, $aprt, $ct, $cntry, $pcode, $province, $PHONE, $MOBILE, $EMAIL, $pass) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($EMAIL) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (emailExists($conn, $EMAIL) !== false) {
        header("location: ../signup.php?error=emailexists");
        exit();
    }

    createUser($conn, $fname, $lname, $addres, $aprt, $ct, $cntry, $pcode, $province, $PHONE, $MOBILE, $EMAIL, $pass);

}
else {
    header("location: ../signup.php");
}

?>