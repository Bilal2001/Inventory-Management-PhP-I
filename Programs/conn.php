<?php
    function OpenCon()
    {
        $dbuser = "root";
        $dbpass = "";
        $db = "inventorymanage";
        $conn = new mysqli('localhost',$dbuser, $dbpass, $db);
        
        return $conn;
    }
    function CloseCon($conn)
    {
        $conn -> close();
    }

    function registerSeller($con, $prod, $fname, $mname, $lname, $email, $pno, $prregis, $dtime) {
        // insert into vendor values
        $queryIn = "INSERT INTO `vendor`(`First Name`, `Middle Name`, `Last Name`, `Email`, `Phone Number`, `Products Registered`, `DateTime`) VALUES ('$fname', '$mname', '$lname', '$email', '$pno', '$prregis', '$dtime');";
        // if query runs add (vid and pid to Registered Table)
        if(mysqli_query($con, $queryIn)) {
            $_idV = $con->query("SELECT ID FROM `vendor` WHERE email = '$email'")->fetch_assoc()['ID'];
            foreach($prod as $i) {
                $querySe = "SELECT ID FROM products WHERE NAME = '$i'";
                $_idP = $con->query($querySe)->fetch_assoc()['ID'];
                $insertR = "INSERT INTO registered(`VID`, `PID`) VALUES ('$_idV', '$_idP')";
                mysqli_query($con, $insertR);
            }
        }else {
            return;
        }
    }

    function addProd($con, $name, $price, $desc) {
        if($desc == "") {
            $queryInP = "INSERT INTO `products`(`Name`, `Price`) VALUES ('$name', '$price')";    
        }else {
            // insert into vendor values
            $queryInP = "INSERT INTO `products`(`Name`, `Price`, `Description`) VALUES ('$name', '$price', '$desc')";
        }
        
        // if query doesnt run exit
        if(mysqli_query($con, $queryInP)) {
            NULL;
        }else {
            return;
        }
    }

    function sellStock($con, $name, $prod, $quantity, $oldQ, $desc, $datetime) {
        if($desc == "") {
            $queryInP = "INSERT INTO `sold`(`Name`, `PID`, `Quantity`, `DateTime`) VALUES ('$name', '$prod', '$quantity', '$datetime')";    
        }else {
            // insert into vendor values when desc is not null
            $queryInP = "INSERT INTO `sold`(`Name`, `PID`, `Quantity`, `Description`, `DateTime`) VALUES ('$name', '$prod', '$quantity', '$desc', '$datetime')";
        }

        // if query doesnt run exit
        if(mysqli_query($con, $queryInP)) {
            $queryLUp = "UPDATE `liveproducts` SET `Quantity` = '".($oldQ - $quantity)."' WHERE `liveproducts`.`PID` = '".$prod."'";
            if(mysqli_query($con, $queryLUp)) {
                NULL;
            }else {
                return;
            }
        }else {
            return;
        }
    }
?>