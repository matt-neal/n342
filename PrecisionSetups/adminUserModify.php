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

$msg = "";
$eMail = "";
$pWord = "";
$homePhone = "";
$cellPhone = "";
$currentEmail = "";


if (isset($_POST['enter'])) {
    $currentEmail = trim($_POST['userEmail']);
    $eMail = trim($_POST['email']);
    $pWord = trim($_POST['password']);
    $homePhone = trim($_POST['homePhone']);
    $cellPhone = trim($_POST['cellPhone']);
    $email = mysqli_real_escape_string($con, $eMail);
    $pWord = mysqli_real_escape_string($con, $pWord);
    $homePhone = mysqli_real_escape_string($con, $homePhone);
    $cellPhone = mysqli_real_escape_string($con, $cellPhone);

    if ($eMail != "") {
        $sql = "UPDATE Customer_FP " . "SET Email= '".$eMail."' " . "WHERE Email = '" . $currentEmail . "'";
        $currentEmail = $eMail;
        //a non-select statement query will return a result indicating if the query is successful
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }

    if ($pWord != "") {
        $sql = "UPDATE Customer_FP " . "SET Password= '".$pWord."' " . "WHERE Email = '" . $currentEmail . "'";
        //a non-select statement query will return a result indicating if the query is successful
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }

    if ($homePhone != "") {
        $sql = "UPDATE Customer_FP " . "SET HomePhone= '".$homePhone."' " . "WHERE Email = '" . $currentEmail . "'";
        //a non-select statement query will return a result indicating if the query is successful
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }

    if ($cellPhone != "") {
        $sql = "UPDATE Customer_FP " . "SET CellPhone= '".$cellPhone."' " . "WHERE Email = '" . $currentEmail . "'";
        //a non-select statement query will return a result indicating if the query is successful
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }

}
?>
<body>

<!-- Wrapper -->
<div id="wrapper" class="adminUserModify">

    <form class="adminUserModify" action="adminUserModify.php" method="post">

        <?php print $msg; ?>

        <p class="label" for="userEmail">Select User: </p>
        <?php
        $sql = "SELECT Email FROM Customer_FP AS customers";

        //send the query to the database or quit if cannot connect
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo "<select name='userEmail'>";
        while($row = mysqli_fetch_row($result)){
            echo "<option value='{$row[0]}'>$row[0]</option>";
        }
        echo "</select>";
        ?>

        <p class="label" for="email">Email:</p>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>">

        <p class="label" for="password">Change Password:</p>
        <input type="password" id="password" name="password" value="<?php print $pWord; ?>" >

        <p class="label" for="homePhone">Change Home Phone: (Format: 555-555-5555)</p>
        <input type="text" id="homePhone" placeholder="Please Enter Home Phone #" name="homePhone" value="<?php print $homePhone; ?>" >

        <p class="label" for="cellPhone">Change Cell Phone: (Format: 555-555-5555)</p>
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