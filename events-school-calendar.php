<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/events-school-calendar.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: OSA Dashboard</title>

    </head>
    <body id="body-pd">
    <?php
        session_start();
        if(empty($_SESSION["admin_id"]) && empty($_SESSION["student_id"])){
        header("location: ../Project/students-login.php");
        exit();
        }
    ?>
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle" ></i>
                <span class="titles">School Calendar</span>
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
                                    
                                    <a href='includes/events.inc.php' class='nav__link'>
                                        <i class='bx bx-check-square nav__icon' ></i>
                                        <span class='nav__name'>Events</span>
                                    </a>

                                    <a href='events-school-calendar.php' class='nav__link active'>
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
                                
                                <a href='includes/events.inc.php' class='nav__link'>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='events-school-calendar.php' class='nav__link  active'>
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
                                
                                <a href='includes/events.inc.php' class='nav__link'>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='events-school-calendar.php' class='nav__link active'>
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
    <?php
    if(!empty($_SESSION["admin_id"])){
        echo "
    <div class='container'>
      <span class='big-circle'></span>
      <div class='form'>
        <div class='contact-info'>
          <div class='calendar'>
                        <div class='calendar-header'>
                            <span class='month-picker' id='month-picker'>February</span>
                            <div class='year-picker'>
                                <span class='year-change' id='prev-year'>
                                    <pre><</pre>
                                </span>
                                <span id='year'>2021</span>
                                <span class='year-change' id='next-year'>
                                    <pre>></pre>
                                </span>
                            </div>
                        </div>
                        <div class='calendar-body'>
                            <div class='calendar-week-day'>
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>
                            <div class='calendar-days'></div>
                        </div>
            
                        <div class='month-list'></div>
                    </div>
        </div>

        <div class='contact-form'>
          <span class='circle one'></span>
          <span class='circle two'></span>

          <form action='includes/calendar.inc.php' method='POST' autocomplete='off'>
            <h3 class='title'>Activity Calendar</h3>
            <div class='input-container'>
                <label for=''>Activity Name</label>
                <span>Activity Name</span>
                <input class='input' type='text' name='name' />
            </div>

            <div class='input-container'>
                <label for=''>Activity Description</label>
                <span>Activity Description</span>
                <input class='input' type='text' name='description' />
            </div>

            <div class='input-container'>
                <input class='input'  type='date' name='date' />
            </div>

            <div class='input-container'>
                <label for=''>Venue</label>
                <span>Venue</span>
                <input class='input'  type='text' name='venue' />
            </div>

           
            <button type='submit' name='submit' class='btn'>Update</button>
          </form>

          
        </div>
      </div>
    </div>
    ";
    }
    ?>

    <?php
        if(!empty($_SESSION["student_id"])){
            $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
            $statement = $dbh->prepare("select * from slep_db.calendar order by date asc");
            $statement->execute();
            if($statement->rowCount() < 1){
            header("location: events-school-calendar-error.php");
            exit();
            } 
        }
    ?>
                <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                $statement = $dbh->prepare("select * from slep_db.calendar order by date asc");
                $statement->execute();
               
                    while($row = $statement->fetch()){
                    echo"
                    <div class='list-container'>
                        <div class='list-image'>
                            <div class='preview'>
                                <h1 class='cal-date'>".$row['date_day']."</h1>
                                <h3 class='cal-month'>".$row['date_month']."</h3>
                                <h3 class='cal-year'>".$row['date_year']."</h3>
                            </div>
            
                            <div class='list-info'>
                                <h2 class='activity-name'>".$row['name']."</h2>
                                <h3 class='activity-venue'>at ".$row['venue']."</h3>
                                <p class='caption'>".$row['description']."</p>
                            </div>
                        </div>
                        <br>
                        </div>
                    ";
                  }
                
                    
                ?>
            

    
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