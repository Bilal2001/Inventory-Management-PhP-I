<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory++</title>
    <link rel="stylesheet" href="style/seller.css">
</head>
<body>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="index.php">Home</a></nav>
    </div>
    <div id="main-box"style=" margin-left: 5%;margin-top: 10%;">
            <div><h1 style="color: rgb(29, 75, 115);">Are you using this code for the first time?</h1></div>
            <div>
                <form action="Code/home.php" method="post">
                    <div class="form">
                        <div><h4>Yes : <input type="radio" name="question" value="yes" required></h4></div>
                        <div><h4>No : <input type="radio" name="question" value="no" required></h4></div>
                        <input class="button" type="submit" style="background:#ff4756;  border: 2px solid black; border-radius: 50px; width: fit-content; align-self: center;">
                    </div>
                </form>
            </div>
    </div>
    <footer><a href="index.php">About Me</a></footer>
</body>
</html>