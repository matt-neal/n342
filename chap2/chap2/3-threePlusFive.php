<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Three Plus Five</title>
</head>
<body>
	<h1>Three Plus Five</h1>
	<h3>Demonstrates use of numeric variables</h3>

	<?php 

		$x = 3;
		$y = 5;

		$sum = $x + $y;
		$dif = $x - $y;
		$prod = $x * $y;
		$quotient = $x / $y;
/*
	<<< indicates the start of a special string named by yourself, e.g. <<<HERE
	The string ends when it encounters the string again at the very beginning of a new line.

	<<<HERE 
	......
	HERE

	*/
		print <<<HERE

			<p>$x + $y = $sum</p>
			<p>$x - $y = $dif</p>
			<p>$x * $y = $prod</p>
			<p>$x / $y = $quotient</p>

HERE;

		//same as

		print "
			Another way 1: <br/>

			<p>$x + $y = $sum</p>
			<p>$x - $y = $dif</p>
			<p>$x * $y = $prod</p>
			<p>$x / $y = $quotient</p>

		";

		//same as

		print "
			Another way 2: <br/>

			<p>".$x ." + ". $y ." = $sum</p>
			<p>$x - $y = $dif</p>
			<p>$x * $y = $prod</p>
			<p>$x / $y = $quotient</p>

		";

		//if you do want to print out the dollar sign, add a $ sign or use the escape character
		print "
		Print out the dollar sign $: <br/>
			<p>$$x + $$y = $$sum</p>
			<p>\$$x - \$$y = \$$dif</p>
			<p>$x * $y = $prod</p>
			<p>$x / $y = $quotient</p>

		";




	?>


</body>
</html>
