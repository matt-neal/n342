<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
registration.php
-->

<?php session_start();
//if this is a page that requires login always perform this session verification
require_once "./sessionVerify.php";
require_once "./util.php";

require_once "./dbconnect.php";
$_SESSION['timeout'] = time();
if (isset($_SESSION['email'])) {
    $sql = "SELECT * FROM Customer_FP WHERE Email = '" . $_SESSION['email'] . "' AND isAdmin = '1'" ;
}
else {
    Header("Location:login.php");
}
?>

<!DOCTYPE HTML>

<html>

<?php
require_once "./util.php";
require_once "./dbconnect.php";
include "./head.php";
include "./header.php";
?>

<body>

<!-- Wrapper -->
<div id="wrapper" class="adminWorkOrder">

    <form class="adminWorkOrder" action="registration.php" method="post">

        <?php print $msg; ?>

        <p class="label" for="firstName">First Name: <?php print $firstNameRequired; ?></p>
        <input type="text" id="firstName" placeholder="Bobby" name="firstName" value="<?php print $fName; ?>" required>

        <p class="label" for="lastName">Last Name: <?php print $lastNameRequired; ?></p>
        <input type="text" id="lastName" placeholder="Tables" name="lastName" value="<?php print $lName; ?>" required>

        <p class="label" for="email">Email: <?php print $emailRequired; ?></p>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>" required>

        <p class="label" for="emailConfirm">Confirm Email:</p>
        <input type="email" id="emailConfirm" name="emailConfirm" placeholder="Please Confirm Email" value="<?php print $emailConfirmation; ?>" required>

        <p class="label" for="password">Password: Must contain 10-18 characters, with at least 1 letter and 1 number. <?php print $passwordRequired; ?></p>
        <input type="password" id="password" name="password" value="<?php print $pWord; ?>" required>

        <p class="label" for="password">Confirm Password:</p>
        <input type="password" id="passwordConfirm" placeholder="Please Confirm Password" name="passwordConfirm" value="<?php print $passwordConfirmation; ?>" required>

        <p class="label" for="homePhone">Home Phone: (Format: 555-555-5555)</p>
        <input type="text" id="homePhone" placeholder="Please Enter Home Phone #" name="homePhone" value="<?php print $homePhone; ?>" required>

        <p class="label" for="cellPhone">Cell Phone: (Format: 555-555-5555)</p>
        <input type="text" id="cellPhone" placeholder="Please Enter Cell Phone #" name="cellPhone" value="<?php print $cellPhone; ?>" required>

        <p class="label">Terms and Conditions: <?php print $termsReq; ?></p>
        <input type="checkbox" id="terms" value="terms" name="terms" required><p class="label" class="light" for="terms">I Agree to the Terms and Conditions:</p>

        <button name="enter" class="btn" type="submit">Sign Up</button>
    </form>

</div>

<!-- Scripts -->
<script src="../assets/js/jquery.min.js"></script>
<!--<script src="assets/js/main.js"></script> -->

</body>
<!-- Footer -->
<?php
include "./footer.php"
?>
</html>