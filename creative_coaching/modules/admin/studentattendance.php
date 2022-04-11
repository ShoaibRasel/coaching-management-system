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
        $name= ucfirst($row['name']);
        $course = $row['course'];
     }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin-Creative Academic Care</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .linking{
            background-color: #ddffff;
            padding: 7px;
            text-decoration: none;
        }
        .linking:hover{
            background-color: blue;
            color: white;
        }

        input,button,select{
            padding: 5px;
            border: 2px solid blue;
            border-radius: 10px;
            margin: 2px;
        }
        input[type=submit],button{
            width: 100px;
        }
        input:hover{
            background-color: lightblue;
        }
        input[type=submit]:hover{
            background-color: green;
            color: white;
        }

    </style>
</head>
<body>
<h2 align="center" style="color: blue">Student's Attedance</h2>
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
    <a href="student.php">Student</a>
    <a href="studentattendance.php">Student Attendance</a>
    <a href="teachers.php">Teachers</a>
    <a href="teachersattendance.php">Teachers Attendance</a>
    <a href="add.php">Add TimeTable/batch</a>
    <a href="update_password.php">Update Password</a>
    <a href="../../logout.php">Logout</a>
</div>
<div align="center">
    <form method="post">
        <h4>Update Student Attendance</h4>
        SID: <input type="text" name="stid" placeholder="Enter Student ID(SID)" required>
       Date Of attendance: <input type="date" name="dateofatt" required><br>
        <input type="submit" name="search">
    </form>
</div>
    <?php if(isset($_POST['search'])){ ?>
<div align="center">
    <h3>Update Student Attendance for <span style="color: blue"><?php echo $_POST['stid'];?></span></h3>
    <table border="2px" cellpadding="10px">
        <tr>
            <th>Subject</th>
            <th>Status</th>
            <th>SID</th>
        </tr>
        <?php
            $sid_get = mysqli_real_escape_string($conn,$_POST['stid']);
            $st_get_date = $_POST['dateofatt'];
            $get_attendance = "SELECT * FROM attendance WHERE sid='$sid_get' AND date='$st_get_date' AND course='$course'";
            $get_attendance_check = mysqli_query($conn,$get_attendance);
            while($get_attendance_rows=mysqli_fetch_assoc($get_attendance_check)){ ?>
                <tr>
                    <td><?php echo $get_attendance_rows['subject']; ?></td>
                    <td><?php echo $get_attendance_rows['status']; ?></td>
                    <td><?php echo $get_attendance_rows['eid']; ?></td>
                    <td><a href="studentattendance.php?attendanceid=<?php echo $get_attendance_rows['id']; ?>">Update</a></td>
                </tr>
            <?php }
        }
        ?>

    </table>
</div>

<?php
    if(isset($_GET['attendanceid'])){
        $get_stid = (int)$_GET['attendanceid'];
        $sql_get_details = "SELECT * FROM attendance WHERE id='$get_stid' AND course='$course'";
        $sql_get_details_check = mysqli_query($conn,$sql_get_details);
        $war = mysqli_fetch_assoc($sql_get_details_check);?>
        <div align="center">
            <table border="2px" cellpadding="10px">
                <tr>
                    <th>subject</th>
                    <th>Eid</th>
                    <th>Previous Status</th>
                    <th>New Status</th>
                    <th colspan="2">Upadate/Cancel</th>
                </tr>
                <tr>
                    <td><?php echo $war['subject']?></td>
                    <td><?php echo $war['eid']?></td>
                    <td align="center"><?php echo $war['status']?></td>
                    <form method="post">
                    <td>
                        <select name="updatestatus">
                            <option value="p">Present</option>
                            <option value="a">Absent</option>
                        </select>
                    </td>
                        <td><input type="submit" name="update"></td>
                    </form>
                    <td><a href="studentattendance.php">Cancel Update</a> </td>
                </tr>
            </table>
        </div>

    <?php
        if(isset($_POST['update'])){
            $newstatus = mysqli_real_escape_string($conn,$_POST['updatestatus']);
            $sql_updat_status = "UPDATE attendance SET status='$newstatus' WHERE id='$get_stid' AND course='$course'";
            $sql_updat_status_query = mysqli_query($conn,$sql_updat_status);
            if($sql_updat_status_query){
                echo '<script>alert("Successfully done")</script>';
                echo '<script>location.href="studentattendance.php"</script>';
            }else{
                echo '<script>alert("Failed Try Again")</script>';
                echo '<script>location.href="studentattendance.php"</script>';
            }
        }
    }
?>
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