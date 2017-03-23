<?php

function connectToDatabase ()
{
    //leh static fe task line 38
    //static
     static $link;
    if (isset($link))
        {
            return $link;
        }
    else
        {   
            include_once("../config.php") ;
            $link = mysqli_connect($host, $user, $password, $database);
        if (!$link)
            {
                die(mysqli_connect_error());
            }
    
            return $link;
        }
    
}

//validate function for date
function validateDate($date){
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return ($d && $d->format('Y-m-d') == $date);
}