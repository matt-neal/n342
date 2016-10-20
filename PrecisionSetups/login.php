<!--
Matthew Neal
CSCI N-342
Completed 10-16-16
login.php
-->
<!---->
<?php //session_start();
//    //if this is a page that requires login always perform this session verification
//    require_once "../inc/sessionVerify.php";
//
//    require_once "../inc/dbconnect.php";
//    $_SESSION['timeout'] = time();
//    if (isset($_SESSION['email'])) {
//        $sql = "select * from REGISTRATION where username = '" . $_SESSION['email'] . "'";
//    }
//    else {
//        Header("Location:login.php");
//    }
//?>

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

    <?php

    $max = 3;
    $attempts = "";
    $msg = "";
    $userPWord = "";
    $pWord = "";
    $userEmail = "";
    $eMail = "";
    $counter = 0;
    $disabled = "";

    if (isset($_POST['enter'])) {

        //ensure no white space
        $eMail = trim($_POST['email']);
        $pWord = trim($_POST['password']);
        $email = mysqli_real_escape_string($con, $eMail);
        $pWord = mysqli_real_escape_string($con, $pWord);

        if ($counter < $max && (spamcheck($eMail)))
        {
            if ($userPWord != $pWord) {
                $attempts = ($max - $counter);
                $msg = "Incorrect Password. $attempts attempts remaining.";
                $_SESSION['counter'] = $counter++;
            } elseif ($userEmail != $eMail) {
                $attempts = ($max - $counter);
                $msg = "Incorrect Email. $attempts attempts remaining.";
                $_SESSION['counter'] = $counter++;
            } else {
                $_SESSION['email'] = $email;

                $sql = "select count(*) as c from user where email = '" . $eMail. "' and password = '".$pWord. "' and auth = '1'";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //send the query to the database or quit if cannot connect
                $field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
                $count = $field->c;

                if ($sql = "select count(*) as c from user where auth = '1'"){
                    $msg = "Account not authorized. Please check your email for authorization link before logging in.";
                }
                elseif ($count > 0)
                    Header ("Location:user.php") ;
                else $msg = "The information entered does not match with the records in our database.";
            }
        }
        elseif (isset($_GET['l'])) {
            $tag = $_GET['l'];
            if ($tag == 'r') $msg = "You have already registered with this email. Click on Forget Password to retrieve your password.";
        }
        else {
            $disabled = "disabled";
            $msg = "Max Attempts Used. Please Try Again Later.";
        }
    }
    ?>

    <!-- Wrapper -->
    <div id="wrapper">

        <form action="login.php" method="post">

            <h1>Log In</h1>

            <?php print $msg; ?>

            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="btables@iupui.edu" name="email" <?php echo $disabled; ?>>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" <?php echo $disabled; ?>>

            <button name="enter" class="btn" type="submit">Log In</button>
        </form>

        <!-- Footer -->
        <?php
        include "./footer.php"
        ?>

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