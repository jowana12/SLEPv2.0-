<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/organization-payment.css">
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
                <span class="titles">Organization Payment</span>
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

        <div class="main-content">
             <img style="width:100%" src="images/errormessages/nopendingmembershippayments.png" alt="error-messages">
            
        </div>

        
            
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/calendar.js"></script>
        <script src="javascript/osa-add-budget.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            
            <script>
                var error = document.getElementById("error").value;
                if(error == 1){
                    alert("Please complete the fields!");
                }
                $(function(){
                    $('.btn-pay').on('click', function(){
                        var error = document.getElementById("error").value;
                            if(error == 1){
                                alert("Please complete the fields!");
                        }
                        var id = $(this).attr('data-panel');
                        var model_bg = document.querySelector('.modal-bg');
                        var model_close = document.querySelector('.btn-modal-cancel');
                        var register = id;
                        model_close.addEventListener('click', function(){
                             model_bg.classList.remove('bg-active');
                        });

                        model_bg.classList.add('bg-active');
                        document.getElementById("final").value = register;

                    });
                }); 
            </script>
           
    </body>
</html>