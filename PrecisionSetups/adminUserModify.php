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

    <form action="adminUserModify.php" method="post">

        <?php print $msg; ?>

        <label for="email">Email: <?php print $emailRequired; ?></label>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>">

        <label for="emailConfirm">Confirm Email:</label>
        <input type="email" id="emailConfirm" name="emailConfirm" placeholder="Please Confirm Email" value="<?php print $emailConfirmation; ?>">

        <label for="password">Change Password: <?php print $passwordRequired; ?></label>
        <input type="password" id="password" name="password" value="<?php print $pWord; ?>" >

        <label for="password">Confirm New Password:</label>
        <input type="password" id="passwordConfirm" placeholder="Please Confirm Password" name="passwordConfirm" value="<?php print $passwordConfirmation; ?>" >

        <label for="homePhone">Change Home Phone: (Format: 555-555-5555)</label>
        <input type="text" id="homePhone" placeholder="Please Enter Home Phone #" name="homePhone" value="<?php print $homePhone; ?>" >

        <label for="cellPhone">Change Cell Phone: (Format: 555-555-5555)</label>
        <input type="text" id="cellPhone" placeholder="Please Enter Cell Phone #" name="cellPhone" value="<?php print $cellPhone; ?>" >

        <button name="enter" class="btn" type="submit">Submit Changes</button>
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