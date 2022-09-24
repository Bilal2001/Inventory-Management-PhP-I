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
        if($_SERVER["REQUEST_METHOD"] == "POST" && $con) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $desc = $_POST['desc'];
            addProd($con, $name, $price, $desc);
        }
    ?>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="index.php">Home</a></nav>
        <div class="headings"><h3 style="margin-left:5px; color: orange; border-bottom: 2px solid orange;">Products</h3></div>
    </div>
    <div class="main-box">
        <br>
        <div>
            <table>
                <tr>
                    <th>SNo</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
                <?php
                    if($con) {
                        $q = "SELECT `Name`,`Price`,`Description` from products";
                        $res = $con->query($q);
                        if($res->num_rows > 0) {
                            $i = 1;
                            while($row = $res->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row["Name"]."</td>";
                                echo "<td>".$row["Price"]."</td>";
                                echo "<td>".$row["Description"]."</td>";
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
            <form action="prodAdd.php">
                <input class="button" type="submit" name="register" value="Add New Product">
            </form>
         </div>
    </div>
    <footer><a href="about.php">About Me</a></footer>
</body>
</html>