<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory++</title>
    <link rel="stylesheet" href="../style/main.css">
</head>
<body>
    <?php
        include "conn.php";
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $question = $_POST['question'];
            if($question == "yes") {
                firstTime();
            }
        }
    ?>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="home.php">Home</a></nav>
    </div>
    <div id="main-box">
            <div id="seller"><a href="seller.php">Sellers</a></div>
            <div id="prod"><a href="products.php">Products</a></div>
            <div id="sold"><a href="sold.php">&nbsp;&nbsp;&nbsp;Sold&nbsp;&nbsp;&nbsp;</a></div>
            <div id="ltable"><a href="ltable.php">&nbsp;&nbsp;&nbsp;Live&nbsp;&nbsp;&nbsp;</a></div>
    </div>
    <footer><a href="about.php">About Me</a></footer>
</body>
</html>