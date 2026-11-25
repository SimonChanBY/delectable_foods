<!DOCTYPE html>
<html>
<head>
<title>Delectable Foods</title>

<style>

body{
    font-family:Arial, sans-serif;
    background:#f5f5f5;
    margin:0;
}

.header{
    background:#2c3e50;
    color:white;
    text-align:center;
    padding:20px;
}

.category{
    padding:20px;
}

.category-title{
    background:#3498db;
    color:white;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}

.menu-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
}

.card{
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,0.15);
}

.card img{
    width:100%;
    height:180px;
    object-fit:cover;
}

.item-info{
    padding:15px;
}

.item-name{
    font-size:18px;
    font-weight:bold;
    margin-bottom:8px;
}

.price{
    color:green;
    font-size:20px;
    font-weight:bold;
}

.note{
    background:#fff3cd;
    border-left:5px solid #ffc107;
    padding:12px;
    margin-top:15px;
    border-radius:5px;
}

@media(max-width:768px){

    .menu-grid{
        grid-template-columns:1fr;
    }

}

</style>

</head>
<body>

<div class="header">
    <h1>🍽 Delectable Foods</h1>
    <p>Freshly Prepared Daily</p>
</div>

<?php

$menu = [

"Starters" => [
    ["Chicken Wings", "$2.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiCH9I7TQo5GxyWykQuHoBev8D1pMky-xXpfmsf1hobA&s=10"],
    ["Chicken Nuggets", "$2.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEOXo54uSJboePLu66LIeVJF7pzfxfJPEdZbDLhN2nZA&s=10"],
    ["Truffle Fries", "$4.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTf_Owc0s0zDBCdAn97E5nd01RokEzTVTEBVhypRwz15A&s=10"],
    ["Calamari Rings", "$8.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZuKLMR7aL-7N5HsOezUOdS-RdhBllPC_miyAzdYhuGA&s=10"]
],

"Toast" => [
    ["Kaya Toast", "$2.50", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyPQSr_0Q3X8kXpYEce2h4_q4sB1_c9UvcP6aEF2OEyg&s=10"],
    ["Kaya Butter Toast", "$2.80", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwSe2zD_0zmPoWQ48CD5T-KOlpn-HyzDgEAtEk0zFnEg&s=10"],
    ["Peanut Toast", "$2.50", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTNylVcJvb5-fId3CQW2rxzu1BUjv6U58cOSwCUJntRw&s=10"],
    ["Peanut Butter Toast", "$2.80", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpVedDoHDmu_8ckNlrYh2vV1zOM2mRsJJGlwxRrxHyMw&s=10"]
],

"Local Delights" => [
    ["Chicken Rice", "$8.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTn30EAtWEM9JIY4SekMqwSeE8M_1NuYtuDyHGv4KHowQ&s=10"],
    ["Laksa", "$5.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3DtUkJObKk0rmdqLtd7QgwW0ObaDTsjHZi11XQF22pw&s=10"],
    ["Mee Rebus", "$5.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8SUAzApM8_ypzYyhzEglKnSkbxvWxmVAYfKy_BXdU6w&s=10"],
    ["Mee Siam", "$5.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgv2wjOtyzl87j7jnzTqQko4PUQ2OKttwj0s0IRroCBA&s=10"]
],

"Dessert" => [
    ["Kaya Balls", "$3.00", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScC5bdqQfP0IbP9AH6wSy8zEW8gryDwi551CeqVzxBzQ&s=10"],
    ["Butter Cake", "$2.50", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMuBpIncTfs38eEhPNc9kZ5arXrptBxxcbSmMQQRCrSA&s=10"],
    ["Banana Cake", "$2.50", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSp1vMAl6B9CAkMnY1mglm8JQpsC6tkBH5xayZ0H6_4fQ&s=10"],
    ["Chocolate Cake", "$2.50", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbSTB_I-dhyT_QxiFK16h5iU-7DHQqitqDV2SYYeDmGA&s=10"]
],

"Drinks" => [
    ["Kopi / Tea", "$1.20", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFcCl1ZjxN48-UKuElqjixW5lG2OliQdQUkjw0-bq7EA&s=10"],
    ["Kopi / Tea O", "$1.10", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFcCl1ZjxN48-UKuElqjixW5lG2OliQdQUkjw0-bq7EA&s=10"],
    ["Kopi / Tea C", "$1.30", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFcCl1ZjxN48-UKuElqjixW5lG2OliQdQUkjw0-bq7EA&s=10"],
    ["Milo", "$1.60", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFcCl1ZjxN48-UKuElqjixW5lG2OliQdQUkjw0-bq7EA&s=10"]
]

];

foreach($menu as $category => $items)
{
?>

<div class="category">

    <h2 class="category-title">
        <?= $category ?>
    </h2>

    <div class="menu-grid">

        <?php foreach($items as $item){ ?>

        <div class="card">

            <!-- Replace image path with your own -->
            <img src="<?= $item[2] ?>"
                 alt="<?= $item[0] ?>">

            <div class="item-info">

                <div class="item-name">
                    <?= $item[0] ?>
                </div>

                <div class="price">
                    <?= $item[1] ?>
                </div>

            </div>

        </div>

        <?php } ?>

    </div>

    <?php if($category == "Toast"){ ?>

    <div class="note">
        ⭐ Add <b>$1.50</b> to make any toast into a set meal. ( Toast + 2 Half-Boiled Eggs + 1 Kopi/Tea)
    </div>

    <?php } ?>

</div>

<?php } ?>

</body>
</html>