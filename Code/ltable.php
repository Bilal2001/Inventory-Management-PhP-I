<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory++</title>
    <link rel="stylesheet" href="../style/seller.css">
</head>
<body>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="../index.php">Home</a></nav>
        <div class="headings"><h3 style="margin-left:5px; color: red; border-bottom: 2px solid red;">Live Products</h3></div>
    </div>
    <div class="main-box">
        <br>
        <div>
            <table>
                <tr>
                    <th>SNo</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Description</th>
                </tr>
                <?php
                    include "conn.php";
                    $con = OpenCon();
                    if($con) {
                        $q = "SELECT P.`Name`, L.`Quantity`, P.`Description` from products as P, liveproducts as L where P.ID = L.PID";
                        $res = $con->query($q);
                        if($res->num_rows > 0) {
                            $i = 1;
                            while($row = $res->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row["Name"]."</td>";
                                echo "<td>".$row["Quantity"]."</td>";
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
    </div>
    <footer><a href="about.php">About Me</a></footer>
</body>
</html>