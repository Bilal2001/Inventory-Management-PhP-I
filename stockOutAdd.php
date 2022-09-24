<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers</title>
    <link rel="stylesheet" href="style/sellerRegis.css">
</head>
<body>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="index.php">Home</a></nav>
    </div>
    <div class="main-box">
        <div class="headings"><h3 style="margin-left:5px; color: rgba(165, 42, 42, 0.61); border-bottom: 2px solid rgba(165, 42, 42, 0.61);">Adding Stock Out Entry</h3></div>
        <br>
        <div>
            <form action="sold.php" method="post">
                <div class="form">
                    <div><h4>Name of Buyer : <input type="text" name="name" placeholder=" Name" required></h4></div>
                    <div><h4 style="color:orange">Select The Product:</h4></div>
                    <?php
                        include "conn.php";
                        $con = OpenCon();
                        if($con) {
                            $q = "SELECT P.ID as `ID`, P.Name, L.quantity from products as P, liveproducts as L where P.ID = L.ID and L.quantity > 0";
                            $res = $con->query($q);
                            if($res->num_rows > 0) {
                                while($row = $res->fetch_assoc()) {
                                    echo "<div><h4 style=\"color:white\">".$row["Name"]." ( ".$row["quantity"]." ): <input type=\"radio\" name=\"prodID\" value=".$row["ID"]." required></h4></div>";
                                }
                            }
                        }else {
                            echo "Connect failed: ". $con -> error;
                        }
                    ?>
                    <div><h4>Quantity : <input type="number" name="quantity" placeholder=" Quantity" required></h4></div>
                    <div><h4>Description : <textarea name="desc" cols="40" rows="6" placeholder=" Description..." maxlength=200 style="resize:none"></textarea></h4></div>
                    <div><h4>Today : <input type="datetime-local" name="datetime" required></h4></div>
                    <input class="button" type="submit" style="background:#ff4756;  border: 2px solid black; border-radius: 50px; width: fit-content; align-self: center;">
                </div>
            </form>
         </div>
    </div>
    <div class="footer"><a href="about.php">About Me</a></div>
</body>
</html>