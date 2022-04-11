<?php

session_start();
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    include("../../../config/database.php");
    $id = $_SESSION['id'];
    $eid = $_SESSION['username'];
    $sql = "SELECT * FROM teacher WHERE eid = '$eid'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if ($row = mysqli_fetch_assoc($result)) {
        $name = ucfirst($row['name']);
        $course = $row['course'];
    }
    $ydate = date('Y-m-d');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Attendance-Teachers-Creative Academic Care</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <h2 align="center" style="color: blue">Teacher's Attendance</h2>
    <div class="header">

        <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776;</span>

        <div class="header-right">
            <a href="profile.php">
                <?php echo $name. " (" . strtoupper($eid) . ")" ?></a>
        </div>
    </div>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php" class="logo"><span style="color:red;font-size:70px">CAC</span></a>
        <a href="profile.php"><?php echo $name ." (" . strtoupper($eid) . ")" ?></a>
        <a href="index.php">Home</a>
        <a href="attendance.php">Attendance</a>
        <a href="search.php">Search Student Information</a>
        <a href="update_password.php">Update Password</a>
        <a href="../../../logout.php">Logout</a>
    </div>
    <div align="center" style="padding: 8px">

        <?php
        if (isset($_POST['submit'])) {
            $ydate = $_POST['date'];

        }
        $timestamp = strtotime($ydate);

        $day = date('l', $timestamp);
        ?>
        <form action="attendance.php" method="post">
            <h3>Choose date (mm/dd/yyyy)</h3>
            <input type="date" name="date" value="<?php echo $ydate; ?>">
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
    <div style="padding-left:20px; float: left;border-left: 6px solid red;background-color: lightgrey;width: 100%">
        <h1 align="center">Attendance - <span style="color: blue"><?php echo $name?></span></h1>
        <p align="center"><?php echo $ydate; ?> (<?php echo $day; ?>)</p>

        <table border="2" align="center" cellpadding="5px">
            <tr>
                <th>S.NO.</th>
                <th>Time To Come</th>
                <th>Time To Go</th>
                <th>Status</th>
                <th>By</th>
                <th>By (EID)</th>
            </tr>
            <?php
            $sqli = "SELECT * FROM tea_attendance WHERE eid = '$eid' AND course = '$course' AND date = '$ydate'";
            $resulti = mysqli_query($conn, $sqli);
            $resultchecki = mysqli_num_rows($resulti);
            $i = 0;
            while ($rows = mysqli_fetch_assoc($resulti)) {
                $i++;
                $timetocome = $rows['timetocome'];
                $timetogo = $rows['timetogo'];
                $status = $rows['status'];
                $bid = $rows['bywhom'];
                if ($status == 'p' OR $status == 'P') {
                    $status = "Present";
                    $color = "#d3d3d3";
                    $textcolor = "green";
                } else if ($status == 'a' OR $status == 'A') {
                    $status = "Absent";
                    $color = "red";
                    $textcolor = "white";
                }
                $sql_teacher = "SELECT * FROM teacher WHERE eid = '$bid'";
                $sql_result = mysqli_query($conn, $sql_teacher);
                $sql_result_teacher = mysqli_num_rows($sql_result);
                while ($rowsn = mysqli_fetch_assoc($sql_result)) {
                    $teachername = $rowsn['name'];
                }

                ?>
                <tr style="background-color:<?php echo $color; ?>;color: <?php echo $textcolor; ?>">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $timetocome; ?></td>
                    <td><?php echo $timetogo; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $teachername  ?></td>
                    <td><?php echo ucfirst($bid); ?></td>
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
        input[type=date]{
            width: 30%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

    </style>

    </body>
    </html>
    <?php
}else{
    header("Location: ../../../index.php");
}
