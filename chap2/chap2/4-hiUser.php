<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Hi User</title>
</head>
<body>
	<h1>Hi User</h1>
	<h3>PHP program that receives a value from "whatsName"</h3>

	<?php 

		//PHP filters are used to validate and filter data coming from insecure sources, like user input.
		//E.g. validate if the user entry is an email adress
		//filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) will return true if valid email
		//Other useful ones: remove special characters in a url, validate if a user input is an integer, etc.
		//More reading:
		//http://www.w3schools.com/php/func_filter_input.asp
		//http://www.w3schools.com/php/php_ref_filter.asp

		$userName = filter_input(INPUT_GET, 'userName'); //nothing to filter or validate to the userName, so the filter options are not used
		
		//filter_input() returns the filtered data on success, FALSE on failure or NULL if the "variable" parameter is not set.
		if (!filter_input(INPUT_GET, 'email',FILTER_VALIDATE_EMAIL))
			print "email not valid.";
		else 
  			print "<h3>Hi there, $userName! Your email is ". filter_input(INPUT_GET, 'email',FILTER_VALIDATE_EMAIL).".</h3>";

	?>

</body>
</html>
