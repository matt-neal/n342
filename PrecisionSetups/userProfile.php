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
        $sql = "SELECT * FROM Customer_FP WHERE Email = '" . $_SESSION['email'] . "' AND isAdmin = '0'" ;
    }
    else {
        Header("Location:login.php");
    }
?>

<!DOCTYPE HTML>

<html>

<?php
include "./head.php";
include "./header.php";

$msg = "";
$pWord = "";
$passwordRequired = "*";
$passwordConfirmation = "";
$homePhone = "";
$cellPhone = "";
$eMail = "";
$authCode = "";
$eMail = $_GET['email'];
$authCode = $_GET['code'];
$sql = "UPDATE Customer_FP ". "SET authVer= '1' ". "WHERE Email = '".$eMail."' AND authCode = '".$authCode."'";
//a non-select statement query will return a result indicating if the query is successful
$result= mysqli_query($con, $sql) or die(mysqli_error($con));

?>

<body>

<!-- Wrapper -->
<div id="wrapper" class="userProfile">

    <form class="userProfile" action="userProfile.php" method="post">

        <?php print $msg; ?>

        <p class="label" for="password">Change Password: <?php print $passwordRequired; ?></p>
        <input type="password" id="password" name="password" value="<?php print $pWord; ?>" >

        <p class="label" for="password">Confirm New Password:</p>
        <input type="password" id="passwordConfirm" placeholder="Please Confirm Password" name="passwordConfirm" value="<?php print $passwordConfirmation; ?>" >

        <p class="label" for="homePhone">Change Home Phone: (Format: 555-555-5555)</p>
        <input type="text" id="homePhone" placeholder="Please Enter Home Phone #" name="homePhone" value="<?php print $homePhone; ?>" >

        <p class="label" for="cellPhone">Change Cell Phone: (Format: 555-555-5555)</p>
        <input type="text" id="cellPhone" placeholder="Please Enter Cell Phone #" name="cellPhone" value="<?php print $cellPhone; ?>" >

        <p class="label" for="password">Enter Password to Change: <?php print $passwordRequired; ?></p>
        <input type="password" id="password" name="password" value="<?php print $pWord; ?>" required>

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