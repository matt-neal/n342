<?php

/* This function generates a random code with letters and digits.
* The paramter tells the how long the code should be.
*/
function randomCodeGenerator($length){
    $code = "";

    for ($i = 0; $i<$length; $i++)
    {
        //generate a random number between 1 and 35
        $r = mt_rand(1,35);

        //if the number is greater than 26, minus 26 will generate a digit between 0 and 9
        if ($r > 26)
        {
            $r = $r - 26;
            $code = $code.$r ;
        }
        else
        {    //it's between 1 and 26, generate a character
            $code = $code.toChar($r);
        }
    }
    return $code;
}

function toChar($digit){
    $char = "";
    switch ($digit)
    {
        case 1: $char = "A"; break;
        case 2: $char = "B"; break;
        case 3: $char = "C"; break;
        case 4: $char = "D"; break;
        case 5: $char = "E"; break;
        case 6: $char = "F"; break;
        case 7: $char = "G"; break;
        case 8: $char = "H"; break;
        case 9: $char = "I"; break;
        case 10: $char = "J"; break;
        case 11: $char = "K"; break;
        case 12: $char = "L"; break;
        case 13: $char = "M"; break;
        case 14: $char = "N"; break;
        case 15: $char = "O"; break;
        case 16: $char = "P"; break;
        case 17: $char = "Q"; break;
        case 18: $char = "R"; break;
        case 19: $char = "S"; break;
        case 20: $char = "T"; break;
        case 21: $char = "U"; break;
        case 22: $char = "V"; break;
        case 23: $char = "W"; break;
        case 24: $char = "X"; break;
        case 25: $char = "Y"; break;
        case 26: $char = "Z"; break;
        default: "A";
    }
    return $char;
}

//This function will sanitize text input from the web form before inserting into the database
function sqlReplace($text)
{
    $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out anything between the javascript tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
    );

    $text = preg_replace($search, '', $text);

    //the function below converts special characters to HTML entities, e.g. < becomes &lt;
    //read here about this function - http://php.net/manual/en/function.htmlspecialchars.php
    $text = htmlspecialchars($text, ENT_QUOTES);
        
  	return $text;
} 


?>