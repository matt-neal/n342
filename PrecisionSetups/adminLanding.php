<?php session_start();
//if this is a page that requires login always perform this session verification
require_once "./sessionVerify.php";
require_once "./util.php";
require_once "./dbconnect.php";
$_SESSION['timeout'] = time();
if ($_SESSION['email'] != "") {
}
else {
    Header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "./head.php"
?>
<body>
<div id="main-wrapper" class="adminLanding">
    <?php
    include "./header.php";

    if (isset($_POST['enter'])) {
        Header ("Loction:adminUserModify.php");
    }

//    elseif (isset($_POST['instruments'])) {
//        Header ("Location:adminInstrument.php");
//    }
//
//    elseif (isset($_POST['orders'])) {
//        Header ("Location:adminWorkOrders.php");
//    }

    elseif (isset($_POST['profile'])) {
        Header("Location:adminUserModify.php");
    }

    ?>
    <!-- Wrapper -->
    <div id="adminPage">
        <form class="adminLanding" action="adminLanding.php" method="post">
            <button name="profile" class="btn" type="submit">Modify Users</button>
<!--            <button name="instruments" class="btn" type="submit">Manage Instruments</button>-->
<!--            <button name="orders" class="btn" type="submit">Modify Work Order</button>-->
        </form>
    </div>

</div>
<?php
include "./scripts.php"
?>
</body>
<?php
include "./footer.php"
?>
</html>