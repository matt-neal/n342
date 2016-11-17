<!DOCTYPE html>
<html lang="en">
<?php
include "./head.php"
?>
<body>
<div id="main-wrapper">
    <?php
    include "./header.php"
    ?>
    <!-- Wrapper -->
    <div id="adminPage">
        <form>
            <button name="profile" class="btn" type="submit">Modify Users</button>
            <button name="instruments" class="btn" type="submit">Manage Instruments</button>
            <button name="orders" class="btn" type="submit">Modify Work Order</button>
        </form>
    </div>
    <?php
    include "./footer.php"
    ?>
</div>
<?php
include "./scripts.php"
?>
</body>
</html>