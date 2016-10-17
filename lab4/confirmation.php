<!--
Matthew Neal
CSCI N-342
Completed 10-16-16
confirmation.php
-->

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

<form>

    <?php
        $hereDoc = "";

        $fName = "";
        $lName = "";
        $eMail = "";
        $userGender = "";
        $userDept = "";
        $userStatus = "";
        $pWord = "";
        $msg = "";
        $fName = $_GET['fN'];
        $lName = $_GET['lN'];
        $eMail = $_GET['eM'];
        $pWord = $_GET['pW'];
        $userGender = $_GET['uG'];
        $userDept = $_GET['uD'];
        $userStatus = $_GET['uS'];
        $msg = $_GET['mG'];
        
    //retrieve all the information from the user from the database
    //always check if the session variable exists before using it for the first time on this page.
    if (isset($_SESSION['email']))
        $sql = "select * from REGISTRATION where username = '".$_SESSION['email']."'";
    else Header ("Location:logout.php") ;

    $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
    $fields = mysql_fetch_assoc($result);
?>
</form>

</html>
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