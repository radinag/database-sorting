<?php
include "database.php";

$sku = isset($_GET[ 'sku' ]) ? $_GET[ 'sku'] : "";
$qty = isset($_GET[ 'how_many' ]) ? $_GET[ 'how_many' ] : 0;

if ($sku != "" && $qty<0) {
    include "sku_not_found.php";
    exit();
}

$command = isset($_GET['command']) ? $_GET[ 'command' ] : "";
if ($command == "delete") {
    $sql = "DELETE FROM cart WHERE sku = :sku";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':sku', $sku);
} else {
    $sql = "INSERT INTO cart (sku, in_cart) VALUES ( :sku, :in_cart )
ON DUPLICATE KEY UPDATE in_cart = in_cart + :in_cart";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':sku', $sku);
    $stmt->bindParam(':in_cart', $qty);
}

$result=$stmt->execute();
if ($result == false) {
    echo "FAILED";
    exit();
}
$sql = "SELECT cart.sku, cart.in_cart, inventory.title, inventory.unit_price
FROM cart 
JOIN inventory 
ON cart.sku = inventory.sku
ORDER BY title";

$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="css/ecommerce.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Your Cart  <img src="images/cart1.png"></h1>
    <table id="movies">
        <thead>
            <th>Title</th>
            <th>Unit Price</th>
            <th>In Cart</th>
            <th>Subtotal</th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
<?php

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $total = $total + $row[ 'unit_price' ] * $row[ 'in_cart' ]; ?>
            <tr>
                <td><?=$row[ 'title' ]?></td>
                <td>$<?= number_format($row[ 'unit_price' ], 2)?></td>
                <td><?=$row[ 'in_cart' ]?></td>
                <td>$<?= number_format($row[ 'unit_price' ] * $row[ 'in_cart' ], 2)?></td>
                <td><a href='cart.php?sku=<?= $row[ 'sku' ]?>&command=delete' class="btn btn-success">Delete</a></td>
            </tr>
<?php
}
?>
        </tbody>
        <tfoot>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><strong>TOTAL: $</strong> <?=number_format($total, 2)?></td>
                <td><button onclick="checkout()" class="btn btn-success">Check Out</button></td>
            </tr>
         </tfoot>
    </table>
      <br>
            <p><a href="index.php" class="btn btn-success">Continue Shopping</a></p>
            <script>
            function checkout(){
                alert("Thank you for shopping!");
            }
            </script>
</body>
</html>