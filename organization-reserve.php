<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/organization-reserve.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Venue Reservation</title>

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
                <span class="titles">Organization Reservation</span>
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

    <div class="container">
      <span class="big-circle"></span>
      <div class="form">
        <div class="contact-info">
          <h3 class="title font-bold">Let's get in touch</h3>
          <p class="text">
          Organize and add the available budget for a certain Department Student Council (DSC) / Recognized Student Organizations (RSO). 
          </p>

          <p class="text2">
          Note that the budget is based on the Total Population of Officially enrolled Students (for DSC) and Members (for RSOs) on the current semester.
          </p>

          <div class="info">
            <div class="information">
            <i class="fas fa-map-marked-alt  fa-2x" style="margin-right: 10px; color:#ffd028"></i>
              <p>363 P. Casal Street, Quiapo, City of Manila 1001</p>
            </div>
            <div class="information">
            <i class="fas fa-envelope  fa-2x" style="margin-right: 10px; color:#ffd028"></i>
              <p>corpo.manila@tip.edu.ph </p>
            </div>
            <div class="information">
            <i class="fas fa-phone-square-alt fa-2x" style="margin-right: 10px; color:#ffd028"></i>
              <p> (+632) 8733-9117 / (+632) 8733-9142</p>
            </div>

            <div class="buttons">
                <?php
                    $id = isset($_GET['id'])? $_GET['id'] : "";
                    echo "<a href='organization-reserve-status.php?id=".$id."'>"
                ?>
                <button class="btn-status">Updates</button></a>
            </div>
          </div>

          
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <?php
            $id = isset($_GET['id'])? $_GET['id'] : "";
               echo " 
                    <form action='includes/reserve-venue.inc.php?id=".$id."' method='POST' enctype='multipart/form-data'>
                    ";
            ?>

            <h3 class="title">Society of Scholars</h3>
            <div class="input-container">
            <label for="">Nature of Activity</label>
            <span>Nature of Activity</span>
            <select class="input" name="org">
                <option></option>
                <option>Co-Curricular</option>  
                <option>Extra-Curricular</option>
            </select>
            </div>

            <div class="input-container">
              <input class="input" type="text" name="title"  />
              <label for="">Title of Activity</label>
              <span>Title of Activity</span>
            </div>

            <label for="">Target Date (from)</label>
            <div class="input-container">
              <input class="input" type="datetime-local" name="date_from" />
            </div>

            <label for="">Target Date (to)</label>
            <div class="input-container">
              <input class="input" type="datetime-local" name="date_to" />
            </div>

            <div class="input-container">
              <input class="input" type="number" name="attendees"  />
              <label for="">Number of Attendees</label>
              <span>Number of Attendees</span>
            </div>

            <div class="input-container">
            <label for="">Venue</label>
            <span>Venue</span>
            <select class="input" name="venue">
                <option></option>
                <option>Seminar Room (Casal)</option>  
                <option>Seminar Room (Arlegui)</option>
                <option>Congregating Area</option>  
                <option>Study Area (Casal)</option>
                <option>Study Area(Arlegui)</option>  
                <option>PE Center Main</option>
                <option>PE Center Annex</option>  
                <option>Casal Grounds</option>
                <option>Anniversary Hall</option>  
                <option>Dr. Teresita Quirino Hall</option>
            </select>
            </div>

            <div class="input-container">
              <input class="input" type="file" name="poster" accept=".png, .jpg, .jpeg" />
              <span>Upload Poster</span>
            </div>

            <button type="submit" name="submit" class="btn">Reserve</button>
          </form>

        
        </div>
      </div>
    </div>

    
    <?php
            if(!empty(isset($_GET['error']))){
                echo "
                    <input type='hidden' id='error' value='".$_GET['error']."'>
                ";
            }
        ?>

        <script>
            var error = document.getElementById("error").value;
            if(error == 1){
                alert("Please complete the fields!");
            }
        </script>
        <script src="javascript/osa-add-budget.js"></script>
    </body>
</html>