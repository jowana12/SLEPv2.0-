<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/organization-registration.css">
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>Events</title>
        <script src="javascript/registration.js"></script>

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
                <span class="titles">Organization Registration</span>
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
                                    
                                    <a href='includes/events.inc.php' class='nav__link active'>
                                        <i class='bx bx-check-square nav__icon' ></i>
                                        <span class='nav__name'>Events</span>
                                    </a>

                                    <a href='events-school-calendar.php' class='nav__link'>
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
                                
                                <a href='includes/events.inc.php' class='nav__link active'>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='includes/calendar.inc.php' class='nav__link'>
                                    <i class='bx bx-calendar nav__icon' ></i>
                                    <span class='nav__name'>Calendar</span>
                                </a>

                                <a href='includes/student-leaders-profile.inc.php' class='nav__link'>
                                    <i class='bx bx-user nav__icon'></i>
                                    <span class='nav__name'>Profile</span>
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
                                
                                <a href='includes/events.inc.php' class='nav__link active'>
                                    <i class='bx bx-check-square nav__icon' ></i>
                                    <span class='nav__name'>Events</span>
                                </a>

                                <a href='includes/calendar.inc.php' class='nav__link'>
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
                        $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                        $stat = $dbh->prepare("select * from slep_db.organizations");
                        $reg_stat = $dbh->prepare("select * from slep_db.registrations where student_id=? order by org_id");
                        $reg_stat->bindParam(1, $_SESSION['student_id']);
                        $reg_stat->execute();
                        $stat->execute();
                        
                        while($row = $stat->fetch()){
                            $status = "";
                            $checker = "0";
                            while($reg_row = $reg_stat->fetch()){
                                if($row['organization_id'] == $reg_row['org_id']){
                                    $checker = "1";
                                    $status = $reg_row['p_status'];
                                    break;
                                }
                            }

                            if($checker != "1"){
                                 echo "
                                <div class='list-container'>
                                <div class='list-image'>
                                <div class='preview'>
                                <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                </div>
                                <div class='list-info'>
                                <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                <p class='caption'>".$row['organization_description']."</p>
                                <button class='btn-register' data-panel='" . $row['organization_abb'] . "'>Register</button>
                                            </div>
                                            </div>
                                            </div>
                                            
                                ";
                            }else{
                                if($status == "PENDING"){
                                     echo "
                                <div class='list-container'>
                                <div class='list-image'>
                                <div class='preview'>
                                <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                </div>
                                <div class='list-info'>
                                <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                <p class='caption'>".$row['organization_description']."</p>
                                 <a href='organization-payment.php'><button class='btn-register-pending'>PAYMENT PENDING</button></a>
                                            </div>
                                            </div>
                                            </div>
                                            
                                       ";
                                }else if($status == "PAID"){
                                     echo "
                                        <div class='list-container'>
                                        <div class='list-image'>
                                        <div class='preview'>
                                        <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                        </div>
                                        <div class='list-info'>
                                        <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                        <p class='caption'>".$row['organization_description']."</p>
                                         <button class='btn-register-paid'>PAID</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ";
                                }else{
                                    echo "
                                        <div class='list-container'>
                                        <div class='list-image'>
                                        <div class='preview'>
                                        <img class='image' src='includes/show-organizations.inc.php?id=".$row['organization_id']."' alt='try'>
                                        </div>
                                        <div class='list-info'>
                                        <h2 class='org-name'>".$row['organization_name']." (".$row['organization_abb']. ")</h2>
                                        <p class='caption'>".$row['organization_description']."</p>
                                         <button class='btn-register-member'>MEMBER</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ";
                                }
                            }
                        }

            ?>

            <div class="modal-bg">
                <div class="modal">
                    <h2 class="confirmation">Confirmation</h2>
                    <p class="text">Are you sure you wish to register?</p>
                    <form action="includes/register.inc.php" method="POST">
                    <button type="submit" name="submit" class="btn-modal-ok">OK</button>
                    <button type="button" class="btn-modal-cancel">Cancel</button>
                    <input type="hidden" name="org" id="orgg">
                    </form>
                </div>
            </div>

            <div class="modal-bg-02">
                <div class="modal">
                    <h2 class="confirmation">Confirmation</h2>
                    <p class="text">Are you sure you wish to proceed to payment?</p>
                    <a href='organization-payment.php'>
                    <button type="button" class="btn-modal-ok ok2">OK</button></a>
                    <button type="button" class="btn-modal-cancel-02">Cancel</button>
                    </form>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script>
                $(function(){
                    $('.btn-register').on('click', function(){
                        var id = $(this).attr('data-panel');
                        var model_bg = document.querySelector('.modal-bg');
                        var model_close = document.querySelector('.btn-modal-cancel');
                        model_close.addEventListener('click', function(){
                             model_bg.classList.remove('bg-active');
                        });

                        model_bg.classList.add('bg-active');
                        document.getElementById("orgg").value = id;
                    });
                });

               
            </script>
    </body>
</html>