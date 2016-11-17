<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
registration.php
-->

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
<div id="wrapper">

    <form action="registration.php" method="post">

        <?php print $msg; ?>

        <label for="firstName">First Name: <?php print $firstNameRequired; ?></label>
        <input type="text" id="firstName" placeholder="Bobby" name="firstName" value="<?php print $fName; ?>" required>

        <label for="lastName">Last Name: <?php print $lastNameRequired; ?></label>
        <input type="text" id="lastName" placeholder="Tables" name="lastName" value="<?php print $lName; ?>" required>

        <label for="email">Email: <?php print $emailRequired; ?></label>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>" required>

        <label for="emailConfirm">Confirm Email:</label>
        <input type="email" id="emailConfirm" name="emailConfirm" placeholder="Please Confirm Email" value="<?php print $emailConfirmation; ?>" required>

        <label for="password">Password: Must contain 10-18 characters, with at least 1 letter and 1 number. <?php print $passwordRequired; ?></label>
        <input type="password" id="password" name="password" value="<?php print $pWord; ?>" required>

        <label for="password">Confirm Password:</label>
        <input type="password" id="passwordConfirm" placeholder="Please Confirm Password" name="passwordConfirm" value="<?php print $passwordConfirmation; ?>" required>

        <label for="homePhone">Home Phone: (Format: 555-555-5555)</label>
        <input type="text" id="homePhone" placeholder="Please Enter Home Phone #" name="homePhone" value="<?php print $homePhone; ?>" required>

        <label for="cellPhone">Cell Phone: (Format: 555-555-5555)</label>
        <input type="text" id="cellPhone" placeholder="Please Enter Cell Phone #" name="cellPhone" value="<?php print $cellPhone; ?>" required>

        <label>Terms and Conditions: <?php print $termsReq; ?></label>
        <input type="checkbox" id="terms" value="terms" name="terms" required><label class="light" for="terms">I Agree to the Terms and Conditions:</label>

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