<?php
include "database.php";
$sql = "SELECT * FROM inventory";
$itemsort = "";
if (isset($_GET['sortby'])) {
    $sortby = $_GET['sortby'];
    if (substr($sortby, 0, 4) == "item") {
        $orderby = "ORDER BY title";
        if (substr($sortby, -1) == "-") {
            $orderby = $orderby . " DESC";
            $itemsort = "";
        } else {
            $itemsort = "-";
        }
    } elseif ($sortby == "price") {
        $orderby = "ORDER BY unit_price";
    } elseif ($sortby == "qty") {
        $orderby = "ORDER BY in_stock";
    } else {
        $orderby = "";
    }

    $sql = $sql . ' ' . $orderby;
}
// $row = $result->fetch( PDO::FETCH_ASSOC );
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ecommerce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/ecommerce.css" rel="stylesheet" type="text/css">
</head>

<body>
   
    <h1>In-Stock Inventory</h1>
    <table id="movies">
    <thead>
        <tr>
            <th><a href="?sortby=item<?= $itemsort ?>">Title</a></th>
            <th><a href="?sortby=price">Price</a></th>
            <th><a href="?sortby=qty">In Stock</a></th>
        </tr>
    </thead>

<?php
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><a href="details.php?sku=<?= $row[ 'sku' ] ?>"><?= $row[ 'title' ] ?></a></td>
            <td class="price"> $<?= number_format($row[ 'unit_price' ], 2) ?> </td>
            <td class="quantity"> <?= $row[ 'in_stock' ] ?></td>
        </tr>
<?php
    }
?>
    </table>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
