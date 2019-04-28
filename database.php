
<?php

function exportPre($obj)
{
    return "<pre>" . var_export($obj, true) . "</pre>";
}

// echo echoPre($_SERVER);
//echo gethostname();

if (gethostname() == "DESKTOP-6SMPPN7") {
    $db = new PDO("mysql:host=localhost;dbname=ecommerce", "root", "root");
} else {
    $db = new PDO("mysql:host=localhost;dbname=rgarfink_ecommerce", "rgarfinkel", "codeschool1");
}

?>