<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/student-leaders-profile.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Profile</title>

    </head>
    <body id="body-pd">
    <?php
        session_start();
        if(empty($_SESSION["student_id"])){
        header("location: ../Project/students-login.php");
        exit();
        }
    ?>
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle" ></i>
                <span class="titles">Profile</span>
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <img src="images/logo_yellow.png" alt="" style="width: 30px;">
                        <span class="nav__logo-name">SLEP</span>
                    </a>

                            <div class='nav__list'>
                                <a href='includes/student-dashboard.inc.php' class='nav__link'>
                                <i class='bx bx-grid-alt nav__icon' ></i>
                                    <span class='nav__name'>Dashboard</span>
                                </a>

                                <a href='includes/student-announcement.inc.php' class='nav__link'>
                                    <i class='bx bx-chat nav__icon' ></i>
                                    <span class='nav__name'>Announcements</span>
                                </a>
                                
                                <a href='includes/events.inc.php' class='nav__link'>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='events-school-calendar.php' class='nav__link'>
                                    <i class='bx bx-calendar nav__icon' ></i>
                                    <span class='nav__name'>Calendar</span>
                                </a>

                                <a href='includes/student-profile.inc.php' class='nav__link  active'>
                                    <i class='bx bx-user nav__icon'></i>
                                    <span class='nav__name'>Profile</span>
                                </a>

                            </div>
                        </div>

                <a href="includes/logout.inc.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <div class="charts__bottom">

        <div class="main-content">
            <center>
            <div class="profile-pic-div">
                <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                $stat = $dbh->prepare("select * from slep_db.users where id_number=?");
                $stat->bindParam(1, $_SESSION["student_id"]);
                $stat->execute();
                $row = $stat->fetch();

                if($row['data'] == NULL){
                    echo "
                        <img src='images/user.png' alt='profile-picture' id='photo'>
                    ";
                }else{
                    echo"
                        <img src='includes/show-profile-photo.inc.php?id=".$row['id_number']."' id='photo'>
                    ";
                }
            ?>
                <label id="uploadBtn">Choose Photo</label>
            </div>
        </center>
            

            <label> 
                <h3 class="label-header">Personal Information</h3>
                <hr>
                <br>
            </label>
            <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $stat = $dbh->prepare("select * from slep_db.users where id_number=?");
                        $stat->bindParam(1, $_SESSION["student_id"]);
                        $stat->execute();
                        $row = $stat->fetch();

                       echo" <div class='profile-container'>
                                <h3 class='profile-header'>Student Number:&nbsp;</h3>
                                <p class='profile-content'>". $row['id_number'] ."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Name:&nbsp;</h3>
                                <p class='profile-content'>".$row['firstname']. " " . substr($row['middlename'], 0, 1) . ". " . $row['lastname'] . "</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Program:&nbsp;</h3>
                                <p class='profile-content'>Bachelor of Science in ". $row['program'] ."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Year-Level:&nbsp;</h3>
                                <p class='profile-content'>". $row['year_level'] ."</p>
                            </div>
                        ";
                    ?>

                 <label> 
                    <h3 class="label-header">Affliations</h3>
                    <hr>
                </label>

                <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $id = $_SESSION["student_id"];
                        $stat = $dbh->prepare("select * from slep_db.officers where student_id=?");
                        $stat->bindParam(1, $id);
                        $stat->execute();

                        if($_SESSION['type'] == "Student"){
                            while($row = $stat->fetch()){
                                if($row['position'] == "Member"){
                                    $org_id = $row['organization_id'];
                                    $statement = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                                    $statement->bindParam(1, $org_id);
                                    $statement->execute();
                                    while($org_row = $statement->fetch()){
                                        echo 
                                            "
                                            <div class='profile-container'>
                                                <h3 class='profile-header-aff'>".$org_row['organization_name'].":&nbsp;</h3>
                                                <p class='profile-content-aff'>".$row['position']."</p>
                                            </div>
                                                ";
                                    }
                                }
                            }
                        }else{
                            echo"
                            <img class='error-messages' style='width:100%;' src='images/errormessages/youarenotaffiliatedwithanystudentorganization.png' alt='error-messages'>
                            ";
                        }                        
                    ?>


        </div>

    
        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/calendar.js"></script>
        <script src="javascript/osa-add-budget.js"></script>
        <script type="text/javascript" src="javascript/bootstrap-filestyle.min.js"></script>
        <script>
            var error = document.getElementById("error").value;
            if(error == 1){
                alert("Please complete the fields!");
            }else if(error == 2){
                alert("Can't input negative fund!");
            }
        </script>

        </div>

        <div class="modal-bg">
                <div class="modal" style="height: auto;">
                    <p class="text">Confirm Profile Photo</p>
                    <img src="images/user.png" id="prof" alt="profile-picture">
                    <center>
                    <form class="none" style="margin-top: 180px" action="includes/upload-profile-photo.inc.php" method="POST" enctype="multipart/form-data"> 
                        <input type="file" id="file" name="picture" accept="image/png, image/jpeg" 
                        style="margin-left: 50px; margin-bottom: 10px;">
                        <button type="submit" name="submit" class="btn-modal-ok" style="margin: auto; padding-top: 10px;">OK</button>
                        <button type="button" class="btn-modal-cancel" style="margin-left:3px; ">Cancel</button>
                        
                    </form>
                </center>
                </div>
            </div>

            

        <script src="javascript/pic.js"></script>
    </body>
</html>