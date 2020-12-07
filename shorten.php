<?php 

/*
    Link between DB and Hash generator
*/

require_once("scripts/hash_generator.php");

$max_request = 100;
$url = filter_var(htmlentities($_REQUEST["url"],ENT_QUOTES), FILTER_SANITIZE_STRING);

function send_hash($url)
{
    $hash = hash_generate();
    db_addLink($hash,$url);
    echo($hash);
}


if (filter_var($url, FILTER_VALIDATE_URL) === false)
{
    echo("link_not_valid");
}
else
{
    $ip = ip_adress();
    $ip_statut = db_ipExist($ip);
    if ($ip_statut == NULL)
    {
        db_addIp($ip);
        send_hash($url);
    }
    elseif ($ip_statut[1] < $max_request)
    {
        db_addCount($ip);
        send_hash($url);
    }
    elseif (time() - $ip_statut[0] >= 86400)
    {
        db_resetCount($ip);
        send_hash($url);
    }
    else
    {
        echo("too_many_request");
    }
}


?>