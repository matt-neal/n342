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
    $sql = "SELECT * FROM Customer_FP WHERE Email = '" . $_SESSION['email'] . "' AND isAdmin = '0'" ;
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

$currentEmail = "";
$instrumentBrand = "";
$instrumentModel = "";
$capID = "";
$nutID = "";
$switchID = "";
$potID = "";
$customerID = "";
$SQL = "";
$result = "";
$sql = "";
$msg = "";

$currentEmail = $_SESSION['email'];

if (isset($_POST['enter'])) {
    $instrumentBrand = trim($_POST['brand']);
    $instrumentModel = trim($_POST['model']);

    $SQL = "SELECT CustomerID FROM Customer_FP WHERE Email='".$currentEmail."'";
    $result = mysqli_query($con, $SQL) or die(mysqli_error($con));
    $customerID = mysqli_fetch_row($result);

    $SQL = "SELECT CapID FROM Instrument_FP WHERE Brand='".$instrumentBrand."' AND Model='".$instrumentModel."' AND CustomerID='1'";
    $result = mysqli_query($con, $SQL) or die(mysqli_error($con));
    $capID = mysqli_fetch_row($result);

    $SQL = "SELECT NutID FROM Instrument_FP WHERE Brand='".$instrumentBrand."' AND Model='".$instrumentModel."' AND CustomerID='1'";
    $result = mysqli_query($con, $SQL) or die(mysqli_error($con));
    $nutID = mysqli_fetch_row($result);

    $SQL = "SELECT SwitchID FROM Instrument_FP WHERE Brand='".$instrumentBrand."' AND Model='".$instrumentModel."' AND CustomerID='1'";
    $result = mysqli_query($con, $SQL) or die(mysqli_error($con));
    $switchID = mysqli_fetch_row($result);

    $SQL = "SELECT PotID FROM Instrument_FP WHERE Brand='".$instrumentBrand."' AND Model='".$instrumentModel."' AND CustomerID='1'";
    $result = mysqli_query($con, $SQL) or die(mysqli_error($con));
    $potID = mysqli_fetch_row($result);

    $sql = "INSERT INTO Instrument_FP values(null, '".$customerID[0]."','".$instrumentBrand."','".$instrumentModel."','".$capID[0]."','".$nutID[0]."','".$switchID[0]."','".$potID[0]."')";
    //a non-select statement query will return a result indicating if the query is successful
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $msg = "Update Successful";
}

elseif (isset($_POST['back'])) {
    Header ("Location:userLanding.php");
}
?>

<body>
<?php print $msg; ?>
<div id="main-wrapper" class="userInstrument">
<!-- Wrapper -->
<div id="wrapper" class="userInstrument">


    <form class="userInstrument" action="userInstrument.php" method="post">



        <p class="label" for="brand">Select Brand: </p>
        <?php
        $sql = "SELECT DISTINCT Instrument_FP.Brand FROM Instrument_FP";

        //send the query to the database or quit if cannot connect
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo "<select style='color: whitesmoke;' name='brand'>";
        while($row = mysqli_fetch_row($result)){
            echo "<option value='{$row[0]}'>$row[0]</option>";
        }
        echo "</select>";
        ?>

        <p class="label" for="model">Select Model: </p>
        <?php
        $sql = "SELECT DISTINCT Model FROM Instrument_FP";

        //send the query to the database or quit if cannot connect
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo "<select style='color: whitesmoke;' name='model'>";
        while($row = mysqli_fetch_row($result)){
            echo "<option value='{$row[0]}'>$row[0]</option>";
        }
        echo "</select>";
        ?>

        <button name="enter" class="btn" type="submit">Create My Instrument</button>

        <button name="back" class="btn" type="submit">Back</button>
    </form>

</div>
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