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
            <title>Teacher-Admin-Creative Academic Care</title>
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
        <div class="header">

            <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776; </span>

            <div class="header-right">
                <a href="profile.php">
                    <?php echo $name . " (" . strtoupper($eid) . ")" ?></a>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php" class="logo"><span style="color:red;font-size:70px">CAC</span></a>
            <a href="profile.php"><?php echo $name .  " (" . strtoupper($eid) . ")" ?></a>
            <a href="index.php">Home</a>
            <a href="student.php">Student</a>
            <a href="teachers.php">Teachers</a>
            <a href="teachersattendance.php">Teachers Attendance</a>
            <a href="add.php">Add TimeTable/batch</a>
            <a href="update_password.php">Update Password</a>
            <a href="../../logout.php">Logout</a>
        </div>
        <div align="center" style="background-color: aquamarine;padding: 10px">
            <a href="teachers.php?addteacher=true" class="linking">Add Teacher</a>
            <a href="teachers.php?updateteacher=true" class="linking">Update Teacher</a>
        </div>

        <?php if(isset($_GET['addteacher'])) {
                    $sql = "SELECT eid FROM teacher ORDER BY eid DESC LIMIT 1";
                    $sql_q = mysqli_query($conn, $sql);
                    $ro = mysqli_fetch_assoc($sql_q);
                    $eid_get_from_sql = $ro['eid'];
                    function increment($sid)
                    {
                        return ++$sid[1];
                    }

            $eid_get_from_sql = preg_replace_callback("|(\d+)|", "increment", $eid_get_from_sql);

                    ?>
                    <div align="center">
                        <h3>Add Teacher</h3>
                        <form method="post">
                            <table>
                                <tr>
                                    <td><b>EID:</b></td>
                                    <td><input type="text" name="e  id" value="<?php echo $eid_get_from_sql; ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td><b>Name:</b></td>
                                    <td><input type="text" name="name" placeholder="Name"></td>
                                </tr>
                                <tr>
                                    <td><b>Email:</b></td>
                                    <td><input type="email" name="email" placeholder="Email"></td>
                                </tr>
                                <tr>
                                    <td><b>Mobile:</b></td>
                                    <td><input type="text" name="mobile" placeholder="Mobile"><br></td>
                                </tr>
                                <tr>
                                    <td><b>Address:</b></td>
                                    <td><input type="text" name="address" placeholder="Address"></td>
                                </tr>
                                <tr>
                                    <td><b>Date Of joining:</b></td>
                                    <td><input type="date" name="dateofjoining"></td>
                                </tr>
                                <tr>
                                    <td><b>Position: </b></td>
                                    <td>
                                        <select name="position">
                                            <option value="none">Select Position</option>
                                            <option value="teacher">Teacher</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br><b>Salary:</b> </td>
                                    <td><input type="text" name="salary" placeholder="Salary Per Month"></td>
                                </tr>
                                <tr>
                                    <td><b>Course:</b></td>
                                    <td><input type="text" name="course" value="<?php echo ucfirst($course); ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td><b>Subject: </b></td>
                                    <td><input type="text" name="subject" placeholder="Enter Subject"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name="add"></td>
                                </tr>
                                
                                
                            </table>
                        </form>
                    </div>



                    <?php
                    if (isset($_POST['add'])) {
                        $te_name = $_POST['name'];
                        $te_email = $_POST['email'];
                        $te_mobile = $_POST['mobile'];
                        $te_address = $_POST['address'];

                        $te_salary = $_POST['salary'];
                        $te_dateofjoining = $_POST['dateofjoining'];
                        $te_position = $_POST['position'];
                        $te_subject = $_POST['subject'];

                        $sql_get_insert = "INSERT INTO teacher (eid, name, email, mobile, address, salary, position, course,  dateofjoining,subject) VALUES ('$eid_get_from_sql','$te_name','$te_email','$te_mobile','$te_address','$te_salary','$te_position','$course','$te_dateofjoining','$te_subject')";
                        $sql_get_insert_quary = mysqli_query($conn, $sql_get_insert);
                        $insert_into_users = "INSERT INTO users (username, password, type) VALUES ('$eid_get_from_sql','$eid_get_from_sql','teacher')";
                        $insert_into_users_check = mysqli_query($conn,$insert_into_users);
                        if ($sql_get_insert_quary AND $insert_into_users_check) {
                            echo '<script>location.href="teachers.php?res=success"</script>';
                        } else {
                            echo '<script>location.href="teachers.php?res=fail"</script>';
                        }

                    }
        }
        if(isset($_GET['updateteacher']) OR isset($_GET['teacherid'])) {
            ?>
            <div align="center">
                <form method="get">
                    Teacher Id (EID): <input type="text" name="teacherid" placeholder="Enter Teacher Id">
                    <input type="submit" name="update">
                </form>
            </div>

            <?php
            if (isset($_GET['teacherid'])) {
                $get_teacherid = mysqli_real_escape_string($conn, $_GET['teacherid']);
                if ($eid != $get_teacherid) {
                    $sql_query_search = "SELECT * FROM teacher WHERE eid='$get_teacherid' AND course='$course'";
                    $sql_query_search_result = mysqli_query($conn, $sql_query_search);
                    $sql_query_search_result_check = mysqli_num_rows($sql_query_search_result);
                    if ($sql_query_search_result_check > 0) {
                        $rowss = mysqli_fetch_assoc($sql_query_search_result);

                        if ($rowss['position'] != 'sadmin') {
                            ?>
                            <div align="center">
                                <h3>Update Details - <span style="color: blue"><?php echo $get_teacherid ?></span></h3>
                                <form method="post">
                                    <table>
                                        <tr>
                                            <td><b>EID:</b></td>
                                            <td><input type="text" name="eid" value="<?php echo $rowss['eid']; ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b>Fname:</b></td>
                                            <td><input type="text" name="name" value="<?php echo $rowss['name']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Email:</b></td>
                                            <td><input type="email" name="email" value="<?php echo $rowss['email']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Mobile:</b></td>
                                            <td><input type="text" name="mobile" value="<?php echo $rowss['mobile']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Address:</b></td>
                                            <td><input type="text" name="address" value="<?php echo $rowss['address']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Salary:</b></td>
                                            <td><input type="text" name="salary" value="<?php echo $rowss['salary']; ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b>Position:</b> </td>
                                            <td><input type="text" name="position" value="<?php echo $rowss['position']; ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b>Course:</b></td>
                                            <td><input type="text" name="course" value="<?php echo $rowss['course'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b>Date Of Joining:</b></td>
                                            <td><input type="date" name="dateofjoining" value="<?php echo $rowss['dateofjoining'] ?>" disabled></td>
                                        </tr>
                                        <tr>
                                    <td><b>Subject: </b></td>
                                    <td><input type="text" name="subject"value="<?php echo $rowss['subject'] ?>" ></td>
                                </tr>
                                        <tr>
                                            <td>
                                                <a href="teachers.php?res=fail">
                                                    <input type="submit" name="Cancel" value="Cancel">
                                                </a>
                                            </td>
                                            <td><input type="submit" name="update"></td>
                                        </tr>
                                        
                                    </table>
                                </form>

                            </div>

                            <?php
                            if (isset($_POST['update'])) {
                                $te_name = $_POST['name'];
                                $te_email = $_POST['email'];
                                $te_mobile = $_POST['mobile'];
                                $te_address = $_POST['address'];
                                $te_subject = $_POST['address'];

                                $sql_q_update = "UPDATE teachers SET name='$te_name',email='$te_email',mobile='$te_mobile',address='$te_address',subject = '$te_subject' WHERE eid='$get_teacherid' AND course='$course'";
                                $sql_q_update_query = mysqli_query($conn, $sql_q_update);
                                if ($sql_q_update_query) {
                                    echo '<script>location.href="teachers.php?res=success"</script>';
                                } else {
                                    echo '<script>location.href="teachers.php?res=fail"</script>';
                                }
                            }

                        } else{
                            echo '<script>alert("You Can not Update Super Admin\'s Details Enter Another")</script>';
                        }
                    }else {
                        echo '<script>alert("Wrong EID")</script>';
                    }
                }else{
                    echo '<script>alert("You Can not Update Your Details Enter Another")</script>';
                }
            }
        }?>

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
       