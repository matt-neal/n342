<!--
Matthew Neal
CSCI N-342
Completed 10-16-16
user.php

PLEASE READ THIS FILE and LOGIN.PHP and labThree.php
-->

<?php session_start();
$_SESSION['timeout'] = time();
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
$fN = "";
$lN = "";
$fN = "select FirstName from userInfo where email = '".$_SESSION['email']."'";
$lN = "select LastName from userInfo where email = '".$_SESSION['email']."'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if (isset($_POST['cP'])){
    Header ("location:changePassword.php");
}

if (isset($_POST['end'])){
    session_destroy();
    Header ("location:login.php");
}
?>

<!-- Wrapper -->
<div id="wrapper">
    <h1>Greetings <?php print $fN. $lN?></h1>

    <button name="cP" class="btn" type="submit">Change Password</button>

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