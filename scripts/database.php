<?php

/*
    All the useful function to access the DB
*/

$host = "";
$db_name = "";
$username = "";
$password = "";

function db_connect()
{
    global $host, $db_name, $username, $password;
    return new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $username, $password);
}

function db_getLink($hash)
{
    $db = db_connect();
    $req = $db->prepare("SELECT url FROM easyshortener_link WHERE hash = ?");
    $req->execute(array($hash));

    while ($data = $req->fetch())
    {   
        return $data['url'];
    }

    $req->closeCursor();
    return NULL;
}

function db_hashExist($hash)
{
    $db = db_connect();
    $req = $db->prepare("SELECT hash FROM easyshortener_link WHERE hash = ?");
    $req->execute(array($hash));

    while ($data = $req->fetch())
    {   
        return true;
    }

    $req->closeCursor();
    return false;   
}

function db_addLink($hash,$url)
{   
    $db = db_connect();
    $req = $db->prepare('INSERT INTO `easyshortener_link` (`id`, `hash`, `url`) VALUES (NULL, :hash, :url)');
    $req->execute(array(
        'hash' => $hash,
        'url' => $url
    ));
    $req->closeCursor();
}


function db_ipExist($ip)
{   
    $db = db_connect();
    $req = $db->prepare("SELECT * FROM easyshortener_user WHERE ip = ?");
    $req->execute(array($ip));

    while ($data = $req->fetch())
    {   
        return array($data['time'],$data['count']);
    }

    $req->closeCursor();
    return NULL;   
}   

function db_addIp($ip)
{   
    $db = db_connect();
    $req = $db->prepare('INSERT INTO `easyshortener_user` (`id`, `ip`, `count`, `time`) VALUES (NULL, :ip, :count, :time)');
    $req->execute(array(
        'ip' => $ip,
        'count' => 1,
        'time' => time()
    ));
    $req->closeCursor();
}

function db_addCount($ip)
{   
    $db = db_connect();
    $req = $db->prepare('UPDATE `easyshortener_user` SET count = count + 1 WHERE ip = ?');
    $req->execute(array($ip));
}

function db_resetCount($ip)
{
    $db = db_connect();
    $req = $db->prepare('UPDATE `easyshortener_user` SET count = 1, time = :time WHERE ip = :ip');
    $req->execute(array(
        'time' => time(),
        'ip' => $ip
    ));
}

function ip_adress()
{ 
    return $_SERVER['REMOTE_ADDR']; 
} 

?>