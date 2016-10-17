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
        $code = "";

    if (isset($_GET['code'])) {
        $sql = "insert into USER values(null, null, null, '1')";
    }
    else Header ("Location:registration.php") ;

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