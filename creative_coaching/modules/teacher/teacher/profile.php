<?php
session_start();
include ("../../../config/database.php");
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $id = $_SESSION['id'];
    $eid = $_SESSION['username'];
    $sql_profile = "SELECT * FROM teacher WHERE eid = '$eid'";
    $sql_profile_check = mysqli_query($conn, $sql_profile);
    $sql_profile_check_result = mysqli_num_rows($sql_profile_check);
    while($rows = mysqli_fetch_assoc($sql_profile_check)){
        $name = $rows['name'];
        $email = $rows['email'];
        $mobile = $rows['mobile'];
        $address = $rows['address'];
        $salary = $rows['salary'];
        $position = $rows['position'];
        $subject = $rows['subject'];
        $course = $rows['course'];
        $date_of_joinig = $rows['dateofjoining'];
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title><?php echo $name ?>-Teachers-Creative Academic Care</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            a{
                text-decoration: none;
            }
            a:hover{
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <h2 align="center" style="color: blue">Teacher's Dashboard</h2>

        <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776; </span>

        <div class="header-right">
            <a href="profile.php">
                <?php echo $name . " (" . strtoupper($eid) . ")" ?></a>
        </div>
    </div>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php" class="logo"><span style="color:red;font-size:30px">Coaching Managment</span></a>
        <a href="profile.php"><?php echo $name . " (" . strtoupper($eid) . ")" ?></a>
        <a href="index.php">Home</a>
        <a href="attendance.php">Attendance</a>
        <a href="search.php">Search Student Information</a>
        <a href="update_password.php">Update Password</a>
        <a href="../../../logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                    <img src="images/default_pic.png" alt="stack photo" class="img">
                </div>
                <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                    <div class="container" style="border-bottom:1px solid black">
                        <h2><?php echo $name.' ('.ucfirst($position).')'; ?></h2>
                    </div>
                    <hr>
                    <ul class="container details">
                        <li><p><span class="glyphicon glyphicon-ok-sign" style="width:50px;"></span><?php echo $eid.' ('.ucfirst($subject).')'; ?></p></li>
                        <li><p><span class="glyphicon glyphicon-earphone one" style="width:50px;"></span><?php echo '+88 '.$mobile; ?></p></li>
                        <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $email; ?></p></li>
                        <li><p><span class="glyphicon glyphicon-map-marker one" style="width:50px;"></span><?php echo $address ?></p></li>
                        <li><p><span class="glyphicon glyphicon-tower" style="width:50px;"></span><?php echo "Date Of Joining: ".$date_of_joinig; ?></p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div align="center">
            
            <p><button onclick="showsome()" >Update Details</button></p>
        </div>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }

            function showsome() {
                alert("To Update Details Kindly Contact To Your Branch Admin.");
            }
        </script>
    </body>
    </html>
<?php } ?>