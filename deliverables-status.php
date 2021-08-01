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
        if($_SESSION["type"] == "Student"){
            header("location: ../SLEPv2.0/index.php");
            exit();
        }
        if(empty($_SESSION["student_id"])){
        header("location: ../SLEPv2.0/index.php");
        exit();
        }
    ?>

        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle" ></i>
                <span class="titles">Deliverables Approval</span>
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

        <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                    <div class='card-body'>
                            <div class='table-responsive'>
                                <table width='100%'>
                                    <thead>
                                        <tr>
                                            <td>Organization</td>
                                            <td>Type of Documents</td>
                                            <td>Uploaded Document</td>
                                            <td>Date Submitted</td>
                                            <td>Status</td>
                                            <td>Remarks</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        $statement = $dbh->prepare("select * from slep_db.deliverables where org_id=? order by days desc");
                        $statement->bindParam(1, $id);
                        $statement->execute();
                        if($statement->rowCount() == 0){
                            header("location: deliverables-status-error.php?id=".$id);
                            exit();
                        }
                        while($row = $statement->fetch()){

                            if($row['status'] == "PENDING"){
                                echo "
                                        <tr>
                                            <td>".$row['org_name']."</td>

                                            <td>".$row['file']."</td>

                                            <td>".$row['document']."</td>

                                            <td>".$row['date_submitted']."</td>

                                            <td style='color:orange'>".$row['status']."</td>

                                            <td> ".$row['remarks']." </td>    
                                            <td>
                                            <div class='contact'>
                                            <a target='_blank' href='includes/download-file.inc.php?id=".$row['deliverable_id']."'>
                                            <button class='btn-approve' type='submit' name='submit'>DOWNLOAD</button></a>
                                            </div>
                                            </td>
                                        </tr>                        
                                    ";
                            } else if($row['status'] == "APPROVED"){
                                echo "
                                <tr>
                                    <td>".$row['org_name']."</td>

                                    <td>".$row['file']."</td>

                                    <td>".$row['document']."</td>

                                    <td>".$row['date_submitted']."</td>

                                    <td style='color:green'>".$row['status']."</td>

                                    <td> ".$row['remarks']." </td>

                                    <td>
                                        <div class='contact'>
                                            <a target='_blank' href='includes/download-file.inc.php?id=".$row['deliverable_id']."'>
                                            <button class='btn-approve' type='submit' name='submit'>DOWNLOAD</button></a>
                                        </div>
                                    </td>
                                </tr>                        
                                ";
                            } else {
                                echo "
                                <tr>
                                    <td>".$row['org_name']."</td>

                                    <td>".$row['file']."</td>

                                    <td>".$row['document']."</td>

                                    <td>".$row['date_submitted']."</td>

                                    <td style='color:red'>".$row['status']."</td>

                                    <td> ".$row['remarks']." </td>    

                                    <td>
                                        <div class='contact'>
                                            <a target='_blank' href='includes/download-file.inc.php?id=".$row['deliverable_id']."'>
                                            <button class='btn-approve' type='submit' name='submit'>DOWNLOAD</button></a>
                                        </div>
                                    </td>
                                </tr>                        
                                ";
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