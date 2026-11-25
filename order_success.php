<?php
session_start();

$cart = $_SESSION['cart'] ?? [];

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Confirmation</title>

<style>

body{
    font-family:Arial;
    background:#f4f4f4;
    padding:40px;
}

.card{
    max-width:800px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

h1{
    color:green;
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th{
    background:#3498db;
    color:white;
}

th, td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}

.total{
    text-align:right;
    font-size:22px;
    font-weight:bold;
    margin-top:15px;
    color:green;
}

.btn{
    display:block;
    width:250px;
    margin:25px auto 0;
    text-align:center;
    padding:15px;
    text-decoration:none;
    background:#3498db;
    color:white;
    border-radius:8px;
}

</style>
</head>
<body>

<div class="card">

<h1>✅ Order Sent To Kitchen</h1>

<p style="text-align:center;">
Your order has been successfully sent to the kitchen.
</p>

<h2>Order Items</h2>

<table>

<tr>
    <th>Item</th>
    <th>Qty</th>
    <th>Unit Price</th>
    <th>Set Meal</th>
    <th>Line Total</th>
</tr>

<?php foreach($cart as $item => $details): ?>

<?php

$qty = $details['qty'];
$price = $details['price'];

$setCharge = $details['set'] ? 1.50 : 0;

$lineTotal = ($price + $setCharge) * $qty;

$total += $lineTotal;

?>

<tr>
    <td><?= $item ?></td>
    <td><?= $qty ?></td>
    <td>$<?= number_format($price,2) ?></td>
    <td>
        <?= $details['set'] ? 'Yes (+$1.50)' : 'No' ?>
    </td>
    <td>
        $<?= number_format($lineTotal,2) ?>
    </td>
</tr>

<?php endforeach; ?>

</table>

<div class="total">

Grand Total:
$<?= number_format($total,2) ?>

</div>

<?php
unset($_SESSION['cart']);
?>

<a href="order_taking.php" class="btn">
Restart New Order
</a>

</div>

</body>
</html>