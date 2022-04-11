<?php

session_start();
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    include("../../config/database.php");
    $id = $_SESSION['id'];
    $eid = $_SESSION['username'];
    $sql = "SELECT * FROM teacher WHERE eid = '$eid'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if($row = mysqli_fetch_assoc($result)){
        $name = ucfirst($row['name']);
        $course = $row['course'];
        $position =$row['position'];
    }
}
?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Admin-Creative Academic Care</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
        </head>
        <body>
        <h1 align="center" style="color: #0AF33B "><?php echo 'Admin Panel' ?></h1>
        <div class="header">

            <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776; </span>

            <div class="header-right">
                <a href="profile.php">
                    <?php echo $name ." (" . strtoupper($eid) . ")" ?></a>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php" class="logo"><span style="color: #0AF33B;font-size:30px">Coaching Managment</span></a>
            <a href="profile.php"><?php echo $name ." (" . strtoupper($eid) . ")" ?></a>
            <a href="index.php">Home</a>
            <a href="student.php">Student</a>
            <a href="teachers.php">Teachers</a>
            <a href="teachersattendance.php">Teachers Attendance</a>
            <a href="add.php">Add Time & batch</a>
            <a href="update_password.php">Update Password</a>
            <a href="../../logout.php">Logout</a>
        </div>

        <div align="center">
            <table cellpadding="10px">
                <tr>
                    <?php
                    $sql_find_batch = "SELECT count(batch) AS total_batch FROM batch WHERE course='$course'";
                    $sql_find_batch_get=mysqli_query($conn,$sql_find_batch);
                    $sql_find_batch_total = mysqli_fetch_assoc($sql_find_batch_get);
                    ?>
                    <th>
                        <div style="background-color: #0AF33B; color: white; padding-left:60px;padding-right: 60px;padding-bottom: 20px;padding-top: 20px;"><h2>Total Batches</h2><p><?php echo $sql_find_batch_total['total_batch'];?></p>
                        </div>
                    </th>

                    <?php
                    $sql_find_sid = "SELECT count(sid) AS total_sid FROM students WHERE course='$course'";
                    $sql_find_sid_get=mysqli_query($conn,$sql_find_sid);
                    $sql_find_sid_total = mysqli_fetch_assoc($sql_find_sid_get);
                    ?>
                    <th><div style="background-color:#18E0ED; color:white; padding-left:60px;padding-right: 60px;padding-bottom: 20px;padding-top: 20px;"><h2>Total Students</h2><p><?php echo $sql_find_sid_total['total_sid'];?></p></div></th>
                    
                    <?php
                    $sql_find_teacher = "SELECT count(eid) AS total_teacher FROM teacher WHERE  course='$course' AND position = 'teacher'";
                    $sql_find_teacher_get=mysqli_query($conn,$sql_find_teacher);
                    $sql_find_teacher_total = mysqli_fetch_assoc($sql_find_teacher_get);
                    ?>
                    <th><div style="background-color: #ED1976; color: white; padding-left:60px;padding-right: 60px;padding-bottom: 20px;padding-top: 20px;"><h2>Total Teachers</h2><p><?php echo $sql_find_teacher_total['total_teacher']?></p></div></th>

                </tr>
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