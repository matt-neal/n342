<!--
Matthew Neal
CSCI N-342
Completed 9-9-16
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

    $hereDoc = <<<HERE
        
    <h1>User Registration Confirmation</h1>
    <h3>$msg</h3>
    <label>Name: $fName $lName</label> 
    <label>Email: $eMail</label> 
    <label>Password: $pWord</label>  
    <label>Gender: $userGender</label>  
    <label>Department Status: $userDept $userStatus</label>   
HERE;

    print $hereDoc;

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