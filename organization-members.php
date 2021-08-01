<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/organization-members.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Organization Members</title>

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
                <span class="titles">Organization Members</span>
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

            <div class='buttons'>
                <button class='btn-register'>Membership Approval</button>
            </div>

            <div class='list-container'>
                            <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                $id = isset($_GET['id'])? $_GET['id'] : "";
                $stat = $dbh->prepare("select * from slep_db.registrations where org_id=? and p_status=?");
                $status = "MEMBER";
                $stat->bindParam(1, $id);
                $stat->bindParam(2, $status);
                $stat->execute();
                if($stat->rowCount() > 0){
                    while($row = $stat->fetch()){
                    $member_stat = $dbh->prepare("select * from slep_db.officers where student_id=? and organization_id=?");
                    $member_stat->bindParam(1, $row['student_id']);
                    $member_stat->bindParam(2, $row['org_id']);
                    $member_stat->execute();
                    $members = $member_stat->fetch();
                    echo "
                        <div class='list-container'>
                            <div class='list-image'>
                                <div class='preview'>
                                    <img class='image' src='images/user_transparent.png' alt='try'>
                                </div>

                                <div class='list-info'>
                                    <h2 class='member-name'>". $members['first_name']. " " .$members['last_name']. "</h2>
                                    <div class='button-del'>
                                        <a href='includes/delete-member.inc.php?id=".$row['org_id']."&stid=".$row['student_id']."'><button class='btn-delete'>Delete</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";

                }
            }else{
                header("location: organization-members-error.php?id=".$id);
                exit();
            }

                
            ?>

           
              
        </div>

        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/osa-add-budget.js"></script>

    </body>
</html>