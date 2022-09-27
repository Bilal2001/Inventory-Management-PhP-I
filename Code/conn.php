<?php
    $dbuser = "root";
    $dbpass = "";
    $db = "inventorymanage";
    function OpenCon()
    {
        $conn = new mysqli('localhost', $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['db']);
        
        return $conn;
    }
    function CloseCon($conn)
    {
        $conn -> close();
    }


    function firstTime() {
        $con = new mysqli('localhost', $GLOBALS['dbuser'], $GLOBALS['dbpass']);
        if ($con->connect_error) {
            echo "NOOOCONNECTED <br>";
            die("Connection failed: " . $con->connect_error);
        } 


        $checkDB = "SHOW DATABASES LIKE 'inventorymanage101'";
        $resDB = $con->query($checkDB);
        if($resDB->num_rows == 0) {
            //create database
            $first = "CREATE DATABASE `inventorymanage101` /*!40100 DEFAULT CHARACTER SET utf8mb4 */";
            if(mysqli_query($con, $first)) {
                NULL;
            }
        }
        
        $con = new mysqli('localhost', $GLOBALS['dbuser'], $GLOBALS['dbpass'], 'inventorymanage101');
        
        $checkP = "SHOW TABLES LIKE 'products'";
        $resP = $con->query($checkP);
        if($resP->num_rows == 0) {
            //create database
            $prodCreate = "CREATE TABLE `products` (`ID` int(5) NOT NULL AUTO_INCREMENT,`Name` varchar(50) NOT NULL,`Price` decimal(10,0) NOT NULL DEFAULT 0,`Description` varchar(255) DEFAULT 'No Description',PRIMARY KEY (`ID`),UNIQUE KEY `Name` (`Name`)) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4";
            if(mysqli_query($con, $prodCreate)) {
                addProd($con, "Keyboard", 550, "Mechanical QWERTY Keyboard");
                addProd($con, "Mouse", 300, "");
            }
        }

        $checkP = "SHOW TABLES LIKE 'vendor'";
        $resP = $con->query($checkP);
        if($resP->num_rows == 0) {
            //create database
            $prodCreate = "CREATE TABLE `vendor` (`ID` int(5) NOT NULL AUTO_INCREMENT,`First Name` varchar(30) NOT NULL,`Middle Name` varchar(30) DEFAULT NULL,`Last Name` varchar(30) DEFAULT NULL,`Email` varchar(60) NOT NULL,`Phone Number` varchar(10) NOT NULL,`Products Registered` int(2) NOT NULL DEFAULT 0,`DateTime` datetime NOT NULL DEFAULT current_timestamp(),PRIMARY KEY (`ID`),UNIQUE KEY `Email` (`Email`),UNIQUE KEY `Phone Number` (`Phone Number`)) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4";
            if(mysqli_query($con, $prodCreate)) {
                NULL;
            }
        }

        $checkR = "SHOW TABLES LIKE 'registered'";
        $resR = $con->query($checkR);
        if($resR->num_rows == 0) {
            //create database
            $regisCreate = "CREATE TABLE `registered` (`ID` int(11) NOT NULL AUTO_INCREMENT,`VID` int(11) NOT NULL,`PID` int(11) NOT NULL,PRIMARY KEY (`ID`),KEY `fkp` (`PID`),KEY `fkv` (`VID`),CONSTRAINT `fkp` FOREIGN KEY (`PID`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,CONSTRAINT `fkv` FOREIGN KEY (`VID`) REFERENCES `vendor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4";
            if(mysqli_query($con, $regisCreate)) {
                NULL;
            }
        }

        $checkS = "SHOW TABLES LIKE 'sold'";
        $resS = $con->query($checkS);
        if($resS->num_rows == 0) {
            //create database
            $soldCreate = "CREATE TABLE `sold` (`ID` int(5) NOT NULL AUTO_INCREMENT,`Name` varchar(50) NOT NULL,`PID` int(5) NOT NULL,`Quantity` int(5) NOT NULL,`Description` varchar(60) DEFAULT 'No Description',`Returned` int(1) NOT NULL DEFAULT 0,`DateTime` datetime(2) NOT NULL DEFAULT current_timestamp(2),PRIMARY KEY (`ID`),KEY `sfkp` (`PID`),CONSTRAINT `sfkp` FOREIGN KEY (`PID`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4";
            if(mysqli_query($con, $soldCreate)) {
                NULL;
            }
        }
        
        $checkL = "SHOW TABLES LIKE 'liveproducts'";
        $resL = $con->query($checkL);
        if($resL->num_rows == 0) {
            //create database
            $liveCreate = "CREATE TABLE `liveproducts` (`ID` int(11) NOT NULL AUTO_INCREMENT,`PID` int(11) NOT NULL,`Quantity` int(11) NOT NULL,PRIMARY KEY (`ID`),KEY `lfkp` (`PID`),CONSTRAINT `lfkp` FOREIGN KEY (`PID`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4";
            if(mysqli_query($con, $liveCreate)) {
                NULL;
            }
        }
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
            $queryInP = "INSERT INTO `sold`(`Name`, `PID`, `Quantity`, `Description`, `DateTime`) VALUES (\"$name\", \"$prod\", \"$quantity\", \"$desc\", \"$datetime\")";
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