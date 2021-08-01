<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/organization-reserve-status.css">
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/osa-approval-deliverables.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Organization Reservations</title>

    </head>
    <body id="body-pd">
    <?php
        session_start();
        if($_SESSION["type"] == "Student"){
            header("location: ../SLEPv2.0/index.php");
            exit();
        }
        if(empty($_SESSION["student_id"])){
        header("location: ../SLEPv2.0/index.php");
        exit();
        }
    ?>

        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle" ></i>
                <span class="titles">Reservations Approval</span>
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <img src="images/logo_yellow.png" alt="" style="width: 30px;">
                        <span class="nav__logo-name">SLEP</span>
                    </a>

                    <div class="nav__list">
                        <a href="includes/student-leaders-dashboard.inc.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="includes/student-leaders-announcement.inc.php" class="nav__link">
                            <i class='bx bx-chat nav__icon' ></i>
                            <span class="nav__name">Announcements</span>
                        </a>
                        
                        <a href="includes/events.inc.php" class="nav__link">
                            <i class='bx bx-check-square nav__icon' ></i>
                            <span class="nav__name">Events</span>
                        </a>

                        <a href="events-school-calendar.php" class="nav__link">
                            <i class='bx bx-calendar nav__icon' ></i>
                            <span class="nav__name">Calendar</span>
                        </a>

                        <a href="includes/student-leaders-profile.inc.php" class="nav__link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">Profile</span>
                        </a>

                        <a href="bot.php" class="nav__link">
                            <i class='bx bx-help-circle nav__icon'></i>
                            <span class="nav__name">Help</span>
                        </a>

                    </div>
                 </div>

                <a href="includes/logout.inc.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <div class="main-content">

             <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        $statement = $dbh->prepare("select * from slep_db.reservations where org_id=? order by days desc");
                        $statement->bindParam(1, $id);
                        $statement->execute();
                        if($statement->rowCount() < 1){
                            header("location: organization-reserve-status-error.php?id=".$id);
                            exit();
                        }
                        while($row = $statement->fetch()){
                            $stat = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                            $stat->bindParam(1, $id);
                            $stat->execute();
                            $org = $stat->fetch();

                            if($row['status'] == "APPROVED"){
                                echo "
                            <div class='list-container'>
                                <div class='list-image'>
                                    <div class='preview'>
                                        <img class='image' src='images/venue.png' alt='try'>
                                    </div>

                                    <div class='list-info'>
                                        <h2 class='org-name'>".$org['organization_name']."</h2>
                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Nature of Activity: &nbsp;</h3>
                                            <p class='profile-content'>".$row['nature']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Title of Activity:&nbsp;</h3>
                                            <p class='profile-content'>".$row['title']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (from):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_from']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (to):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_to']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Number of Attendees:&nbsp;</h3>
                                            <p class='profile-content'>".$row['attendees']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Venue:&nbsp;</h3>
                                            <p class='profile-content'>".$row['venue']."</p>
                                        </div>


                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Poster:&nbsp;</h3>
                                            <p class='profile-content' style='text-decoration:underline'><a href='' style='color:black'>".$row['poster']."</a></p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Date Checked:&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_checked']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Remarks:&nbsp;</h3>
                                            <p class='profile-content'>".$row['remarks']."</p>
                                        </div>

                                         <div class='profile-container'>
                                            <h3 class='profile-header'>Status:&nbsp;</h3>
                                            <p class='profile-content' style='color:green'>".$row['status']."</p>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download' style='visibility: hidden'>Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
                            }else if($row['status'] == "UNAPPROVED"){
                                echo "
                            <div class='list-container'>
                                <div class='list-image'>
                                    <div class='preview'>
                                        <img class='image' src='images/venue.png' alt='try'>
                                    </div>

                                    <div class='list-info'>
                                        <h2 class='org-name'>".$org['organization_name']."</h2>
                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Nature of Activity: &nbsp;</h3>
                                            <p class='profile-content'>".$row['nature']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Title of Activity:&nbsp;</h3>
                                            <p class='profile-content'>".$row['title']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (from):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_from']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (to):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_to']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Number of Attendees:&nbsp;</h3>
                                            <p class='profile-content'>".$row['attendees']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Venue:&nbsp;</h3>
                                            <p class='profile-content'>".$row['venue']."</p>
                                        </div>


                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Poster:&nbsp;</h3>
                                            <p class='profile-content' style='text-decoration:underline'><a href='' style='color:black'>".$row['poster']."</a></p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Date Checked:&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_checked']."</p>
                                        </div>

                                         <div class='profile-container'>
                                            <h3 class='profile-header'>Status:&nbsp;</h3>
                                            <p class='profile-content' style='color:red'>".$row['status']."</p>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download' style='visibility: hidden'>Download</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            ";
                            }else{
                                echo "
                            <div class='list-container'>
                                <div class='list-image'>

                                    <div class='preview'>
                                        <img class='image' src='images/venue.png' alt='try'>
                                    </div>

                                    <div class='list-info'>
                                        <h2 class='org-name'>".$org['organization_name']."</h2>
                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Nature of Activity: &nbsp;</h3>
                                            <p class='profile-content'>".$row['nature']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Title of Activity:&nbsp;</h3>
                                            <p class='profile-content'>".$row['title']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (from):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_from']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Target Date (to):&nbsp;</h3>
                                            <p class='profile-content'>".$row['date_to']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Number of Attendees:&nbsp;</h3>
                                            <p class='profile-content'>".$row['attendees']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Venue:&nbsp;</h3>
                                            <p class='profile-content'>".$row['venue']."</p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Poster:&nbsp;</h3>
                                            <p class='profile-content' style='text-decoration:underline'><a href='' style='color:black'>".$row['poster']."</a></p>
                                        </div>

                                        <div class='profile-container'>
                                            <h3 class='profile-header'>Date Checked:&nbsp;</h3>
                                            <p class='profile-content'>".$row['status']."</p>
                                        </div>

                                         <div class='profile-container'>
                                            <h3 class='profile-header'>Status:&nbsp;</h3>
                                            <p class='profile-content'>".$row['status']."</p>
                                        </div>

                                        <div class='buttons'>
                                            <button class='btn-download' style='visibility: hidden'>Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ";
                            }
                            
                        }

            ?>

                   
        </div>

            
        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/osa-add-budget.js"></script>
    </body>
</html>