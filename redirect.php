<?php

/*
    This script is executed when the user enter : eash.pw/XXXX 
*/

require_once("scripts/database.php");

$hash = ltrim(filter_var(htmlentities($_SERVER['REQUEST_URI'],ENT_QUOTES), FILTER_SANITIZE_STRING), '/');
$url = db_getLink($hash);

echo($hash."<br>");
echo($url);

if ($url != NULL)
{
    header('Location: '. $url);
    exit;
}
else
{
    header('Location: http://localhost');
    exit;
}

?>