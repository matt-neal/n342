<!--
Matthew Neal
CSCI N-342
Completed 9-16-16
registration.php
-->

<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
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
$con = NULL;
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

        if (!pWordValidate($pWord)) {
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
                    /*************************************************************
                     * Enter data into the database here
                     *************************************************************/
                    //first escape all the strings so that backslashes are added before the following characters: \x00, \n, \r, \, ', " and \x1a.
                    //This is used to prevent sql injections.
                    $eMail = mysqli_real_escape_string(null, $eMail);
                    $pWord = mysqli_real_escape_string(null, $pWord);
                    $fName = mysqli_real_escape_string(null, $fName);
                    $lName = mysqli_real_escape_string(null, $lName);

                    $_SESSION['email'] = $eMail;

                    //first check if the username already exists in the database
                    $sql = "select count(*) as c from userinfo where username = '" . $eMail. "'";

                    $result = mysqli_query(null, $sql) or die("Error in the consult.." . mysqli_error($con)); //send the query to the database or quit if cannot connect
                    $count = 0;
                    $field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
                    $count = $field->c;
                    if ($count != 0)
                    {	Header ("Location:login.php?l=r");}
                    else //the username doesn't exist yet
                    {	$sql = "insert into userInfo values(null, '".$fName."', '".$lName."', '".$gender."', '".$userDept."', '".$userStatus."')";
                        $sql = "insert into user values ('".$eMail."', '".$pWord."')";
                        $result= mysqli_query($con, $sql) or die(mysqli_error($con)); //a non-select statement query will return a result indicating if the query is successful						//Commonly used functions are: Sys::getDB()->Execute, Sys::getDB()->GetOne(), Sys::getDB()->GetRows(),  Sys::getDB()->GetRow(), see details in adodb.inc.php
                        //send the email to the email registered for activating the account
                        //written by Andy Harris for his PHP/MySql book, modified for this lab to match
                        //my variables and requirements
                        $code = randomCodeGenerator(50);
                        $subject = "Email Activation";
                        $body = 'Thank you for registering at Precision Setups! We hope our website gives you the greatest experience.'.'<a href="http://corsair.cs.iupui.edu:20181/lab4/confirmation.php?code=' . $code . '">Your code is ' . $code . '</a>';
                        $mailer = new Mail();
                        if (($mailer->sendMail($eMail, $fName, $subject, $body)) == true) {
                            $msg = "<b>Thank you for registering. A welcome message has been sent to the address you have just registered.</b>";
                        }
                        else {
                            $msg = "Email not sent. ";
                        }
                        if ($result) $msg = "<b>Your information is entered into the database. </b>";
                        //Insert auth code into database
                        $sql = "insert into USER values(null, null, '".$code."')";
                    }

                    header("Location:login.php");
                }
            }
        }
    }
}

/*This function will validate if user created a strong password
* Longer than 10 characters and alphanumeric letters.
*/
function pWordValidate($field) {
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

        <label for="password">Password: Must contain 10-18 characters, with at least 1 letter and 1 number. <?php print $passwordRequired; ?></label>
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