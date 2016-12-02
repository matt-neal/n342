<!--
Matthew Neal
CSCI N-342
Completed 12-1-16
confirmation.php
-->

<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
?>

<!DOCTYPE HTML>

<html>

<?php
require_once "./dbconnect.php";
include "./head.php";
include "./header.php";
?>
<body>
<div id="main-wrapper">


    <?php
    $eMail = "";
    $authCode = "";
    $eMail = $_GET['email'];
    $authCode = $_GET['code'];
    $sql = "UPDATE Customer_FP ". "SET authVer= '1' ". "WHERE Email = '".$eMail."' AND authCode = '".$authCode."'";
    //a non-select statement query will return a result indicating if the query is successful
    $result= mysqli_query($con, $sql) or die(mysqli_error($con));
    ?>

    <p style="text-align: center;">Thank you for registering! Click <a style="color: lightblue" href="http://corsair.cs.iupui.edu:20181/PrecisionSetups/login.php">here</a> to log in!</p>

    <?php
    include "./footer.php"
    ?>
</div>
<?php
include "./scripts.php"
?>
</body>
</html>