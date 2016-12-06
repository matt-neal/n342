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
    require_once "./hash.php";
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
$pWordConfirm = "";
$homePhone = "";
$cellPhone = "";
$currentEmail = "";
$currentPassword = "";


if (isset($_POST['enter'])) {
    $currentEmail = $_SESSION['email'];
    $pWord = trim($_POST['password']);
    $homePhone = trim($_POST['homePhone']);
    $cellPhone = trim($_POST['cellPhone']);
    $pWordConfirm = trim($_POST['passwordConfirm']);
    $currentPassword = trim($_POST['currentPassword']);
    $pWord = mysqli_real_escape_string($con, $pWord);
    $homePhone = mysqli_real_escape_string($con, $homePhone);
    $cellPhone = mysqli_real_escape_string($con, $cellPhone);

    if ($pWord != "" and $pWord == $pWordConfirm) {
        encrypt($currentEmail, $pWord);
        $msg = "Update Successful";
    }

    if ($homePhone != "") {
        $sql = "UPDATE Customer_FP " . "SET HomePhone= '".$homePhone."' " . "WHERE Email = '" . $currentEmail . "' AND Password = '" . $currentPassword . "'";
        //a non-select statement query will return a result indicating if the query is successful
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $msg = "Update Successful";
    }

    if ($cellPhone != "") {
        $sql = "UPDATE Customer_FP " . "SET CellPhone= '".$cellPhone."' " . "WHERE Email = '" . $currentEmail . "' AND Password = '" . $currentPassword . "'";
        //a non-select statement query will return a result indicating if the query is successful
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $msg = "Update Successful";
    }
}
?>

<body>

<!-- Wrapper -->
<div id="wrapper" class="userProfile">

    <form class="userProfile" action="userProfile.php" method="post">

        <?php print $msg; ?>

        <p class="label" for="password">Change Password:</p>
        <input type="password" id="password" name="password">

        <p class="label" for="password">Confirm New Password:</p>
        <input type="password" id="passwordConfirm" placeholder="Please Confirm Password" name="passwordConfirm">

        <p class="label" for="homePhone">Change Home Phone: (Format: 555-555-5555)</p>
        <input type="text" id="homePhone" placeholder="Please Enter Home Phone #" name="homePhone">

        <p class="label" for="cellPhone">Change Cell Phone: (Format: 555-555-5555)</p>
        <input type="text" id="cellPhone" placeholder="Please Enter Cell Phone #" name="cellPhone">

        <p class="label" for="currentPassword">Enter Password to Change:</p>
        <input type="password" id="currentPassword" name="currentPassword" required>

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