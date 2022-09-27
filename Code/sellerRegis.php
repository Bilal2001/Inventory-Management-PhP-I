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
        <div class="headings"><h3>Seller Registration</h3></div>
        <br>
        <div>
            <form action="seller.php" method="post">
                <div class="form">
                    <div><h4>First Name : <input type="text" name="fname" placeholder="First Name" required></h4></div>
                    <div><h4>Middle Name : <input type="text" name="mname" placeholder="Middle Name"></h4></div>
                    <div><h4>Last Name : <input type="text" name="lname" placeholder="Last Name"></h4></div>
                    <div><h4>Email : <input type="email" name="email" placeholder="Email" required></h4></div>
                    <div><h4>Mobile Number : <input type="number" name="pno" placeholder="Mobile Number" required></h4></div>
                    <div><h4>Number of Products : <input type="number" name="pregis" placeholder="Number of Products" required></h4></div>
                    <div><h4 style="color:white">Select The Products:</h4></div>
                    <?php
                        include "conn.php";
                        $con = OpenCon();
                        if($con) {
                            $q = "SELECT Name from products";
                            $res = $con->query($q);
                            if($res->num_rows > 0) {
                                while($row = $res->fetch_assoc()) {
                                    $nameP = $row["Name"];
                                    echo "<div><h4 style=\"color:white\">".$nameP." : <input type=\"checkbox\" name=\"prod[]\" value=".$nameP."></h4></div>";
                                }
                            }
                        }else {
                            echo "Connect failed: ". $con -> error;
                        }
                    ?>
                    
                    <div><h4>Today : <input type="datetime-local" name="datetime" required></h4></div>
                    <input class="button" type="submit" style="background:#ff4756;  border: 2px solid black; border-radius: 50px; width: fit-content; align-self: center;">
                </div>
            </form>
         </div>
    </div>
    <div class="footer"><a href="about.php">About Me</a></div>
</body>
</html>