<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
registration.php
-->

<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
?>

<!DOCTYPE HTML>

<html>

<?php
require_once "./util.php";
require_once "../mail/mail.class.php";
require_once "./dbconnect.php";
require_once "./hash.php";
include "./head.php";
include "./header.php";
?>

<body class="registration">

<?php
//variable initialization
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
$homePhone = "";
$cellPhone = "";
$termsReq = "*";

if (isset($_POST['enter'])) {
    //ensure no white space
    $fName = trim($_POST['firstName']);
    $lName = trim($_POST['lastName']);
    $eMail = trim($_POST['email']);
    $emailConfirmation = trim($_POST['emailConfirm']);
    $pWord = trim($_POST['password']);
    $passwordConfirmation = trim($_POST['passwordConfirm']);
    $homePhone = trim($_POST['homePhone']);
    $cellPhone = trim($_POST['cellPhone']);
    $pWordCheck = false;

    //check if first name is entered
    if ($fName == "") {
        $firstNameRequired = '<span style = "color: red">*</span>';
    };//end if for first name required

    //check if last name is entered
    if ($lName == "") {
        $lastNameRequired = '<span style = "color: red">*</span>';
    };//end if for last name required

    //check if email is valid (if HTML check not working)
    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $emailRequired = '<span style="color:red">*</span>';
    }//end if for email valid

        //check password validation function to ensure within scope
        if (!pWordValidate($pWord)) {
            $msg = 'Password is not in the required format of 10 or more characters containing at least one letter and on number.';
            $pWord = "";
            $passwordConfirmation = "";
        }//end if for pword valid

        else {

            if ($pWord != $passwordConfirmation) {
                $msg = "Please enter matching passwords.";
            }//end if for pword match

            else $pWordCheck = true;
            {

                if ($eMail != $emailConfirmation) {
                    $msg = "Please enter matching emails.";
                }//end if for email confirmation

                elseif ($pWord != $passwordConfirmation) {
                    $msg = "Please enter matching passwords.";
                    $pWord = "";
                    $passwordConfirmation = "";
                }//end elif for pword confirmation

                elseif (($firstNameRequired != "*") or ($lastNameRequired != "*") or ($emailRequired != "*") or ($termsReq != "*")) {
                    $msg = "Please enter valid data.";
                }//end elif for HTML fail validations

                //starts outputting data to the database
                else {
                    /*************************************************************
                     * Enter data into the database here
                     *************************************************************/
                    //first escape all the strings so that backslashes are added before the following characters: \x00, \n, \r, \, ', " and \x1a.
                    //This is used to prevent sql injections.
                    $eMail = mysqli_real_escape_string($con, $eMail);
                    $pWord = mysqli_real_escape_string($con, $pWord);
                    $fName = mysqli_real_escape_string($con, $fName);
                    $lName = mysqli_real_escape_string($con, $lName);

                    $_SESSION['email'] = $eMail;

                    //first check if the username already exists in the database
                    $sql = "select count(*) as c from Customer_FP where Email = '" . $eMail. "'";

                    //send the query to the database or quit if cannot connect
                    $result = mysqli_query($con, $sql) or die("Error in the consult.." . mysqli_error($con));
                    $count = 0;

                    //the query results are objects, in this case, one object (the user email)
                    $field = mysqli_fetch_object($result);
                    $count = $field->c;

                    //redirect to the login page if the user exists already
                    if ($count != 0) {
                        Header ("Location:login.php");
                    }//end if for redirect

                    //if the username doesn't exist yet
                    else {
                        //send the email to the email registered for activating the account
                        //written by Andy Harris for his PHP/MySql book, modified for this lab to match
                        //my variables and requirements
                        $code = randomCodeGenerator(50);
                        $subject = "Email Activation";
                        $body = 'Thank you for registering at Precision Setups '.$fName.'! We hope our website gives you the greatest experience.'.'<a href="http://corsair.cs.iupui.edu:20181/PrecisionSetups/confirmation.php?code=' . $code . '&email=' . $eMail . '">Click here to finish registration.</a>';
                        $mailer = new Mail();

                        //check to see if email sends, then add data to the verification database
                        if (($mailer->sendMail($eMail, $fName, $subject, $body)) == true) {
                            $sql = "insert into Customer_FP values(null, '".$fName."', '".$lName."', '".$eMail."', null, null, '".$homePhone."', '".$cellPhone."', '".$code."', 0, 0)";
                            //a non-select statement query will return a result indicating if the query is successful
                            $result= mysqli_query($con, $sql) or die(mysqli_error($con));
                            encrypt($eMail, $pWord);
                            $msg = "<b>Thank you for registering. A welcome message has been sent to the address you have just registered.</b>";
                        }//end if

                        else {
                            $msg = "Email not sent. ";
                        }//end else
                    }//end else
                }//end else
            }//end else pword check
        }//end else
}//end if isset
?>

<!-- Wrapper -->
<div id="wrapper" class="registration">

    <form class="registration" action="registration.php" method="post">

        <?php print $msg; ?>

        <p class="label" for="firstName">First Name: <?php print $firstNameRequired; ?></p>
        <input type="text" id="firstName" placeholder="Bobby" name="firstName" value="<?php print $fName; ?>" required>

        <p class="label" for="lastName">Last Name: <?php print $lastNameRequired; ?></p>
        <input type="text" id="lastName" placeholder="Tables" name="lastName" value="<?php print $lName; ?>" required>

        <p class="label" for="email">Email: <?php print $emailRequired; ?></p>
        <input type="email" id="email" placeholder="btables@iupui.edu" name="email" value="<?php print $eMail; ?>" required>

        <p class="label" for="emailConfirm">Confirm Email:</p>
        <input type="email" id="emailConfirm" name="emailConfirm" placeholder="Please Confirm Email" value="<?php print $emailConfirmation; ?>" required>

        <p class="label" for="password">Password: <?php print $passwordRequired; ?></p>
        <input type="password" id="password" placeholder="10-18 characters, with 1 letter and 1 number." name="password" value="<?php print $pWord; ?>" required>

        <p class="label" for="password">Confirm Password:</p>
        <input type="password" id="passwordConfirm" placeholder="Please Confirm Password" name="passwordConfirm" value="<?php print $passwordConfirmation; ?>" required>

        <p class="label" for="cellPhone">Cell Phone: (Format: 555-555-5555)</p>
        <input type="text" id="cellPhone" placeholder="Please Enter Cell Phone #" name="cellPhone" value="<?php print $cellPhone; ?>" required>

        <p class="label" for="homePhone">Home Phone: (Format: 555-555-5555)</p>
        <input type="text" id="homePhone" placeholder="Please Enter Home Phone #" name="homePhone" value="<?php print $homePhone; ?>">

        <p class="label">I Agree to the Terms and Conditions <?php print $termsReq; ?>
        <input type="checkbox" id="terms" value="terms" name="terms" required></p>

        <button name="enter" class="btn" type="submit">Sign Up</button>
    </form>

</div>

<!-- Scripts -->
<script src="../assets/js/jquery.min.js"></script>
<!--<script src="assets/js/main.js"></script> -->

</body>
<!-- Footer -->
<footer class="footer" id="registration">
    <div class="row">
        <div class="small-12 columns">
            <p class="slogan">Guitar and Bass Setups, Minor Repair, Fret Leveling, and More</p>
            <p class="copywrite">Copyright Precision Setups © 2016</p>
        </div>
    </div>
</footer>
</html>