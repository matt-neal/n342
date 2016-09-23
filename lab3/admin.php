<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
admin.php

PLEASE READ THIS FILE and LOGIN.PHP and labThree.php
-->

<?php
if(!isset( $_SESSION)) {
    session_start();
}
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


if (isset($_POST['enter'])) {
    //ensure no white space
    $fName = trim($_POST['firstName']);
    $lName = trim($_POST['lastName']);
    $eMail = trim($_POST['email']);
    $pNumber = trim($_POST['phone']);


    //post an array to the log in page
    $userArray = array($eMail);
    $userSessionArray = $_SESSION['userDetails'] = $userArray;

}
?>

<!-- Wrapper -->
<div id="wrapper">

    <form action="admin.php" method="post">

        <h1>Please Enter User Information</h1>
        <h3>All Fields Required</h3>
        <?php print $msg; ?>

        <label for="firstName">First Name: </label>
        <input type="text" id="firstName" placeholder="Bobby" name="firstName" value="<?php print $fName; ?>" required>

        <label for="lastName">Last Name: </label>
        <input type="text" id="lastName" placeholder="Tables" name="lastName" value="<?php print $lName; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>" required>

        <label for="phone">Phone Number (Format as: (###)###-####):</label>
        <input type="text" id="phoneNumber" placeholder="(317)555-5555" name="phoneNumber" value="<?php print $pNumber; ?>" required>

        <button name="enter" class="btn" type="submit">Add User</button>
        <button name="end" class="btn" type="submit">All Users Entered</button>
    </form>

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