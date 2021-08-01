<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/student-leaders-dashboard.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>

        <title>SLEP: Student Leaders Dashboard</title>

    </head>
    <body id="body-pd">
        <?php
            session_start();
            if(empty($_SESSION["student_id"])){
            header("location: ../SLEPv2.0/index.php");
            exit();
            }
        ?>
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle" ></i>
                <span class="title">Dashboard</span>
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
                        <a href="includes/student-leaders-dashboard.inc.php" class="nav__link active">
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

        <div class="main__title">
            <img src="images/hello.svg" alt="" />
            <div class="main__greeting">
            <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                $id = $_SESSION["student_id"];
                $statement = $dbh->prepare("select * from slep_db.users where id_number=?");
                $statement->bindParam(1, $id);
                $statement->execute();
                $row = $statement->fetch();
                echo "
                    <h1 class='greeting'>Hello, ".$row['firstname']. "!</h1>
                ";
            ?>
                <p>Welcome to your SLEP dashboard.</p>
            </div>
        </div>

        <div class="charts">
            <div class="charts__left">
                <div class="charts__left__title">
                    <div>
                        <h1>Organizations</h1>
                    </div>
                </div>
                <div id="apex1">
                    <div class="main__cards">
                    <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $id = $_SESSION["student_id"];
                        $stat = $dbh->prepare("select * from slep_db.officers where student_id=?");
                        $stat->bindParam(1, $id);
                        $stat->execute();

                        if($_SESSION['type'] == "Student Leader"){
                            while($row = $stat->fetch()){
                                if($row['position'] != "Member"){
                                    $org_id = $row['organization_id'];
                                    $statement = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                                    $statement->bindParam(1, $org_id);
                                    $statement->execute();
                                    while($org_row = $statement->fetch()){

                                        echo 
                                            "
                                            <div class='card'>
                                                <a href='student-leaders-dashboard.php?id=".$org_row['organization_id']."'><center>
                                                <img class='card-img' src='includes/showimage.inc.php?id=".$org_row['organization_id']."' alt='Logo'></a></center>
                                                <div class='card_inner'>
                                                <p class='text-primary-p'>" . $org_row['organization_name']. " (". $org_row['organization_abb'] . ")</p></div>
                                            ";
                                        }
                                    }
                                    echo "
                                    <div class='menus'><div class='items'>

                                    <a href='organization-announcement.php?id=".$row['organization_id']."'>
                                    <div class='items'>
                                    <i class='fas fa-bullhorn' onclick='location.href='#linkhere';'></i>
                                    </div>
                                    </a>

                                    <a href='organization-budget.php?id=".$row['organization_id']."'>
                                      <div class='items'>
                                        <i class='fas fa-credit-card'></i>
                                      </div>
                                    </a>

                                    <a href='deliverables.php?id=".$row['organization_id']."'>
                                      <div class='items'>
                                        <i class='fas fa-file-signature'></i>
                                      </div>
                                    </a>

                                    <a href='organization-members.php?id=".$row['organization_id']."'>
                                      <div class='items'>
                                        <i class='fas fa-users'></i>
                                      </div>
                                    </a>

                                    <a href='organization-reserve.php?id=".$row['organization_id']."'>
                                      <div class='items'>
                                        <i class='fas fa-map-marker-alt'></i>
                                      </div>
                                    </a>

                                    </div>
                                        
                                    </div>
                                    </div>
                                        ";
                                }
                            }
    
                        ?>

                        
                    
                    </div>
                </div>
            </div>
                
            <div class="charts__right">
              <div class="charts__right__title">
                <div>
                    <div class="calendar">
                        <div class="calendar-header">
                            <span class="month-picker" id="month-picker">February</span>
                            <div class="year-picker">
                                <span class="year-change" id="prev-year">
                                    <pre><</pre>
                                </span>
                                <span id="year">2021</span>
                                <span class="year-change" id="next-year">
                                    <pre>></pre>
                                </span>
                            </div>
                        </div>
                        <div class="calendar-body">
                            <div class="calendar-week-day">
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>
                            <div class="calendar-days"></div>
                        </div>
            
                        <div class="month-list"></div>
                    </div>
                </div>
                
              </div>

              
            </div>
          </div>

        <?php
            if(!empty(isset($_GET['reserve']))){
                echo "
                    <input type='hidden' id='error' value='".$_GET['reserve']."'>
                ";
            }
        ?>

        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/calendar.js"></script>
        <script>
            var error = document.getElementById("error").value;
            if(error == 1){
                alert("SUCCESS!");
            }
        </script>
    </body>
</html>