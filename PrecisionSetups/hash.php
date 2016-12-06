<?php
require_once "./dbconnect.php";

//ini_set("display_errors","1");
//ERROR_REPORTING(E_ALL);
$blowfish = CRYPT_BLOWFISH or die ('No Blowfish found.');

function encrypt($email, $password)
{
    $con = mysqli_connect("localhost","mattneal","mattneal","mattneal_db");

    //This string tells crypt to use blowfish for 5 rounds.
    $Blowfish_Pre = '$2a$05$';
    $Blowfish_End = '$';

// Blowfish accepts these characters for salts.
    $Allowed_Chars =
        'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
    $Chars_Len = 63;

    $Salt_Length = 18;

    $mysqli_date = date('Y-m-d');
    $salt = "";

    for ($i = 0; $i < $Salt_Length; $i++) {
        $salt .= $Allowed_Chars[mt_rand(0, $Chars_Len)];
    }

    $bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;

    $hashed_password = crypt($password, $bcrypt_salt);

    $sql = "UPDATE Customer_FP " . "SET Password= '" . $hashed_password . "'" . "WHERE Email = '" . $email . "'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $sql = "UPDATE Customer_FP " . "SET salt= '" . $salt . "'" . "WHERE Email = '" . $email . "'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
}

function verifyHash($email, $password) {
    //This string tells crypt to use blowfish for 5 rounds.
    $Blowfish_Pre = '$2a$05$';
    $Blowfish_End = '$';

    $con = mysqli_connect("localhost","mattneal","mattneal","mattneal_db");

    $sql = "SELECT salt, Password FROM Customer_FP WHERE Email='".$email."'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);

    $hashed_pass = crypt($password, $Blowfish_Pre . $row['salt'] . $Blowfish_End);

    if ($hashed_pass == $row['Password']) {
        return true;
    } else {
       echo 'There was a problem with your user name or password.';
    }

}
?>