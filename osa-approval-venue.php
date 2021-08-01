<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/osa-approval-venue.css">
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
                <span class="titles">Venue Reservation Approval</span>
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

        <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                    <div class='card-body'>
                            <div class='table-responsive'>
                                <table width='100%'>
                                    <thead>
                                        <tr>
                                            <td>Organization</td>
                                            <td>Nature of Activity</td>
                                            <td>Title of Activity</td>
                                            <td>Target Date (from)</td>
                                            <td>Target Date (to)</td>
                                            <td>Number of Attendees</td>
                                            <td>Venue</td>
                                            <td>Poster</td>
                                            <td>Date Requested</td>
                                            <td>Aging</td>
                                            <td>Remarks</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $statement = $dbh->prepare("select * from slep_db.reservations where status=? order by days desc");
                        $status = "PENDING";
                        $statement->bindParam(1, $status);
                        $statement->execute();
                         if($statement->rowCount() < 1){
                            exit();
                            header("location: osa-approval-venue-error.php");
                            
                            }
                        
                        while($row = $statement->fetch()){
                            $stat = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                            $stat->bindParam(1, $row['org_id']);
                            $stat->execute();
                           
                            $org = $stat->fetch();


                            $date_db = strtotime($row['days']);
                            $date_db = date("Y-m-d", $date_db);
                            $date_db = strtotime($date_db);
                            date_default_timezone_set("Asia/Manila");
                            $date_now = strtotime(date("Y-m-d"));
                            $date_difference = abs(round(($date_now - $date_db)/60/60/24));
                            if($row['status'] == "PENDING"){

                                if($date_difference < 3){
                                    echo "
                                        <tr>
                                            <td>".$org['organization_name']."</td>

                                            <td>".$row['nature']."</td>

                                            <td>".$row['title']."</td>

                                            <td>".$row['date_from']."</td>

                                            <td>".$row['date_to']."</td>

                                            <td>".$row['attendees']."</td>

                                            <td>".$row['venue']."</td>

                                            <td><p class='profile-content' style='text-decoration:underline'><a href='' style='color:black'>".$row['poster']."</a></p></td>

                                            <td>".$row['date_applied']."</td>

                                            <td>".$date_difference." Days ago</td>

                                            <td>
                                            <form action='includes/approve.venue.inc.php?id=".$row['reservation_id']."' method='POST'>
                                            <textarea rows='20' cols='60' class='input' type='text' name='remarks' placeholder='Input Remarks'></textarea>
                                            </td>

                                            <td>
                                            <div class='contact'>
                                            <button class='btn-approve' type='submit' name='submit'>APPROVE</button></a>
                                            <button class='btn-unapprove' type='delete' name='delete'>UNAPPROVE</button></a>
                                            </div>
                                            </td>
                                        </tr>                        
                                    ";
                                }
                            }
                        }
                ?>

                        </tbody>
                    </table>
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