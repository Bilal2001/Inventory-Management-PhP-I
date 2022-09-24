<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sellers</title>
    <link rel="stylesheet" href="style/seller.css">
</head>
<body>
    <?php
        include "conn.php";
        $con = OpenCon();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $con) {
        // collect value of input field
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $pno = $_POST['pno'];
            $prregis = $_POST['pregis'];
            $dtime = new DateTime($_POST['datetime']);
            $currentDateTime = date('Y-m-d');
            if (!empty($_POST['prod']) && count($_POST['prod']) == $prregis && strlen((string)$pno) == 10 && $currentDateTime == $dtime->format("Y-m-d")) {
                registerSeller($con, $_POST['prod'], $fname, $mname, $lname, $email, $pno, $prregis, $_POST['datetime']);
            }
        }
    ?>
    <div id="top">
        <header><p>Inventory++</p></header>
        <nav><a href="index.php">Home</a></nav>
        <div class="headings"><h3>Sellers</h3></div>
    </div>
    <div class="main-box">
        <br>
        <div>
            <table>
                <tr>
                    <th>SNo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Number of Products</th>
                    <th>Product List</th>
                </tr>
                <?php
                    if($con) {
                        $q = "SELECT `ID`, `First Name`,`Middle Name`,`Last Name`,Email,`Phone Number`,`Products Registered` from vendor";
                        $res = $con->query($q);
                        
                        if($res->num_rows > 0) {
                            $i = 1;
                            while($row = $res->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row["First Name"]." ".$row["Middle Name"]." ".$row["Last Name"]."</td>";
                                echo "<td>".$row["Email"]."</td>";
                                echo "<td>".$row["Phone Number"]."</td>";
                                echo "<td>".$row["Products Registered"]."</td>";
                                $getProd = "SELECT P.`Name` AS `Name` FROM products AS P, registered AS R WHERE R.PID = P.ID AND R.VID = '".$row["ID"]."'";
                                $resP = $con->query($getProd);
                                echo "<td>";
                                if($resP->num_rows >= 0) {
                                    while($rowP = $resP->fetch_assoc()) {
                                        echo "".$rowP["Name"]."  ";
                                    }
                                }else {
                                    echo "No Products Registered";
                                }
                                echo "</td>";
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
            <form action="sellerRegis.php">
                <input class="button" type="submit" name="register" value="Register New Seller">
            </form>
         </div>
    </div>
    <footer><a href="about.php">About Me</a></footer>
</body>
</html>