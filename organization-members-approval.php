<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/osa-approval-deliverables.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Organization Deliverables</title>

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
                <span class="titles">Members Approval</span>
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
        <div class="charts__bottom">
        <?php
            $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
            $id = isset($_GET['id'])? $_GET['id'] : "";
            $stat = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
            $stat->bindParam(1, $id);
            $stat->execute();
            $row = $stat->fetch();
            echo "
                 <div class='title'>
                    <h1 class='title-header'>" .$row['organization_name']. "</h1>
                    <hr>
                </div>
            ";
        ?>
        <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                    <div class='card-body'>
                            <div class='table-responsive'>
                                <table width='100%'>
                                    <thead>
                                        <tr>
                                            <td>Student Number</td>
                                            <td>Student Name</td>
                                            <td>Registration Date</td>
                                            <td>Proof of Payment</td>
                                            <td>Payment Date</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                                    $id = isset($_GET['id'])? $_GET['id'] : "";
                                    $stat = $dbh->prepare("select * from slep_db.registrations where org_id=? and p_status=?");
                                    $status = "PAID";
                                    $stat->bindParam(1, $id);
                                    $stat->bindParam(2, $status);
                                    $stat->execute();                  
                                    if($stat->rowCount() > 0){
                                        while($row = $stat->fetch()){
                                        $user_stat = $dbh->prepare("select * from slep_db.users where id_number=?");
                                        $user_stat->bindParam(1, $row['student_id']);
                                        $user_stat->execute();
                                        $user_row = $user_stat->fetch();
                                        echo"
                                        <tr>
                                            <td>". $row['student_id'] ."</td>

                                            <td>". $user_row['firstname'] . " " . $user_row['lastname'] ."</td>

                                            <td>". $row['date_registered']. "</td>

                                            <td><a class='receipt' target='_blank' href='includes/show-receipt.inc.php?id=".$row['reg_id']. "' style='color:black; text-decoration:underline'>". $row['receipt']. "</a></td>

                                            <td>". $row['date_paid']. "</td>

                                            <td>
                                            <div class='contact'>
                                            <a href='includes/member-approval.inc.php?id=".$row['reg_id']."'>
                                            <button class='btn-approve' type='submit' name='submit'>APPROVE</button></a>

                                            <a href='includes/member-unapproval.inc.php?id=".$row['reg_id']."'>
                                            <button class='btn-unapprove' type='delete' name='delete'>DELETE</button></a>
                                            </div>
                                            </td>
                                        </tr>                        
                                    ";
                                }
                            } else {
                                exit();
                                header("location: organization-members-approval-error.php?id=".$id);
                                
                            }
                    ?>

                        </tbody>
                    </table>
                </div>
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