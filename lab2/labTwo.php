<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
labTwo.php

PLEASE READ BOTH THIS FILE and LOGIN.PHP
-->

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

    if (isset($_POST['enter']))
    {
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

        if (!pwdValidate($pWord)) {
            $msg = 'Password is not in the required format.';
        } else {
            if ($pWord != $passwordConfirmation)
                $msg = "Passwords are not the same.";
            else $pWordCheck = true;
        }

        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $emailRequired = '<span style="color:red">*</span>';
        } else {
            if ($userGender == "Male") {
                $mChecked = "checked";
                $fChecked = "";
            } else {
                $mChecked = "";
                $fChecked = "checked";
            };

            if ($eMail != $emailConfirmation) {
                $msg = "Please enter matching emails.";
            } elseif ($pWord != $passwordConfirmation) {
                $msg = "Please enter matching passwords.";
            } elseif (($firstNameRequired != "*") or ($lastNameRequired != "*") or ($emailRequired != "*") or ($termsReq != "*")) {
                $msg = "Please enter valid data.";

            } else {
                    //send the email to the email registered for activating the account
                    //written by Andy Harris for his PHP/MySql book, modified for this lab to match
                    //my variables and requirements
                    $code = randomCodeGenerator(50);
                    $subject = "Email Activation";

                    $body = '<a href="http://corsair.cs.iupui.edu:20181/lab2/login.php?code='.$code.'">Your code is '.$code.'</a>';
                    $mailer = new Mail();
                    if (($mailer->sendMail($eMail, $fName, $subject, $body)) == true){
                        $msg = "<b>Thank you for registering. A welcome message has been sent to the address you have just registered.</b>";
                    }

                    else {
                        $msg = "Email not sent. ";
                    }

                    //direct to another file to process using query strings
                    header("Location:confirmation.php?mG={$msg}&fN={$fName}&lN={$lName}&eM={$eMail}&uG={$userGender}&uD={$userDept}&uS={$userStatus}&pW={$pWord}");
                }
            };
    }

/*This function will validate if user created a strong password
* Longer than 12 characters and alphanumeric letters.
*/
function pwdValidate($field)
{
    $field = trim($field);
    if (strlen($field) < 10)
    {
        return false;
    }
    else
    {
        //go through each character and find if there is a number or letter
        $letter = false;
        $number = false;
        $chars = str_split($field);

        for ($i = 0; $i < strlen($field); $i++)
        {
            if (preg_match("/[A-Za-z]/", $chars[$i]))
            {
                $letter = true;
                break;
            }
        }

        for ($i = 0; $i < strlen($field); $i++)
        {
            if (preg_match("/[0-9]/", $chars[$i]))
            {
                $number = true;
                break;
            }
        }

        if (($letter == true) and ($number == true))
        {
            return true;
        }

        else return false;
    }
}

?>

<!-- Wrapper -->
<div id="wrapper">

    <form action="labTwo.php" method="post">

        <h1>Register</h1>

        <?php print $msg; ?>

            <label for="firstName">First Name: <?php print $firstNameRequired; ?></label>
            <input type="text" id="firstName" placeholder="Bobby" name="firstName" value="<?php print $fName; ?>" required>

            <label for="lastName">Last Name: <?php print $lastNameRequired; ?></label>
            <input type="text" id="lastName" placeholder="Tables" name="lastName" value="<?php print $lName; ?>" required>

            <label for="email">Email: <?php print $emailRequired; ?></label>
            <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>" required>

            <label for="emailConfirm">Confirm Email:</label>
            <input type="email" id="emailConfirm" name="emailConfirm" value="<?php print $emailConfirmation; ?>" required>

            <label for="password">Password: <?php print $passwordRequired; ?></label>
            <input type="password" id="password" name="password" value="<?php print $pWord; ?>" required>

            <label for="password">Confirm Password:</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm" value="<?php print $passwordConfirmation; ?>" required>

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