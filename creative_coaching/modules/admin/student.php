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
    <title>Student-Creative Academic Care</title>
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
<h2 align="center" style="color: blue">For Students</h2>
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
    <a href="teachers.php">Teachers</a>
    <a href="teachersattendance.php">Teachers Attendance</a>
    <a href="add.php">Add TimeTable/batch</a>
    <a href="update_password.php">Update Password</a>
    <a href="../../logout.php">Logout</a>
</div>

<div align="center" style="background-color: aquamarine;padding: 10px">
    <a href="student.php?addstudent=true" class="linking">Add Student</a>
    <a href="student.php?updatestudent=true" class="linking">Update Student</a>
</div>


<?php
          if(isset($_GET['addstudent'])){
        ?>
                <div align="center">
                    <h3>Add Student</h3>
                    <form method="post">
                        <table>
                            <tr>
                                <td>Batch:</td>
                                <td>
                                    <input type="text" name="batch" placeholder="Enter Batch">
                                </td>
                            </tr>
                            <tr>
                                <td> Teacher EID: </td>
                                <td>
                                    <input type="text" name="teacher" placeholder="Enter TID">
                                </td>
                            </tr>
                            <tr>
                                <td>Subject : </td>
                                <td><input type="text" name="teacher_subject" placeholder="Enter Subject"></td>
                            </tr>
                            <tr>
                                <td>Student iD: </td>
                                <td>
                                    <input type="text" name="sid" placeholder="Enter SID">
                                </td>
                            </tr>
                            <tr>
                                <td>Student Name: </td>
                                <td><input type="text" name="name" placeholder="Enter Full Name" ></td>
                            </tr>
                           <tr>
                                <td>Student Mobile: </td>
                                <td><input type="text" name="mobile" placeholder="Enter Mobile Number" ></td>
                            </tr>
                            <tr>
                                <td>Address: </td>
                                <td><input type="text" name="address" placeholder="Enter Address" ></td>
                            </tr>
                            <tr>
                                <td>Class: </td>
                                <td><input type="text" name="class" placeholder="Enter Class" ></td>
                            </tr>

                            <tr>
                                <td>Course : </td>
                                <td><input type="text" name="course" value="HSC" disabled></td>
                            </tr>
                            <tr>
                                <td>Father Name: </td>
                                <td><input type="text" name="fathername" placeholder="Enter Father Name" ></td>
                            </tr>
                            <tr>
                                <td>Father Mob: </td>
                                <td><input type="text" name="fathermob" placeholder="Enter Father Mobile" ></td>
                            </tr>
                            <tr>
                                <td>Fee: </td>
                                <td><input type="text" name="fee" placeholder="Enter total fee" ></td>
                            </tr>
                            <tr>
                                <td>date of registration: </td>
                                <td><input type="date" name="date" placeholder="Enter Full Name" ></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><input type="submit" name="addstudent" value="add"></td>
                            </tr>
                            


                        </table>
                    
                    
                    </form>
                </div>
                <?php
                if(isset($_POST['addstudent'])){
                    $get_batch_for_students = $_POST['batch'];
                    $get_eid_for_students = $_POST['teacher'];
                    $get_subject_for_students = $_POST['teacher_subject'];
                    $get_sid = $_POST['sid'];
                    $get_name = $_POST['name'];
                    $get_mobile = $_POST['mobile'];
                    $get_address = $_POST['address'];
                    $get_class = $_POST['class'];
                    $get_course = $_POST['course'];
                    $get_fathername = $_POST['fathername'];
                    $get_fathermob = $_POST['fathermob'];
                    $get_fee = $_POST['fee'];
                    $get_date = $_POST['date'];

                   
                    $insert_into_students = "INSERT INTO students(batch, teacher, subject,sid,name,mobile,address,class,course,fathername,fathermob,fee,dateofreg) VALUES ('$get_batch_for_students','$get_eid_for_students','$get_subject_for_students','$get_sid','$get_name','$get_mobile','$get_address','$get_class','$course','$get_fathername','$get_fathermob','$get_fee','$get_date ')";
                        $insert_into_students_q = mysqli_query($conn,$insert_into_students);


                    $insert_into_users = "INSERT INTO users(username, password, type) VALUES ('$get_sid ','$get_sid ','student')";
                     $insert_into_users_q = mysqli_query($conn,$insert_into_users);


                        if($insert_into_students_q AND $insert_into_users_q ){
                            echo '<script>alert("Successfully done")</script>';
                            echo '<script>location.href="student.php"</script>';
                        }else{
                            echo '<script>alert("Something went wrong")</script>';
                            echo '<script>location.href="student.php"</script>';
                        }
                        
                       
    
                    }
                }
            

    

