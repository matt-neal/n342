<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
admin.php

PLEASE READ THIS FILE and LOGIN.PHP and labThree.php
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
require_once "../inc/util.php";
require_once "../mail/mail.class.php";
include "./head.php";
?>

<body>

<?php
$msg = "";
$fName = "";
$firstNameRequired = "*";
$lName = "";
$lastNameRequired = "*";
$pWord = "";
$passwordRequired = "*";
$passwordConfirmation = "";
$eMail = "";
$emailRequired = "*";
$emailConfirmation = "";
$phoneNumber = "";
$pNumber = "";
$userDept = "";
$userStatus = "";
$userGender = "";
$mChecked = "";
$fChecked = "";
$termsReq = "*";
$userArray = "";


if (isset($_POST['enter'])) {
    //ensure no white space
    $fName = trim($_POST['firstName']);
    $lName = trim($_POST['lastName']);
    $eMail = trim($_POST['email']);
    $emailConfirmation = trim($_POST['emailConfirm']);
    $pWord = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirm']);
    $userGender = trim($_POST['gender']);
    $userStatus = trim($_POST['status']);
    $userDept = trim($_POST['department']);
    $pWordCheck = false;

    if ($fName == "") {
        $firstNameRequired = '<span style = "color: red">*</span>';
    };

    if ($lName == "") {
        $lastNameRequired = '<span style = "color: red">*</span>';
    };


    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $emailRequired = '<span style="color:red">*</span>';
    }
    else {
        if ($userGender == "Male") {
            $mChecked = "checked";
            $fChecked = "";
        }
        else {
            $mChecked = "";
            $fChecked = "checked";
        };

        if (!pwdValidate($pWord)) {
            $msg = 'Password is not in the required format of 10 or more characters containing at least one letter and on number.';
            $pWord = "";
            $passwordConfirmation = "";
        }
        else {
            if ($pWord != $passwordConfirmation) {
                $msg = "Please enter matching passwords.";
            }
            else $pWordCheck = true;
            {
                if ($eMail != $emailConfirmation) {
                    $msg = "Please enter matching emails.";
                }
                elseif ($pWord != $passwordConfirmation) {
                    $msg = "Please enter matching passwords.";
                    $pWord = "";
                    $passwordConfirmation = "";
                }
                elseif (($firstNameRequired != "*") or ($lastNameRequired != "*") or ($emailRequired != "*") or ($termsReq != "*")) {
                    $msg = "Please enter valid data.";
                }
                else {
                    //post an array to the log in page
                    $userArray = $_SESSION['userDetails'] = $fName, $lName, $eMail, $pNumber;
                        //direct to another file to process using query strings
                        header("Location:login.php?uA={$userArray}");
                    }
            }
        }
    }
}

/*This function will validate if user created a strong password
* Longer than 10 characters and alphanumeric letters.
*/
function pwdValidate($field) {
    if (strlen($field) < 10) {
        return false;
    }

    else {
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
        }

        else return false;
    }
}

?>

<!-- Wrapper -->
<div id="wrapper">

    <form action="admin.php" method="post">

        <h1>Please Enter User Information</h1>

        <?php print $msg; ?>

        <label for="firstName">First Name: <?php print $firstNameRequired; ?></label>
        <input type="text" id="firstName" placeholder="Bobby" name="firstName" value="<?php print $fName; ?>" required>

        <label for="lastName">Last Name: <?php print $lastNameRequired; ?></label>
        <input type="text" id="lastName" placeholder="Tables" name="lastName" value="<?php print $lName; ?>" required>

        <label for="email">Email: <?php print $emailRequired; ?></label>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>" required>

        <label for="password">Password: <?php print $passwordRequired; ?></label>
        <input type="password" id="password" name="password" value="<?php print $pWord; ?>" required>

        <label for="phone">Phone Number (Format as: (###)###-####): <?php print $phoneNumber; ?></label>
        <input type="text" id="phoneNumber" placeholder="(317)555-5555" name="phoneNumber" value="<?php print $pNumber; ?>" required>

        <button name="enter" class="btn" type="submit">Sign Up</button>
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