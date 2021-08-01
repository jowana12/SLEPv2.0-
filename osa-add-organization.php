<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/osa-add-organization.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: OSA Dashboard</title>

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
                <span class="titles">Add Student Organization</span>
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
                        <a href="includes/osa-dashboard.inc.php" class="nav__link">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="includes/osa-announcement.inc.php" class="nav__link">
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

                        <a href="includes/osa-profile.inc.php" class="nav__link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">Profile</span>
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
          Add new Recognized Student Organization (RSO) to the website.
          </p>

          <p class="text2">
          Note that the Organization must have already done all the steps and processed for it to be one of the Recognized Student Organization (RSO) in Technological Institute of the Philippines - Manila (TIP-Manila).
          </p>

          <div class="info">
            <div class="information">
            <i class="fas fa-map-marked-alt  fa-2x" style="margin-right: 10px; color:#ffd028"></i>
              <p>363 P. Casal Street, Quiapo, City of Manila 1001</p>
            </div>
            <div class="information">
            <i class="fas fa-envelope  fa-2x" style="margin-right: 10px; color:#ffd028"></i>
              <p>osa.manila@tip.edu.ph </p>
            </div>
            <div class="information">
            <i class="fas fa-phone-square-alt fa-2x" style="margin-right: 10px; color:#ffd028"></i>
              <p> (+632) 8733-9117 / (+632) 8733-9142</p>
            </div>
          </div>

          
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form action="includes/add-organization.inc.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <h3 class="title">Add Organization</h3>
            <div class="input-container">
                <label for="">Organization Abbreviation</label>
                <span>Organization Abbreviation</span>
                <input class="input" type="text" name="abb" />
            </div>

            <div class="input-container">
                <label for="">Organization Name</label>
                <span>Organization Name</span>
                <input class="input" type="text" name="name" />
            </div>

            <div class="input-container">
                <label for="">Organization Description</label>
                <span>Organization Description</span>
                <input class="input" type="text" name="desc" />
            </div>

            <div class="input-container">
                <input class="input" type="button" value="Upload Organization Logo" onclick="document.getElementById('file').click();" style="text-align: left; font-size: 14px"/>

              <input class="input" type="file" name="logo" accept=".jpeg, .jpg, .png" style="display:none;" id="file"/>
            </div>
            <button type="submit" name="submit" class="btn">Add</button>
          </form>

          <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "1"){
                    echo "<p class='fill-in sign-in-form'>Fill in all fields!</p>";
                }
            }
          ?>
        </div>
      </div>
    </div>

    
        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
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