<?php  session_start(); //this must be the very first line on the php page, to register this page to use session variables
session_destroy();
$_SESSION['timeout'] = time();
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

<title>Logout</title>
    <style type = "text/css">
        h1, h2, a {
            text-align: center;
        }
    </style>

<body>

<h1>Logout</h1>
<h1>Thank you for visiting!</h1>
<a href="login.php">Return to Home</a>

</body>
</html>