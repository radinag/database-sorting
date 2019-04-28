<?php
if (isset($sku)) {
    $error = "SKU $sku NOT FOUND IN DATABASE.";
} else {
    $error = "SKU NOT SPECIFIED.";
}

if ($qty < 0) {
    $error = "QUANTITY NOT SPECIFIED CORRECTLY.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>SKU NOT FOUND</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
   
    <h1><?= $error ?></h1>
    <br>
    <a class="btn btn-primary" href="index.php">Continue Shopping</a>


 </body>
</html>