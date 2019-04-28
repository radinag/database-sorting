
<?php

function exportPre($obj)
{
    return "<pre>" . var_export($obj, true) . "</pre>";
}

// echo echoPre($_SERVER);
//echo gethostname();

if (gethostname() == "") {
    $db = new PDO("mysql:host=localhost;dbname=", "", "");
} else {
    $db = new PDO("mysql:host=localhost;dbname=", "", "");
}

?>
