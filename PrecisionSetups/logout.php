<!--
Matthew Neal
CSCI N-342
Completed 12-1-16
confirmation.php
-->

<?php session_destroy(); //this must be the very first line on the php page, to register this page to use session variables
?>

<!DOCTYPE HTML>

<html>

<?php
require_once "./dbconnect.php";
include "./head.php";
include "./header.php";
?>
<body>
<div id="main-wrapper" class="confirmation">

    <p style="text-align: center; margin-top: 17em; font-weight: bold;">Thank you for Visiting!</p>

</div>
<?php
include "./scripts.php"
?>
</body>
<?php
include "./footer.php"
?>
</html>