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
$pWord = "";
$passwordRequired = "*";
$passwordConfirmation = "";
$homePhone = "";
$cellPhone = "";
$emailRequired = "*";
$eMail = "";
$emailConfirmation = "";
?>

<body>

<!-- Wrapper -->
<div id="wrapper" class="adminInstrument">

    <form action="adminInstrument.php" method="post" class="adminInstrument">

        <p class="label" for="userEmail">Select User: </p>
        <?php
        $sql = "SELECT Email FROM Customer_FP AS customers";

        //send the query to the database or quit if cannot connect
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo "<select style='color: whitesmoke;' name='userEmail'>";
        while($row = mysqli_fetch_row($result)){
            echo "<option value='{$row[0]}'>$row[0]</option>";
        }
        echo "</select>";
        ?>

        <p class="label" for="brand">Select Brand: </p>
        <?php
        $SQL = "SELECT Instrument_FP.CustomerID FROM Instrument_FP JOIN Customer_FP ON Instrument_FP.CustomerID=Customer_FP.CustomerID WHERE Customer.Email=userEmail";
        $RESULT = mysqli_query($con, $sql) or die(mysqli_error($con));
        $sql = "SELECT Brand FROM Instrument_FP WHERE CustomerID = '".$RESULT."'";

        //send the query to the database or quit if cannot connect
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo "<select style='color: whitesmoke;' name='brand'>";
        while($row = mysqli_fetch_row($result)){
            echo "<option value='{$row[0]}'>$row[0]</option>";
        }
        echo "</select>";
        ?>

        <input type="text" id="brand" placeholder="Brand Modification" name="homePhone">

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