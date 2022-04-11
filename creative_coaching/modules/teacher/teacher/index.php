<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    include("../../../config/database.php");
    $id = $_SESSION['id'];
    $eid = $_SESSION['username'];
    $sql = "SELECT * FROM teacher WHERE eid = '$eid'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if($row = mysqli_fetch_assoc($result)){
        $name = ucfirst($row['name']);
        $course = $row['course'];
    }
}

?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Teachers-Creative Academic Care</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
        </head>
        <body>
        <h2 align="center" style="color: blue">Teacher's Dashboard</h2>
        <div class="header">

            <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776;</span>

            <div class="header-right">
                <a href="profile.php">
                    <?php echo $name . " (" . strtoupper($eid) . ")" ?></a>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php" class="logo"><span style="color:red;font-size:70px">CAC</span></a>
            <a href="profile.php"><?php echo $name . " (" . strtoupper($eid) . ")" ?></a>
            <a href="index.php">Home</a>
            <a href="attendance.php">Attendance</a>
            <a href="search.php">Search Student Information</a>
            <a href="update_password.php">Update Password</a>
            <a href="../../../logout.php">Logout</a>
        </div>
        <div style="padding-left:20px; float: left;border-left: 6px solid red;background-color: lightgrey;width: 50%">
            <h1 align="center">Time Table</h1>
            
            <table border="2" align="center" cellpadding="5px">
                <tr>
                   
                    <th>Timing</th>
                    <th>Subject name</th>
                    <th>Batch</th>
                    <th>Day</th>
                </tr>

                <?php
                
                $sql_time = "SELECT * FROM timetable WHERE course = '$course' AND eid = '$eid'";
                $sql_time_result = mysqli_query($conn, $sql_time);
                $sql_time_result_check = mysqli_num_rows($sql_time_result);
                $j = 0;
                while ($rown = mysqli_fetch_assoc($sql_time_result)){
                $j++;
                $time = $rown['timing'];
                $subject = $rown['subject'];
                $batch = $rown['batch'];
                $day = $rown['day'];

                $sql_find_mentor = "SELECT * from batch WHERE batch = '$batch'";
                $sql_find_mentor_result = mysqli_query($conn,$sql_find_mentor);
                $sql_find_mentor_result_check = mysqli_num_rows($sql_find_mentor_result);
                if($sql_find_mentor_result_check>0){
                   if($rowm = mysqli_fetch_assoc($sql_find_mentor_result)){
                       $mentorid = $rowm['teacher'];
                   }
                }


                ?>
                <tr>
                   
                    <td><?php echo $time; ?></td>
                    <td><?php echo $subject ?></td>
                    <td><?php echo $batch; ?></td>
                    <td><?php echo $day ?></td>

                    <?php } ?>

            </table>
        </div>
        <div style="padding-left:20px; float: left;border-left: 6px solid red;background-color: lightgrey;width: 50%">
            <h1 align="center">Attendance</h1>
            <p align="center">Yesterday's Attendane<br>(<?php $ydate = date('Y-m-d', strtotime("-1 days"));
                echo date('d-m-Y', strtotime("-1 days")); ?>) </p>

            <table border="2" align="center" cellpadding="5px">
                <tr>
                    
                    <th>Time To Come</th>
                    <th>Time To Go</th>
                    <th>Status</th>
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
                        $textcolor="black";
                    } else if ($status == 'a' OR $status == 'A') {
                        $status = "Absent";
                        $color = "red";
                        $textcolor="white";
                    }
                    $sql_teacher = "SELECT * FROM teacher WHERE eid = '$bid'";
                    $sql_result = mysqli_query($conn, $sql_teacher);
                    $sql_result_teacher = mysqli_num_rows($sql_result);
                    while ($rowsn = mysqli_fetch_assoc($sql_result)) {
                        $teachername = $rowsn['name'];

                    }

                    ?>
                    <tr style="background-color:<?php echo $color; ?>;color: <?php echo $textcolor; ?>">
                        
                        <td><?php echo $timetocome; ?></td>
                        <td><?php echo $timetogo; ?></td>
                        <td><?php echo $status; ?></td>
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
        </body>
        </html>
        