<?php
/**
 * Created by PhpStorm.
 
 */


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
        
        <div class="header">

            <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776;</span>

            <div class="header-right">
                <a href="profile.php">
                    <?php echo $name .  " (" . strtoupper($eid) . ")" ?></a>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php" class="logo"><span style="color:red;font-size:70px">CAC</span></a>
            <a href="profile.php"><?php echo $name . " (" . strtoupper($eid) . ")" ?></a>
            <a href="index.php">Home</a>
            <a href="student.php">Student</a>
            <a href="teachers.php">Teachers</a>
            <a href="teachersattendance.php">Teachers Attendance</a>
            <a href="add.php">Add TimeTable/batch</a>
            <a href="update_password.php">Update Password</a>
            <a href="../../logout.php">Logout</a>
        </div>


        <div align="center">
            <h4>Update Password</h4>
            <hr>
            <form  method="post">
                <table>
                    <tr>
                        <td> <b>Old Password: </b></td>
                        <td><input type="password" name="oldpassword" placeholder="Enter Old Password" required></td>
                    </tr>
                    <tr>
                        <td><b>New Password: </b></td>
                        <td><input type="password" name="newpassword_one" placeholder="Enter New Password" required></td>
                    </tr>
                    <tr>
                        <td><b>New Password Again: </b></td>
                        <td><input type="password" name="newpassword_again" placeholder="Enter New Password Again" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="changepassword" value="Change Password"></td>
                    </tr>
                </table>

            </form>
        </div>

        <?php
        if(isset($_POST['changepassword'])){
            $get_old_password=$_POST['oldpassword'];
            $get_new_password=$_POST['newpassword_one'];
            $get_new_password_again=$_POST['newpassword_again'];

            $searvh_pass = "SELECT * FROM users WHERE username='$eid' AND password='$get_old_password'";
            $searvh_pass_get = mysqli_query($conn,$searvh_pass);
            $searvh_pass_check = mysqli_num_rows($searvh_pass_get);
            if($searvh_pass_check > 0){
                if($get_new_password===$get_new_password_again){
                    $update_users = "UPDATE users SET password='$get_new_password' WHERE username='$eid' AND type='admin'";
                    $update_users_q = mysqli_query($conn,$update_users);
                    if($update_users_q){
                        echo '<script>alert("Password Update Success")</script>';
                    }else{
                        echo '<script>alert("SomeThing Went Wrong. Try Again after some time")</script>';
                    }
                }else{
                    echo '<p align="center" style="color: red">*password and confirm password does not match</p>';
                }
            }else{
                echo '<p align="center" style="color: red">*old password is wrong</p>';
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
       