if(isset($_GET['updatestudent']) OR isset($_GET['studentid'])){?>
    <div align="center">
        <form method="get">
            Student Id (SID): <input type="text" name="studentid" placeholder="Enter Student Id">
            <input type="submit" name="update">
        </form>
    </div>

<?php
if(isset($_GET['studentid'])){
    $get_studentid = mysqli_real_escape_string($conn,$_GET['studentid']);

$sql_query_search = "SELECT * FROM students WHERE sid='$get_studentid' AND course='$course'";
$sql_query_search_result = mysqli_query($conn,$sql_query_search);
$sql_query_search_result_check = mysqli_num_rows($sql_query_search_result);
if($sql_query_search_result_check>0)
{
$rowss = mysqli_fetch_assoc($sql_query_search_result);

?>
    <div align="center">
        <h3>Update Details - <span style="color: blue"><?php echo $get_studentid?></span></h3>


        <form method="post">

            <table>
                <tr>
                    <td><b>SID:</b></td>
                    <td> <input type="text" name="sid" value="<?php echo $rowss['sid'];?>" disabled></td>
                </tr>
                <tr>
                    <td><b>Name:</b></td>
                    <td><input type="text" name="name" value="<?php echo $rowss['name']; ?>"></td>
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
                    <td><b>Fees:</b></td>
                    <td><input type="text" name="fees" value="<?php echo $rowss['fee']; ?>"></td>
                </tr>
                <tr>
                    <td><b>Course:</b></td>
                    <td><input type="text" name="course" value="<?php echo $rowss['course']?>" disabled></td>
                </tr>
                <tr>
                    <td><b>Batch:</b> </td>
                    <td><input type="text" name="batch" value="<?php echo $rowss['batch']?>"></td>
                </tr>
                <tr>
                    <td><b>Class:</b></td>
                    <td><input type="text" name="class" value="<?php echo $rowss['class']?>"></td>
                </tr>
                <tr>
                    <td><b>Father's Name:</b></td>
                    <td><input type="text" name="fathername" value="<?php echo $rowss['fathername']?>"></td>
                </tr>
                <tr>
                    <td><b>Mobile Number:</b></td>
                    <td><input type="text" name="fathermob" value="<?php echo $rowss['fathermob']?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                
                
            </table>
             <br><input type="submit" name="update">
        </form>
        <br><a href="student.php?res=fail"><button>Cancel</button></a>

    </div>

<?php
if(isset($_POST['update'])){
    $st_name = $_POST['name'];
    $st_mobile = $_POST['phone'];
    $st_address = $_POST['address'];
    
    $st_class = $_POST['class'];
    
    $st_fathername = $_POST['fathername'];
   
    $st_fathermob = $_POST['fathermob'];
    

    $sql_q_update = "UPDATE students SET name='$st_name',phone='$st_mobile',address='$st_address',class='$st_class',fathername='$st_fathername',fathermob='$st_fathermob' WHERE sid='$get_studentid' AND course='$course'";
    $sql_q_update_query = mysqli_query($conn, $sql_q_update);
    if($sql_q_update_query){
        echo '<script>location.href="student.php?res=success"</script>';
    }else{
        echo '<script>location.href="student.php?res=fail"</script>';
    }

}

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