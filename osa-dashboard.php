<?php  
$connect = mysqli_connect("localhost", "root", "", "slep_db");  
$bargraph = "SELECT organization_abb, budget, expenses FROM organizations GROUP BY organization_abb";
$result_bargraph = mysqli_query($connect, $bargraph);  

$piechart_students = "SELECT program, count(*) as number FROM users GROUP BY program";
$result_piechart_students = mysqli_query($connect, $piechart_students);

$piechart_members = "SELECT organization_abb, budget FROM organizations GROUP BY organization_abb";  
$result_piechart_members = mysqli_query($connect, $piechart_members); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/osa-dashboard.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>

        <!-- ===== Charts Bar Graph ===== -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Organizations', 'Budget', 'Expenses'],
            <?php
                while ($data = mysqli_fetch_array($result_bargraph)) {
                $org= $data['organization_abb'];
                $budget = $data['budget'];
                $expenses = $data['expenses']
            ?>

            ['<?php echo $org;?>', <?php echo $budget;?>, <?php echo $expenses;?>],
      
            <?php
            }
            ?>
        ]);

        var options = {
          legend: {'position':'none'},
          is3D:true,
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    </script>

    <!-- ===== Charts Pie Chart Students ===== -->
      
    <script type="text/javascript">  
        google.charts.load('current', {'packages':['corechart']});  
        google.charts.setOnLoadCallback(drawChart);  
        function drawChart()  
        {  
            var data = google.visualization.arrayToDataTable([  ['Program', 'Number'],  
            <?php  
            while($row = mysqli_fetch_array($result_piechart_students))  
            {  
                echo "['".$row["program"]."', ".$row["number"]."],";  
            }
              
            ?>  
            ]);  
            var options = {    
                is3D:true,  
                pieHole: 0,
                legend: {'position':'none'},
                chartArea:{top:20, bottom:20},
                
            };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart_students'));  
                chart.draw(data, options);  
           }  
           </script> 

        <!-- ===== Charts Pie Chart Members ===== -->
        <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Organization', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result_piechart_members))  
                          {  
                               echo "['".$row["organization_abb"]."', ".$row["budget"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {    
                      is3D:true,  
                      pieHole: 0,
                      legend: {'position':'none'},
                      chartArea:{top:20, bottom:20},
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  
        
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
                        <a href="includes/osa-dashboard.inc.php" class="nav__link active">
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

        <div class="main__title">
            <img src="images/hello.svg" alt="" />
            <div class="main__greeting">
            <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                $id = $_SESSION["admin_id"];
                $statement = $dbh->prepare("select * from slep_db.admins where admin_id=?");
                $statement->bindParam(1, $id);
                $statement->execute();
                $row = $statement->fetch();
                echo "
                    <h1 class='greeting'>Hello, ".$row['first_name']. "!</h1>
                ";
            ?>
                <p>Welcome to your SLEP Admin dashboard.</p>
            </div>
        </div>

        <div class="main-cards">
            <div class="cards" onclick="location.href='osa-add-budget.php';">
              <i
                class="fas fa-credit-card fa-2x text-blue"
                aria-hidden="true"
              ></i>
              <div class="card-inner">
                <p class="text-primary font-bold text-title" >Organization Budget</p>
              </div>
            </div>

            <div class="cards" onclick="location.href='osa-approval-deliverables.php';">
              <i class="fas fa-file-signature fa-2x text-red" aria-hidden="true"></i>
              <div class="card_inner">
                <p class="text-primary font-bold text-title">Deliverables Approval</p>
              </div>
            </div>

            <div class="cards" onclick="location.href='osa-add-organization.php';">
              <i
                class="fas fa-bullseye fa-2x text-yellow"
                aria-hidden="true"
              ></i>
              <div class="card-inner">
                <p class="text-primary font-bold text-title">Add Student Organization</p>
              </div>
            </div>

            <div class="cards" onclick="location.href='osa-approval-venue.php';">
              <i class="fas fa-map-marker-alt fa-2x text-green" aria-hidden="true" ></i>
              <div class="card-inner">
                <p class="text-primary font-bold text-title">Venue Reservation Approval</p>

              </div>
            </div>
          </div>

        <div class="charts">
            <div class="charts__left">
                <div class="charts__left__title">
                    <div>
                    <h1>Students' Count per Program</h1>
                    <p>Students Registered S.Y. 2020 - 2021</p>
                    </div>
                </div>
                <div id="apex1">
                    <div class="main__cards">
                    <div id="piechart_students" style="width: 575px; height: 400px;"></div> 
                    </div>
                </div>
            </div>
                
            <div class="charts__right">
              <div class="charts__right__title">
                <div>
                    <h1>Members' Count per Organization</h1>
                    <p>Organizations' Membership S.Y. 2020 - 2021</p>
                </div>
              </div>

              <div class="charts__right__cards">
              <div id="piechart" style="width: 575px; height: 400px;"></div>  
              <br>
            
              </div>
            </div>
          </div>

          <div class="charts__bottom">
                <div class="charts__left__title">
                    <div>
                        <h1>Organizations' Finances</h1>
                        <p>Budget and Expenses S.Y. 2020 - 2021</p>
                    </div>
                </div>
                <div id="apex1">
                    <div class="main__cards">
                        <div id="barchart" style="width: 1300px; height: 480px;"></div>
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