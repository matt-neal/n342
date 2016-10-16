<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
labThree.php

PLEASE READ THIS FILE and LOGIN.PHP and ADMIN.PHP
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
    $userDept = "";
    $userStatus = "";
    $userGender = "";
    $mChecked = "";
    $fChecked = "";
    $termsReq = "*";
    $userArray = "";
    $userSessionArray = "";


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
                        $userArray = array($eMail, $pWord);
                        $userSessionArray = $_SESSION['userDetails'] = $userArray;
                        header("Location:login.php");
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

    <form action="lab4.php" method="post">

        <h1>Register</h1>

        <?php print $msg; ?>

            <label for="firstName">First Name: <?php print $firstNameRequired; ?></label>
            <input type="text" id="firstName" placeholder="Bobby" name="firstName" value="<?php print $fName; ?>" required>

            <label for="lastName">Last Name: <?php print $lastNameRequired; ?></label>
            <input type="text" id="lastName" placeholder="Tables" name="lastName" value="<?php print $lName; ?>" required>

            <label for="email">Email: <?php print $emailRequired; ?></label>
            <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>" required>

            <label for="emailConfirm">Confirm Email:</label>
            <input type="email" id="emailConfirm" name="emailConfirm" placeholder="Please Confirm Email" value="<?php print $emailConfirmation; ?>" required>

            <label for="password">Password: Must contain 10 characters, with at least 1 letter and 1 number. <?php print $passwordRequired; ?></label>
            <input type="password" id="password" name="password" value="<?php print $pWord; ?>" required>

            <label for="password">Confirm Password:</label>
            <input type="password" id="passwordConfirm" placeholder="Please Confirm Password" name="passwordConfirm" value="<?php print $passwordConfirmation; ?>" required>

            <label>Gender:</label>
            <input type="radio" id="Male" value="Male" name="gender" <?php print $maleChecked; ?> checked><label for="Male" class="light">Male</label><br>
            <input type="radio" id="Female" value="Female" name="gender" <?php print $femaleChecked; ?>><label for="Female" class="light">Female</label>

            <label for="department">Department:</label>
            <select id="department" name="department">
                <optgroup label="School of Science">
                    <option value="Computer Science" selected>Computer Science</option>
                    <option value="Computer Engineering">Computer Engineering</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Information Technology">Information Technology</option>
                </optgroup>
                <optgroup label="University College">
                    <option value="Liberal Arts">Liberal Arts</option>
                    <option value="Something Else">Something Else</option>
                </optgroup>
                <optgroup label="Other">
                    <option value="Secretary">Secretary</option>
                    <option value="Maintenance">Maintenance</option>
                </optgroup>
            </select>

            <label>Status:</label>
            <input type="checkbox" id="student" value="Student" name="status"><label class="light" for="student">Student</label><br>
            <input type="checkbox" id="faculty" value="Faculty" name="status"><label class="light" for="faculty">Faculty</label><br>
            <input type="checkbox" id="staff" value="Staff" name="status"><label class="light" for="staff">Staff</label>

            <label>Terms and Conditions: <?php print $termsReq; ?></label>
            <input type="checkbox" id="terms" value="terms" name="terms" required><label class="light" for="terms">I Agree to the Terms and Conditions:</label>

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