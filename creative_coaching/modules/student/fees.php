<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    include("../../config/database.php");
    $id = $_SESSION['id'];
    $sid = $_SESSION['username'];
    $sql = "SELECT * FROM students WHERE sid = '$sid'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if ($row = mysqli_fetch_assoc($result)) {
        $name = ucfirst($row['name']);
        $course = $row['course'];
        $batch = $row['batch'];
    }
    $ydate = date('Y-m-d');
    $day = date("l");
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Students Fees-Creaive Academic Care</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <h2 align="center" style="color: blue">Student's Fees</h2>
    <div class="header">

        <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776; </span>

        <div class="header-right">
            <a href="profile.php">
                <?php echo $name ." (" . strtoupper($sid) . ")" ?></a>
        </div>
    </div>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php" class="logo"><span style="color:red;font-size:70px">CAC</span></a>
        <a href="profile.php"><?php echo $name ." (" . strtoupper($sid) . ")" ?></a>
        <a href="index.php">Home</a>
        <a href="fees.php">Fees</a>
        <a href="password_update.php">Update Password</a>
        <a href="../../logout.php">Logout</a>
    </div>
    <div style="padding-left:20px; float: left;border-left: 6px solid red;background-color: lightgrey;width: 100%;">
        <h1 align="center">Fees - <span style="color: blue"><?php echo $name ?></span></h1>
        <table border="2" align="center" cellpadding="5px">
            <tr>
                <th>SID</th>
                <th>Course</th>
                <th>Batch</th>
                <th>Total Fees</th>
            </tr>
            <?php
                $sqli = "SELECT * FROM students WHERE sid = '$sid' AND course = '$course'  AND batch = '$batch'";
            $resulti = mysqli_query($conn, $sqli);
            $resultchecki = mysqli_num_rows($resulti);
            while ($rows = mysqli_fetch_assoc($resulti)) {
                
                $course = $rows['course'];
                $batch = $rows['batch'];
                $fees = $rows['fee'];

                ?>
                <tr align="center">
                    <td><?php echo strtoupper($sid); ?></td>
                    <td><?php echo strtoupper($course); ?></td>
                    <td><?php echo ucfirst($batch); ?></td>
                    <td><?php echo $fees; ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><button class="feepay"><a href="bkash.php">Pay Fees</a></button></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <style>
        .feepay{
            width: 200px;
            font-size: 20px;
            color: red;
            border-radius: 10px;
            border-color: green;
        }
        .feepay:hover{
            background-color: green;
            color: white;
        }
        .feepay a {
        	color : green;
        	text-decoration: none;
        }
        .feepay a:hover{
        	color: white;
        }
    </style>
    </body>
    </html>
    <?php
}else{
    header("Location: ../../index.php");
}
?>
