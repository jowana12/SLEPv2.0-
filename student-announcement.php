<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/osa-announcement.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Announcement</title>

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
                <span class="titles">Announcements</span>
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

                                <a href='includes/student-announcement.inc.php' class='nav__link active'>
                                    <i class='bx bx-chat nav__icon' ></i>
                                    <span class='nav__name'>Announcements</span>
                                </a>
                                
                                <a href='includes/events.inc.php' class='nav__link '>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='events-school-calendar.php' class='nav__link'>
                                    <i class='bx bx-calendar nav__icon' ></i>
                                    <span class='nav__name'>Calendar</span>
                                </a>

                                <a href='includes/students-profile.inc.php' class='nav__link'>
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

        <?php
                    $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                    $id = isset($_GET['id'])? $_GET['id'] : "";
                    $statement = $dbh->prepare("select * from slep_db.announcements order by announcement_id desc");
                    $statement->execute();
                    if($statement->rowCount() > 0){
                         while($row = $statement->fetch()){
                        $org_stat = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                        $org_stat->bindParam(1, $row['org_id']);
                        $org_stat->execute();
                        $org_row = $org_stat->fetch();

                        echo "
                        <div class='charts__bottom2'>
                        <div class='posted-announcements'>
                            <br>
                            <div class='posted-container'>
                                <div class='userpic'>
                                    <img class='user-picture' src='images/user.png' alt='user'>
                                </div>

                                <div class='posted-username'>
                                    <p class='username'>".$row['org_name']."</p>
                                    <p class='date-time'>".$row['date_posted']."</p>
                                </div>

                                <div class='posted-content'>
                                    <h2 class='topic-title'>".$row['title']."</h2>
                                    <p class='content'>".$row['content']."</p>
                                </div>
                            </div>
                        </div>
                        </div>
                        ";
                    }
                    }else{
                        header("location: student-announcement-error.php");
                        exit();
                    }
                   
                ?>
            
            
        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/osa-add-budget.js"></script>
    </body>
</html>