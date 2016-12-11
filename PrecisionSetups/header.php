<head>
<style>
    #banner {
        position: absolute;
        top: 1em;
        left: 0px;
        right: 0px;
        width: 100%;
    }
</style>
<img id="banner" src="./app/content/header.jpg" alt="Banner Image"/>
</head>



<?php
if (isset($_SESSION['email'])){ ?>
<nav class="row">
    <div class="nav">
        <a href = "./index.php" > Home</a>
        <a href = "javascript:void(0);" > About</a>
        <a href = "javascript:void(0);" > Services</a>
        <a href = "javascript:void(0);" > Contact</a>
        <a href = "./logout.php" > Log Out </a>
    </div>
</nav>
<?php
}

else { ?>
<nav class="row">
    <div class="nav">
        <a href = "./index.php" > Home</a>
        <a href = "javascript:void(0);" > About</a>
        <a href = "javascript:void(0);" > Services</a>
        <a href = "javascript:void(0);" > Contact</a>
        <a href = "./login.php" > Log In </a>
    </div>
</nav>
<?php }
?>
