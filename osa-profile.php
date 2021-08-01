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
            if(empty($_SESSION["admin_id"])){
            header("location: ../SLEPv2.0/index.php");
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
                                <a href='includes/osa-dashboard.inc.php' class='nav__link'>
                                <i class='bx bx-grid-alt nav__icon' ></i>
                                    <span class='nav__name'>Dashboard</span>
                                </a>

                                <a href='includes/osa-announcement.inc.php' class='nav__link'>
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

                                <a href='includes/osa-profile.inc.php' class='nav__link  active'>
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
                $stat = $dbh->prepare("select * from slep_db.admins where admin_id=?");
                $stat->bindParam(1, $_SESSION["admin_id"]);
                $stat->execute();
                $row = $stat->fetch();

                if($row['data'] == NULL){
                    echo "
                        <img src='images/user.png' alt='profile-picture' id='photo'>
                    ";
                }else{
                    echo"
                        <img src='includes/show-profile-photo-admin.inc.php?id=".$row['admin_id']."' id='photo'>
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
                        $stat = $dbh->prepare("select * from slep_db.admins where admin_id=?");
                        $stat->bindParam(1, $_SESSION["admin_id"]);
                        $stat->execute();
                        $row = $stat->fetch();

                        echo "
                            <div class='profile-container'>
                                <h3 class='profile-header'>Name:&nbsp;</h3>
                                <p class='profile-content'>".$row['first_name']. " " . substr($row['middle_name'], 0, 1) . ". " . $row['last_name'] . "</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Position:&nbsp;</h3>
                                <p class='profile-content'>". $row['position'] ."</p>
                            </div>

                            <div class='profile-container'>
                                <h3 class='profile-header'>Department:&nbsp;</h3>
                                <p class='profile-content'>" .$row['department']. "</p>
                            </div>
                        ";
            ?>

        </div>

        <div class="modal-bg">
                <div class="modal" style="height: auto;">
                    <p class="text">Confirm Profile Photo</p>
                    <img src="images/user.png" id="prof" alt="profile-picture">
                    <center>
                    <form class="none" style="margin-top: 180px" action="includes/upload-profile-photo-admin.inc.php" method="POST" enctype="multipart/form-data"> 
                        <input type="file" id="file" name="picture" accept="image/png, image/jpeg" 
                        style="margin-left: 50px; margin-bottom: 10px;">
                        <button type="submit" name="submit" class="btn-modal-ok" style="margin: auto; padding-top: 10px;">OK</button>
                        <button type="button" class="btn-modal-cancel" style="margin-left:3px; ">Cancel</button>
                        
                    </form>
                </center>
                </div>
            </div>

            

        <script src="javascript/pic.js"></script>

    
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
    </body>
</html>