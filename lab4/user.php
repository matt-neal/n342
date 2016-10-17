<!--
Matthew Neal
CSCI N-342
Completed 10-16-16
user.php

PLEASE READ THIS FILE and LOGIN.PHP and labThree.php
-->

<?php session_start();
    if (isset($_SESSION['email'])){
        $sql = "select * from REGISTRATION where username = '".$_SESSION['email']."'";}
    else {
        Header ("Location:login.php");}
?>

<!DOCTYPE HTML>

<!--
	Visualize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<html>

<?php
include "./head.php";
?>

<body>

<?php
$msg = "";
$fName = "";
$lName = "";
$eMail = "";
$pNumber = "";
$userArray = "";
$firstName = "";
$lastName = "";
$email = "";
$phone = "";
$userDetails = "";


if (isset($_POST['enter'])) {
    //ensure no white space
    $fName = trim($_POST['firstName']);
    $lName = trim($_POST['lastName']);
    $eMail = trim($_POST['email']);
    $pNumber = trim($_POST['phone']);


    //post an array to the log in page
    $userArray = array($fName,$lName,$eMail,$pNumber);
    $_SESSION['userDetails'] = $userArray;
    $msg = $_SESSION['userDetails'];
    print_r($msg);
}
?>

<!-- Wrapper -->
<div id="wrapper">

    <form action="user.php" method="post">

        <h1>Change Password</h1>
        <h3>All Fields Required</h3>

        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" required>

        <label for="password">Password: Must contain 10-18 characters, with at least 1 letter and 1 number.</label>
        <input type="password" id="password" name="password" required>

        <label for="newPassword">Password: Must contain 10-18 characters, with at least 1 letter and 1 number.</label>
        <input type="password" id="newPassword" name="newPassword" required>

        <button name="enter" class="btn" type="submit">Change Password</button>
    </form>

    <button name="end" class="btn" type="submit">Log Out</button>

    <!-- Footer -->
    <?php
    include "./footer.php"
    ?>

</div>

<!-- Scripts -->
<script src="../assets/js/jquery.min.js"></script>
<!--<script src="assets/js/main.js"></script> -->

</body>
</html>