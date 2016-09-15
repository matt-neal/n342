<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Query String Demo</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}
	</style>

	</head>

	<body>

		<?php
			//always initialized variables to be used
			$fn = "";
			$ln = "";
			$em = "";
			$gender = "";
			$state = "";
			$msg = "";
			$fnre="*";
			$lnre="*";
			$emre="*";
			$maleChecked = "";
			$femaleChecked = "";

			
			

			if (isset($_POST['enter']))
			{


				//take the information submitted and send to a process file
			
				$fn = trim($_POST['firstName']); //always trim the user input to get rid of the additiona white spaces on both ends of the user input
				$ln = trim($_POST['lastName']);
				$gender = trim($_POST['gender']);
				$em = trim($_POST['email']);
				if (!filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL))
					$emre = '<span style="color:red">*</span>';
				else



				if ($gender=="Male") {
					$maleChecked="checked";
					$femaleChecked="";
				}
				else {
					$maleChecked="";
					$femaleChecked="checked";
				}
				$state = trim($_POST['state']);

				if ($fn== "")
					$fnre = "<span style=\"color:red\">*</span>";
				
				if ($ln== "")
					$lnre = '<span style="color:red">*</span>';


				if (($fnre!="*") || ($lnre != "*") || ($emre != "*"))				
				{	
					$msg = "<br />Please enter valid data.<br />";
				}
				else {
										
					//direct to another file to process using query strings
					header ("Location:8-process.php?fn=".$fn."&ln=".$ln."&em=".$em."&g=".$gender."&s=".$state) ;
				}
			}
		?>

		<form action="8-queryString.php" method="post">
			<h1>User Registration</h1>
			
			<?php
				print $msg;
			?>
			
			First Name: <?php print $fnre; ?>
				 <input type="text" maxlength = "50" value="<?php print $fn; ?>" name="firstName" id="firstName"   /> <br />	
			Last Name: <?php print $lnre; ?>
				<input type="text" maxlength = "50" value="<?php print $ln; ?>" name="lastName" id="lastName"   />  <br />
			Email: <?php print $emre; ?>
				<input type="text" maxlength = "50" value="<?php print $em; ?>" name="email" id="email"   />  <br />
			Gender: 
				<input type = "radio" name = "gender" value = "Male" <?php print $maleChecked; ?> />Male
				<input type = "radio" name = "gender" value = "Female"  <?php print $femaleChecked; ?> />Female <br />
			State of Residence:
			<select  name = "state">
  				<option value = "IN">Indiana</option>
  				<option value = "NY" selected>New York</option>
  				<option value = "IL">Illinois</option>
  				<option value = "FL">Florida</option>
  				<option value = "CO">Colorado</option>
			</select>

			<input name="enter" class="btn" type="submit" value="Submit" />
		</form>



	</body>
</html>


