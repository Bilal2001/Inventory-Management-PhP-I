<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers</title>
    <link rel="stylesheet" href="../style/sellerRegis.css">
</head>
<body>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="home.php">Home</a></nav>
    </div>
    <div class="main-box">
        <div class="headings"><h3 style="margin-left:5px; color: orange; border-bottom: 2px solid orange;">Adding Product</h3></div>
        <br>
        <div>
            <form action="products.php" method="post">
                <div class="form">
                    <div><h4>Name : <input type="text" name="name" placeholder=" Product Name" required></h4></div>
                    <div><h4>Price : <input type="number" name="price" placeholder=" Price" required></h4></div>
                    <div><h4>Description : <textarea name="desc" cols="40" rows="6" placeholder=" Description..." maxlength=200 style="resize:none"></textarea></h4></div>
                    <input class="button" type="submit" style="background:#ff4756;  border: 2px solid black; border-radius: 50px; width: fit-content; align-self: center;">
                </div>
            </form>
         </div>
    </div>
    <div class="footer" style="position:fixed"><a href="about.php">About Me</a></div>
</body>
</html>