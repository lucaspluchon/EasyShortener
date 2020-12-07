<?php

/*
    Generate hash to shorten the link
*/

require_once("database.php");

function hash_generate()
{
    do
    {
        $hash = "";
        for ($i = 0; $i < 4; $i++)
        {
            $choose = random_int(1,3);
            if ($choose == 1)
            {
                $hash .= chr(random_int(48,57));
            }
            elseif ($choose == 2)
            {
                $hash .= chr(random_int(64,91));
            }
            elseif ($choose == 3)
            {
                $hash .= chr(random_int(97,122));
            }
        
        }
    } while (db_hashExist($hash));

    return $hash;
}


?>