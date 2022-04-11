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
        <h2 align="center" style="color: blue">Add Time & Batch</h2>
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
            <a href="add.php?addbatch=true" class="linking">Add Batch</a>
            <a href="add.php?addtimetable=true" class="linking">Add TimeTable</a>
            <a href="add.php?assignbatches=true" class="linking">Assign Teachers To Batch</a>
        </div>

        <?php
            if(isset($_GET['addbatch'])){ ?>
                <div align="center">
                    <form method="post">

                        <table>
                            <tr>
                                <td><b>Batch: </b></td>
                                <td><input type="text" name="batch" placeholder="Enter Batch"></td>
                            </tr>
                            <tr>
                                <td><b>Time: </b></td>
                                <td><input type="text" name="timing" placeholder="Enter Batch time"></td>
                            </tr>
                            <tr>
                                <td><b>Teacher: </b></td>
                                <td>
                                    <select name="teacher">
                                        <option value="none">Select Teacher</option>
                                        <?php
                                            $get_teacher = "SELECT eid FROM teacher where course='$course' order by eid";
                                            $get_teacher_query = mysqli_query($conn,$get_teacher);
                                            while ($get_teacher_values = mysqli_fetch_assoc($get_teacher_query)){ ?>
                                                <option value="<?php echo $get_teacher_values['eid']?>"><?php echo $get_teacher_values['eid'] ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="batchadd"></td>
                            </tr>
                        </table>
                    </form>
                </div>

          <?php
                if(isset($_POST['batchadd'])){
                    $batch_get = mysqli_real_escape_string($conn,$_POST['batch']);
                    $timings_get = mysqli_real_escape_string($conn,$_POST['timing']);
                    $teacher_get = mysqli_real_escape_string($conn,$_POST['teacher']);

                    $sql_select_batch = "SELECT batch FROM batch WHERE batch='$batch_get' AND course='$course'";
                    $sql_select_batch_query =mysqli_query($conn,$sql_select_batch);
                    $sql_select_batch_query_chekc = mysqli_num_rows($sql_select_batch_query);
                    if($sql_select_batch_query_chekc>0)
                    {
                        echo '<script>alert("Batch Already exists")</script>';
                    }else{
                        $sql_insert_into_batch = "INSERT INTO batch (batch,timing,year,course,teacher) VALUES ('$batch_get','$timings_get','2021','$course','$teacher_get')";
                        $sql_insert_into_batch_query = mysqli_query($conn,$sql_insert_into_batch);
                        if($sql_insert_into_batch_query){
                            echo '<script>alert("Successfully done")</script>';
                            echo '<script>location.href="add.php"</script>';
                        }else{
                            echo '<script>alert("Something went wrong")</script>';
                            echo '<script>location.href="add.php"</script>';
                        }
                    }
                }

            }




//timetable
          if(isset($_GET['addtimetable'])){
        ?>
                <div align="center">
                    <h3>Add Time Table</h3>
                    <form method="post">
                        <table>
                            <tr>
                                <td>Batch:</td>
                                <td>
                                    <select name="batch">
                                        <option value="none">Select Batch</option>
                                    <?php
                                    $sql_get_batch = "SELECT * FROM batch WHERE course='$course'";
                                    $sql_get_batch_query = mysqli_query($conn,$sql_get_batch);
                                    while ($get_batch_name = mysqli_fetch_assoc($sql_get_batch_query)){ ?>
                                        <option value="<?php echo $get_batch_name['batch']; ?>"><?php echo $get_batch_name['batch']; ?></option>
                                    <?php }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Teacher EID: </td>
                                <td>
                                    <select name="teacher">
                                        <option value="none">Select Teacher</option>
                                        <?php
                                            $get_teacher = "SELECT eid FROM teacher where course='$course' order by eid";
                                            $get_teacher_query = mysqli_query($conn,$get_teacher);
                                            while ($get_teacher_values = mysqli_fetch_assoc($get_teacher_query)){ ?>
                                                <option value="<?php echo $get_teacher_values['eid']?>"><?php echo $get_teacher_values['eid'] ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Subject : </td>
                                <td><input type="text" name="teacher_subject" placeholder="Enter Subject"></td>
                            </tr>
                            <tr>
                                <td>Time: </td>
                                <td>
                                    <input type="text" name="timing" placeholder="Enter Time">
                                </td>
                            </tr>
                            <tr>
                                <td>Day: </td>
                                <td><input type="text" name="day" placeholder="Enter Day" ></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="addtimetable" value="addtimetable"></td>
                            </tr>
                            


                        </table>
                    
                    
                    </form>
                </div>
                <?php
                if(isset($_POST['addtimetable'])){
                    $get_batch_for_teacher = $_POST['batch'];
                    $get_eid_for_teacher = $_POST['teacher'];
                    $get_subject_for_teacher = $_POST['teacher_subject'];
                    $get_timing = $_POST['timing'];
                    $get_day = $_POST['day'];

                    $sql_check_batch = "SELECT * FROM timetable WHERE batch='$get_batch_for_teacher' AND eid='$get_eid_for_teacher' AND subject='$get_subject_for_teacher' AND course='$course'";
                    $sql_check_batch_query = mysqli_query($conn,$sql_check_batch);
                    $get = mysqli_num_rows($sql_check_batch_query);
                    if($get>0)
                    {
                        echo '<script>alert("Already exists")</script>';
                    }else{
                        $insert_into_tea_batch = "INSERT INTO timetable(batch, eid, subject,  course, timing, day) VALUES ('$get_batch_for_teacher','$get_eid_for_teacher','$get_subject_for_teacher','$course','$get_timing', '$get_day')";
                        $insert_into_tea_batch_q = mysqli_query($conn,$insert_into_tea_batch);
                        if($insert_into_tea_batch_q ){
                            echo '<script>alert("Successfully done")</script>';
                            echo '<script>location.href="add.php"</script>';
                        }else{
                            echo '<script>alert("Something went wrong")</script>';
                            echo '<script>location.href="add.php"</script>';
                        }
                    }
                }
            }







            if(isset($_GET['assignbatches'])){
        ?>
                <div align="center">
                    <h3>Assign Teachers to batch</h3>
                    <form method="post">
                        <table>
                            <tr>
                                <td>Batch:</td>
                                <td>
                                    <select name="batch">
                                        <option value="none">Select Batch</option>
                                    <?php
                                    $sql_get_batch = "SELECT * FROM batch WHERE course='$course'";
                                    $sql_get_batch_query = mysqli_query($conn,$sql_get_batch);
                                    while ($get_batch_name = mysqli_fetch_assoc($sql_get_batch_query)){ ?>
                                        <option value="<?php echo $get_batch_name['batch']; ?>"><?php echo $get_batch_name['batch']; ?></option>
                                    <?php }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> Teacher EID: </td>
                                <td>
                                    <select name="teacher">
                                        <option value="none">Select Teacher</option>
                                        <?php
                                            $get_teacher = "SELECT eid FROM teacher where course='$course' order by eid";
                                            $get_teacher_query = mysqli_query($conn,$get_teacher);
                                            while ($get_teacher_values = mysqli_fetch_assoc($get_teacher_query)){ ?>
                                                <option value="<?php echo $get_teacher_values['eid']?>"><?php echo $get_teacher_values['eid'] ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Subject : </td>
                                <td><input type="text" name="teacher_subject" placeholder="Enter Subject"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="AssignBatch" value="Assign Batch"></td>
                            </tr>
                        </table>
                    
                    
                    </form>
                </div>
                <?php
                if(isset($_POST['AssignBatch'])){
                    $get_batch_for_teacher = $_POST['batch'];
                    $get_eid_for_teacher = $_POST['teacher'];
                    $get_subject_for_teacher = $_POST['teacher_subject'];

                    $sql_check_batch = "SELECT * FROM tea_batch WHERE batch='$get_batch_for_teacher' AND eid='$get_eid_for_teacher' AND subject='$get_subject_for_teacher' AND course='$course'";
                    $sql_check_batch_query = mysqli_query($conn,$sql_check_batch);
                    $get = mysqli_num_rows($sql_check_batch_query);
                    if($get>0)
                    {
                        echo '<script>alert("Already exists")</script>';
                    }else{
                        $insert_into_tea_batch = "INSERT INTO tea_batch(batch, eid, subject,  course) VALUES ('$get_batch_for_teacher','$get_eid_for_teacher','$get_subject_for_teacher','$course')";
                        $insert_into_tea_batch_q = mysqli_query($conn,$insert_into_tea_batch);
                        if($insert_into_tea_batch_q ){
                            echo '<script>alert("Successfully done")</script>';
                            echo '<script>location.href="add.php"</script>';
                        }else{
                            echo '<script>alert("Something went wrong")</script>';
                            echo '<script>location.href="add.php"</script>';
                        }
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