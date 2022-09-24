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
    <?php
        include "conn.php";
        $con = OpenCon();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $con) {
        // collect value of input field
            $name = $_POST['name'];
            $prod = $_POST['prodID'];
            $quantity = $_POST['quantity'];
            $desc = $_POST['desc'];
            $dtime = new DateTime($_POST['datetime']);
            $currentDateTime = date('Y-m-d');
            $queryC = "SELECT `Quantity` FROM liveproducts WHERE `PID` = '".$prod."'";
            $res = $con->query($queryC);
            $qold = $res->fetch_assoc()["Quantity"];
            
            if ($quantity <= $qold && $currentDateTime == $dtime->format("Y-m-d")) {
                sellStock($con, $name, $prod, $quantity, $qold, $desc, $_POST['datetime']);
            }
        }
    ?>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="index.php">Home</a></nav>
        <div class="headings"><h3 style="margin-left:5px; color: rgba(165, 42, 42, 0.61); border-bottom: 2px solid rgba(165, 42, 42, 0.61);">Stock Out</h3></div>
    </div>
    <div class="main-box">
        <br>
        <div>
            <table>
                <tr>
                    <th>SNo</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Returned</th>
                    <th>Total Amount</th>
                </tr>
                <?php
                    if($con) {
                        $q = "SELECT S.`Name` as Sname, P.`Name` as Pname, S.`Quantity`, S.`Description`, S.`Returned`, P.`Price` from products as P, sold as S where P.ID = S.PID";
                        $res = $con->query($q);
                        if($res->num_rows > 0) {
                            $i = 1;
                            while($row = $res->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row["Sname"]."</td>";
                                echo "<td>".$row["Pname"]."</td>";
                                echo "<td>".$row["Price"]."</td>";
                                echo "<td>".$row["Quantity"]."</td>";
                                echo "<td>".$row["Description"]."</td>";
                                echo "<td>".$row["Returned"]."</td>";
                                echo "<td>".($row["Price"] * $row["Quantity"])."</td>";
                                echo "</tr>";
                                $i++;
                            }
                        }
                    }else {
                        echo "Connect failed: ". $con -> error;
                    }
                    ?>
            </table>
        </div>
        <br>
        <div>
            <form action="stockOutAdd.php">
                <input class="button" type="submit" name="register" value="Sell Stock">
            </form>
         </div>
    </div>
    <footer><a href="about.php">About Me</a></footer>
</body>
</html>