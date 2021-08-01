<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <link rel="stylesheet" href="css/events.css">

        <title>SLEP: OSA Dashboard</title>

    </head>
    <body id="body-pd">
    <?php
        session_start();
        if(empty($_SESSION["admin_id"]) && empty($_SESSION["student_id"])){
        header("location: ../SLEPv2.0/index.php");
        exit();
        }
    ?>
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle" ></i>
                <span class="titles">Events</span>
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <img src="images/logo_yellow.png" alt="" style="width: 30px;">
                        <span class="nav__logo-name">SLEP</span>
                    </a>

                    <?php
                    if(!empty($_SESSION["type"])){
                        if($_SESSION["type"] == "Student"){

                            echo "

                                <div class='nav__list'>
                                    <a href='includes/student-dashboard.inc.php' class='nav__link'>
                                    <i class='bx bx-grid-alt nav__icon' ></i>
                                        <span class='nav__name'>Dashboard</span>
                                    </a>

                                    <a href='includes/student-announcement.inc.php' class='nav__link'>
                                        <i class='bx bx-chat nav__icon' ></i>
                                        <span class='nav__name'>Announcements</span>
                                    </a>
                                    
                                    <a href='includes/events.inc.php' class='nav__link active'>
                                        <i class='bx bx-check-square nav__icon' ></i>
                                        <span class='nav__name'>Events</span>
                                    </a>

                                    <a href='events-school-calendar.php' class='nav__link'>
                                        <i class='bx bx-calendar nav__icon' ></i>
                                        <span class='nav__name'>Calendar</span>
                                    </a>

                                    <a href='includes/student-profile.inc.php' class='nav__link'>
                                        <i class='bx bx-user nav__icon'></i>
                                        <span class='nav__name='>Profile</span>
                                    </a>


                                </div>
                            </div>

                            ";
                        } else {
                            echo 
                            "
                            <div class='nav__list'>
                                <a href='includes/student-leaders-dashboard.inc.php' class='nav__link'>
                                <i class='bx bx-grid-alt nav__icon' ></i>
                                    <span class='nav__name'>Dashboard</span>
                                </a>

                                <a href='includes/student-leaders-announcement.inc.php' class='nav__link'>
                                    <i class='bx bx-chat nav__icon' ></i>
                                    <span class='nav__name'>Announcements</span>
                                </a>
                                
                                <a href='includes/events.inc.php' class='nav__link active'>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='events-school-calendar.php' class='nav__link'>
                                    <i class='bx bx-calendar nav__icon' ></i>
                                    <span class='nav__name'>Calendar</span>
                                </a>

                                <a href='includes/student-leaders-profile.inc.php' class='nav__link'>
                                    <i class='bx bx-user nav__icon'></i>
                                    <span class='nav__name'>Profile</span>
                                </a>

                                <a href='bot.php' class='nav__link'>
                                <i class='bx bx-help-circle nav__icon'></i>
                                <span class='nav__name'>Help</span>
                                </a>

                            </div>
                        </div>
                        ";
                        }
                    }

                    if(!empty($_SESSION["admin_id"])){
                        echo "
                            <div class='nav__list'>
                                <a href='includes/osa-dashboard.inc.php' class='nav__link'>
                                <i class='bx bx-grid-alt nav__icon' ></i>
                                    <span class='nav__name'>Dashboard</span>
                                </a>

                                <a href='includes/osa-announcement.inc.php' class='nav__link'>
                                    <i class='bx bx-chat nav__icon' ></i>
                                    <span class='nav__name'>Announcements</span>
                                </a>
                                
                                <a href='includes/events.inc.php' class='nav__link active'>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='events-school-calendar.php' class='nav__link'>
                                    <i class='bx bx-calendar nav__icon' ></i>
                                    <span class='nav__name'>Calendar</span>
                                </a>

                                <a href='includes/osa-profile.inc.php' class='nav__link'>
                                    <i class='bx bx-user nav__icon'></i>
                                    <span class='nav__name'>Profile</span>
                                </a>

                            </div>
                        </div>
                        ";
                    }
                    ?>

                <a href="includes/logout.inc.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <div class="charts__bottom">
        <?php
        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
        $stat = $dbh->prepare("select * from slep_db.events");
        $stat->execute();
        while($row = $stat->fetch()){
            echo "<div class='grid-items'>
                    <div class='card'>
                        <img class='card-img' src='images/ynb-festival.png' alt='Logo'>
                        <div class='card-content'>
                        <h1 class='card-header'>".$row['event_name'] . "</h1>
                        <p class='card-text'>The Yellow and Black Festival is an annual event which gathers the Recognized Student Organizations of T.I.P. Manila for an exciting week of friendly competition. It also serves as a platform for students to join the organizations they want to grow with.</p>
                        <a href='includes/event-details.inc.php?id=".$row['event_id']."'><button class='card-btn' href='#'>Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>    
            ";
        }
        ?>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/freshmen-day.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Freshmen Day</h1>
                            <p class="card-text">At the start of each academic year, colleges and universities hold an orientation program. The entire freshman class, new students get to meet their college classmates for the first time. Upper classmen, faculty members give a heads up to what college life is.</p>
                            <a href="events-freshmen-day.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/sports-festival.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Sports Festival</h1>
                            <p class="card-text">The objectives of the Sports Festival are to celebrate May as National Physical Fitness and Sports month and to provide an incentive day for physical education students who maintain an A or B grade in physical education class and are academically eligible.</p>
                            <a href="events-sports-festival.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/nolac.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Night of Lights and Carols</h1>
                            <p class="card-text">Choir competitions allow for the giving and receiving of inspiration. As much as conductors work to motivate, encourage and inspire choirs, peer inspiration is even more effective. In short, children inspire children, and most effectively through live performance</p>
                            <a href="events-nolac.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/foundation-week.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Foundation Week</h1>
                            <p class="card-text">Every year, schools and universities celebrate their respective foundation days to commemorate the day when the school was founded or established. It is significant because of the number of years it has served the community where a school belongs to.</p>
                            <a href="events-foundation-week.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>

                <div class="grid-items">
                    <div class="card">
                        <img class="card-img" src="images/department-days.png" alt="Logo">
                        <div class="card-content">
                            <h1 class="card-header">Department Days</h1>
                            <p class="card-text">Participate in the annual celebration of your department's day through joining in several activities provided by the Department Student Council to create camaraderie between your fellow students.</p>
                            <br>
                            <a href="events-department-days.php"><button class="card-btn">Visit &nbsp; <span> &rarr; </span></button></a>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    
    

            
            
        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/osa-add-budget.js"></script>
    </body>
</html>