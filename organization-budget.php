<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/organization-budget.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Organization Budget</title>

    </head>
    <body id="body-pd">
       <?php
            session_start();
            if(empty($_SESSION["student_id"])){
            header("location: ../index.php");
            exit();
            }
            ?>
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle" ></i>
                <span class="titles">Organization Budget</span>
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

                        <a href="includes/students-leaders-announcement.inc.php" class="nav__link">
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
          <h3 class="title font-bold">Available Organization Fund</h3>
          <br>

          <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        $statement = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                        $statement->bindParam(1, $id);
                        $statement->execute();
                        $row = $statement->fetch();
                        if($row['checker'] == 0){
                            header("location: organization-budget-error.php?id=".$id);
                            exit();
                        }
                        echo "
                            <div class='grid-items'>
                                <div class='card'>
                                    <div class='card-content'>
                                        <h1 class='card-header'>Total Fund</h1>
                                        <h1 class='card-fund'>Php ". $row['budget']."</h1>
                                    </div>    
                                </div>
                            </div>

                            <br>

                            
                            <div class='grid-items'>
                                <div class='card'>
                                    <div class='card-content'>
                                        <h1 class='card-header'>Total Expenses</h1>
                                        <h1 class='card-fund'>Php ".$row['expenses']."</h1>
                                    </div>
                                </div>
                            </div>
                        ";

                    ?>
               
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          
             <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                $id = isset($_GET['id'])? $_GET['id'] : "";
                $statement = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                $statement->bindParam(1, $id);
                $statement->execute();
                $row = $statement->fetch();

                echo "<h3 class='title' style='margin-left: 25px; margin-top: 55px;'>" . $row['organization_name'] . "</h3>";
            ?>

            <?php
                $id = isset($_GET['id'])? $_GET['id'] : "";
                echo"
                <form action='includes/update-budget.inc.php?id=".$id."' method='POST'>
                ";
            ?>
            

            <div class="input-container" style="margin-top: -15px;">
            <label for="">Event</label>
            <span>Event</span>
            <input class="input" type="text" name="event" />
            
            </div>
            <div class="input-container">
              <input class="input" type="text" name="description" />
              <label for="">Description</label>
              <span>Description</span>
            </div>

            <div class="input-container">
              <input class="input" type="number" name="expenses" />
              <label for="">Total Expenses</label>
              <span>Totol Expenses</span>
            </div>
            <button type="submit" name="submit" class="btn">Update</button>
          </form>

          <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "2"){
                    echo "<p class='fill-in sign-in-form'>Fill in all fields!</p>";
                }else if ($_GET["error"] == "1"){
                    echo "<p class='fill-in'>Can't input negative fund!</p>";
                }
            }
          ?>
        </div>
      </div>
    </div>

    <br>
    <div class="table-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Event</th>
                            <th>Description</th>
                            <th>Total Expenses</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                            $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                            $id = isset($_GET['id'])? $_GET['id'] : "";
                            $statement = $dbh->prepare("select * from slep_db.expenses where org_id=?");
                            $statement->bindParam(1, $id);
                            $statement->execute();
                            while($row = $statement->fetch()){
                                echo "
                                    <tr>
                                        <th>".$row['date_updated']."</th>
                                        <th>".$row['event']."</th>
                                        <th>".$row['description']."</th>
                                        <th>Php ".$row['expense']."</th>
                                        <th>".$row['updated_by']."</th>
                                    </tr>
                                ";
                            }


                        ?>

        </div>

    
        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/osa-add-budget.js"></script>
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