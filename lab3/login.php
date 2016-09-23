<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
login.php

PLEASE READ BOTH THIS FILE and labThree.PHP and ADMIN.PHP
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

$max = 3;
$attempts = "";
$msg = "";
$userPWord = "";
$pWord = "";
$userEmail = "";
$eMail = "";
$counter = 0;
$disabled = "";
$userArray = array();

$userArray = $_SESSION['userDetails'];
$userEmail = $userArray[0];
$userPWord = $userArray[1];


if (isset($_POST['enter'])) {
    //ensure no white space
    $eMail = trim($_POST['email']);
    $pWord = trim($_POST['password']);
    if ($counter < $max) {
        if ($userPWord != $pWord) {
            $attempts = ($max - $counter);
            $msg = "Incorrect Password. $attempts attempts remaining.";
            $counter++;
        } elseif ($userEmail != $eMail) {
            $attempts = ($max - $counter);
            $msg = "Incorrect Email. $attempts attempts remaining.";
            $counter++;
        } else {
            //direct to another file to process using query strings
            header("Location:admin.php");
        }
    }
    else {
        $disabled = "disabled";
        $msg = "Max Attempts Used. Please Try Again Later.";
    }
}
?>


<!-- Wrapper -->
<div id="wrapper">

    <form action="login.php" method="post">

        <h1>Log In</h1>

        <?php print $msg; ?>

        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" <?php echo $disabled; ?>>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" <?php echo $disabled; ?>>

        <button name="enter" class="btn" type="submit">Log In</button>
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