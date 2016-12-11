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

$currentEmail = "";
$instrumentWO = "";
$serviceWO = "";
$instrumentWo = "";
$customerID = "";
$SQL = "";
$result = "";
$sql = "";
$msg = "";

$currentEmail = $_SESSION['email'];

if (isset($_POST['enter'])) {
    $instrumentWO = trim($_POST['instrument']);
    $serviceWO = trim($_POST['service']);

    $SQL = "SELECT CustomerID FROM Customer_FP WHERE Email='".$currentEmail."'";
    $result = mysqli_query($con, $SQL) or die(mysqli_error($con));
    $customerID = mysqli_fetch_row($result);

    $sql = "INSERT INTO WorkOrder_FP values(null, '11', '".$customerID[0]."','".$instrumentWO."','".$serviceWO."')";
    //a non-select statement query will return a result indicating if the query is successful
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $msg = "Update Successful";
}
?>

<body>

<!-- Wrapper -->
<div id="wrapper" class="adminWorkOrder">

    <form class="adminWorkOrder" action="adminWorkOrders.php" method="post">

        <p class="label" for="instrument">Select Instrument: </p>
        <?php
        $sql = "SELECT Instrument_FP.Brand, Instrument_FP.Model FROM WorkOrder_FP JOIN (Instrument_FP) ON (Instrument_FP.InstrumentID=WorkOrder_FP.InstrumentID)";

        //send the query to the database or quit if cannot connect
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo "<select style='color: whitesmoke;' name='instrument'>";
        while($row = mysqli_fetch_row($result)){
            echo "<option value='{$row[0]}'>$row[0]</option>";
        }
        echo "</select>";
        ?>

        <input type="instrumentBox" id="instrumentBox" name="instrumentBox" value="instrument">

        <p class="label" for="service">Select Service: </p>
        <?php
        $sql = "SELECT Service_FP.ServiceDesc FROM WorkOrder_FP JOIN (Service_FP) ON (Service_FP.ServiceID=WorkOrder_FP.ServiceID)";

        //send the query to the database or quit if cannot connect
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        echo "<select style='color: whitesmoke;' name='service'>";
        while($row = mysqli_fetch_row($result)){
            echo "<option value='{$row[0]}'>$row[0]</option>";
        }
        echo "</select>";
        ?>

        <input type="serviceBox" id="serviceBox" name="serviceBox" value="service">

        <button name="enter" class="btn" type="submit">Create Work Order</button>
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