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
<!DOCTYPE html>
<html lang="en">
<?php
include "./head.php"
?>
<body>
<div id="main-wrapper" class="userLanding">
    <?php
    include "./header.php";

        if (isset($_POST['submit'])) {
            Header ("Loction:userProfile.php");
        }

        elseif (isset($_POST['instruments'])) {
            Header ("Location:userInstrument.php");
        }

        elseif (isset($_POST['orders'])) {
            Header ("Location:userWorkOrder.php");
        }

        elseif (isset($_POST['profile'])) {
            Header ("Location:userProfile.php");
        }

    ?>
    <!-- Wrapper -->
    <div id="userPage">
        <form class="userLanding" action="userLanding.php" method="post">
            <button name="profile" class="btn" type="submit">Modify Profile</button>
            <button name="instruments" class="btn" type="submit">Manage Instruments</button>
            <button name="orders" class="btn" type="submit">Create Work Order</button>
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