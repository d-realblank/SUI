<?php

function emptyInputSignup($fname, $lname, $addres, $aprt, $ct, $cntry, $pcode, $province, $PHONE, $MOBILE, $EMAIL, $pass) {
    if (empty($fname)||empty($lname)||empty($addres)||empty($aprt)||empty($ct)||empty($cntry)||empty($pcode)||empty($province)&&(empty($PHONE)||empty($MOBILE))&&empty($EMAIL)||empty($pass)) {
        return true;
    }
    else{
        return false;
    }
}

function invalidEmail($EMAIL){
    $result = null;
    if (!filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emailExists($conn, $EMAIL){
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $EMAIL);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $fname, $lname, $addres, $aprt, $ct, $cntry, $pcode, $province, $PHONE, $MOBILE, $EMAIL, $pass){
    $sql = "INSERT INTO users (usersFName, usersLName, usersAdd, usersApp, usersCT, usersCntry, usersPcode, usersProv, usersPhone, usersMob, usersEmail, usersPass, userType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    $type = "user";

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssssssss", $fname, $lname, $addres, $aprt, $ct, $cntry, $pcode, $province, $PHONE, $MOBILE, $EMAIL, $hashedPwd, $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../myaccount.php?error=none");
}

function emptyInputLogin($EMAIL, $pass) {
    if (empty($EMAIL)||empty($pass)) {
        return true;
    }
    else{
        return false;
    }
}

function loginUser($conn, $email, $pwd) {
    $emailExists = emailExists($conn, $email);

    if ($emailExists === false) {
        header("location: ../myaccount.php?error=wronglogin");
        exit();
    }

    $hashedPwd = $emailExists["usersPass"];
    $checkPwd = password_verify($pwd, $hashedPwd);

    if ($checkPwd === false) {
        header("location: ../myaccount.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $emailExists["usersId"];
        $_SESSION["useremail"] = $emailExists["usersEmail"];
        $_SESSION["usertype"] = $emailExists["userType"];
        header("location: ../index.php");
        exit();
    }
}

?>