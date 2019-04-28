<?php
include "database.php";

if (isset($_GET[ 'sku' ])) {
    $sku = $_GET[ 'sku' ];
} else {
    include "sku_not_found.php";
    exit();
}
$sql = "SELECT * FROM inventory WHERE sku='$sku'";

$result = $db->query($sql);
if ($result == false) {
    include "sku_not_found.php";
    exit();
}

$row = $result->fetch(PDO::FETCH_ASSOC);
if ($row == false) {
    include "sku_not_found.php";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
   
    <style>
    .price,.quantity {
        text-align: right;
    }
    .btn {
        margin-top: 10px;
    }
    
    </style>
</head>
<body class="container">
    <div class="row">
        <div class="col">
            <h1><?=$row[ 'title' ]?></h1>
            <p><?=$row[ 'description' ]?></p>
        </div>
        <div class="col">
            <form action="cart.php" method="get">
                <input type="hidden" name="sku" value=<?="$sku" ?>>
                Price: $<?=number_format($row[ 'unit_price' ], 2)?> each
                <br>
                <label for="in_stock"> Available: <?= $row[ 'in_stock' ] ?></label>
                <br>
                <input type="number" step="1" min="1" max="10" name="how_many" placeholder="" required="required">
                <br>
                <input type="submit" class="btn btn-success" value="Add to cart">
            </form>
        </div>
    </div>

</body>
</html>