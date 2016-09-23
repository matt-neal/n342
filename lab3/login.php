<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
login.php

PLEASE READ BOTH THIS FILE and labTwo.PHP
-->

<?php
if(!isset( $_SESSION)) {
    session_start();
}
?>

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
<?php

$msg = "";
$pWord = "";
$eMail = "";
$counter = "";
$disabled = "";

$_SESSION[$counter] = 0;

if (isset($_POST['uA'])) {
    $userArray = ($_GET['uA']);
}

elseif (isset($_POST['enter'])) {
    //ensure no white space
    $eMail = trim($_POST['email']);
    $pWord = trim($_POST['password']);
    $pWordCheck = false;

    $counter++;

    if ($counter >= 3)
    {
        $disabled = "disabled";
        $msg = "Max attempts reached. Please try again later.";
    }

    //commented out until password validation is checked
    if (!pwdValidate($pWord)) {
        $msg = 'Password is not in the required format.';

    } else {
//                if ($pWord != $passwordConfirmation)
//                    $msg = "Passwords are not the same.";
//                    $counter++;
//                    if ($counter >= 3)
//                        {
//                            '<input type="email" disabled>';
//                            '<input type="password" disabled>';
//                        }
//                else $pWordCheck = true;
    }

    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
    } else {
        //direct to another file to process using query strings
        header("Location:index.php");
    };
}

/*This function will validate if user created a strong password
* Longer than 10 characters and alphanumeric letters.
*/
function pwdValidate($field)
{
    $field = trim($field);
    if (strlen($field) < 10) {
        return false;
    } else {
        //go through each character and find if there is a number or letter
        $letter = false;
        $number = false;
        $chars = str_split($field);

        for ($i = 0; $i < strlen($field); $i++) {
            if (preg_match("/[A-Za-z]/", $chars[$i])) {
                $letter = true;
                break;
            }
        }

        for ($i = 0; $i < strlen($field); $i++) {
            if (preg_match("/[0-9]/", $chars[$i])) {
                $number = true;
                break;
            }
        }

        if (($letter == true) and ($number == true)) {
            return true;
        } else return false;
    }
}
?>


<!-- Wrapper -->
<div id="wrapper">

    <form action="admin.php" method="post">

        <h1>Log In</h1>

        <?php print $msg; ?>

        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" required <?php echo $disabled; ?>>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" <?php echo $disabled; ?>>

        <button name="enter" class="btn" type="submit">Log In</button>
    </form>

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