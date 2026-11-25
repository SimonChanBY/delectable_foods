<?php
session_start();

$menu = [

"Starters" => [
    "Chicken Wings" => 2.00,
    "Chicken Nuggets" => 2.00,
    "Truffle Fries" => 4.00,
    "Calamari" => 8.00
],

"Toast" => [
    "Kaya Toast" => 2.50,
    "Kaya Butter Toast" => 2.80,
    "Peanut Toast" => 2.50,
    "Peanut Butter Toast" => 2.80,
    "Kaya Toast Set" => 4.00,
    "Kaya Butter Toast Set" => 4.30,
    "Peanut Toast Set" => 4.00,
    "Peanut Butter Toast Set" => 4.30
],

"Local Delights" => [
    "Chicken Rice" => 8.00,
    "Laksa" => 5.00,
    "Mee Rebus" => 5.00,
    "Mee Siam" => 5.00
],

"Dessert" => [
    "Kaya Balls" => 3.00,
    "Butter Cake" => 2.50,
    "Banana Cake" => 2.50,
    "Chocolate Cake" => 2.50
],

"Drinks" => [
    "Kopi / Tea" => 1.20,
    "Kopi / Tea O" => 1.10,
    "Kopi / Tea C" => 1.30,
    "Milo" => 1.60
]

];

if(!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = [];
}

if(isset($_POST['action']))
{
    $item = $_POST['item'];

    switch($_POST['action'])
    {

        case 'add':

            $price = $_POST['price'];

            if(isset($_SESSION['cart'][$item]))
            {
                $_SESSION['cart'][$item]['qty']++;
            }
            else
            {
                $_SESSION['cart'][$item] = [
                    'qty'=>1,
                    'price'=>$price,
                    'set'=>false
                ];
            }

            break;

        case 'plus':

            $_SESSION['cart'][$item]['qty']++;
            break;

        case 'minus':

            $_SESSION['cart'][$item]['qty']--;

            if($_SESSION['cart'][$item]['qty'] <= 0)
            {
                unset($_SESSION['cart'][$item]);
            }

            break;

        case 'remove':

            unset($_SESSION['cart'][$item]);
            break;

        case 'set':

            $_SESSION['cart'][$item]['set'] =
                !$_SESSION['cart'][$item]['set'];

            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Order Taking</title>

<style>

body{
    font-family:Arial;
    background:#f4f6f8;
    margin:0;
}

.header{
    background:#2c3e50;
    color:white;
    padding:15px;
    text-align:center;
}

.container{
    display:flex;
    height:calc(100vh - 70px);
}

.left{
    width:65%;
    overflow:auto;
    padding:20px;
}

.right{
    width:35%;
    background:white;
    padding:20px;
    box-shadow:-2px 0 10px rgba(0,0,0,.1);
}

.category{
    margin-bottom:30px;
}

.category h2{
    background:#3498db;
    color:white;
    padding:10px;
    border-radius:8px;
}

.item-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(180px,1fr));
    gap:10px;
}

.item-btn{

    width:100%;
    background:white;
    border:none;
    padding:15px;
    border-radius:8px;
    cursor:pointer;
    box-shadow:0 2px 6px rgba(0,0,0,.15);
}

.item-btn:hover{
    background:#dff5ff;
}

.price{
    color:green;
    font-weight:bold;
}

.order-item{
    border-bottom:1px solid #ddd;
    padding:10px 0;
}

.qty-btn{

    width:35px;
    height:35px;
    border:none;
    cursor:pointer;
    border-radius:5px;
}

.plus{
    background:#27ae60;
    color:white;
}

.minus{
    background:#e67e22;
    color:white;
}

.remove{
    background:#e74c3c;
    color:white;
}

.total{
    margin-top:15px;
    font-size:22px;
    font-weight:bold;
    color:green;
}

.send{
    width:100%;
    margin-top:20px;
    padding:15px;
    background:#27ae60;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.set-option{
    color:#9b59b6;
    font-weight:bold;
}

.small-form{
    display:inline;
}

</style>

</head>

<body>

<div class="header">

<h1>🍽 Order Taking Screen</h1>

</div>

<div class="container">

<div class="left">

<?php foreach($menu as $category=>$items): ?>

<div class="category">

<h2><?= $category ?></h2>

<div class="item-grid">

<?php foreach($items as $name=>$price): ?>

<form method="POST">

<input type="hidden" name="action" value="add">
<input type="hidden" name="item" value="<?= $name ?>">
<input type="hidden" name="price" value="<?= $price ?>">

<button class="item-btn">

<b><?= $name ?></b>

<br><br>

<span class="price">
$<?= number_format($price,2) ?>
</span>

</button>

</form>

<?php endforeach; ?>

</div>

</div>

<?php endforeach; ?>

</div>

<div class="right">

<h2>🧾 Order List</h2>

<?php

$total = 0;

foreach($_SESSION['cart'] as $item=>$details):

    $qty = $details['qty'];

    $price = $details['price'];

    $setCharge = 0;

    if($details['set'])
    {
        $setCharge = 1.50;
    }

    $lineTotal = ($price + $setCharge) * $qty;

    $total += $lineTotal;

?>

<div class="order-item">

<b><?= $item ?></b>

<?php if($details['set']): ?>
<br>
<span class="set-option">Set Meal (+$1.50)</span>
<?php endif; ?>

<br><br>

Qty : <?= $qty ?>

<br>

Line Total :
$<?= number_format($lineTotal,2) ?>

<br><br>

<form class="small-form" method="POST">
<input type="hidden" name="action" value="plus">
<input type="hidden" name="item" value="<?= $item ?>">
<button class="qty-btn plus">+</button>
</form>

<form class="small-form" method="POST">
<input type="hidden" name="action" value="minus">
<input type="hidden" name="item" value="<?= $item ?>">
<button class="qty-btn minus">-</button>
</form>

<form class="small-form" method="POST">
<input type="hidden" name="action" value="remove">
<input type="hidden" name="item" value="<?= $item ?>">
<button class="qty-btn remove">🗑</button>
</form>

<?php

if(
    strpos($item,"Toast") !== false
)
{
?>

<form class="small-form" method="POST">
<input type="hidden" name="action" value="set">
<input type="hidden" name="item" value="<?= $item ?>">
<button>
<?= $details['set']
? 'Remove Set'
: 'Make Set (+$1.50)' ?>
</button>
</form>

<?php } ?>

</div>

<?php endforeach; ?>

<div class="total">
Grand Total:
$<?= number_format($total,2) ?>
</div>

<hr>

<h3>📢 Order Readback</h3>

<?php

foreach($_SESSION['cart'] as $item=>$details)
{
    echo "<p>";
    echo $details['qty']." x ".$item;

    if($details['set'])
    {
        echo " (Set Meal)";
    }

    echo "</p>";
}

?>

<form action="order_success.php" method="POST">

<button class="send">

Send To Kitchen

</button>

</form>

</div>

</div>

</body>
</html>