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

        <?php
                $dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
                $stat = $dbh->prepare("select * from slep_db.registrations where student_id=? and p_status=?");
                $status = "PENDING";
                $stat->bindParam(1, $_SESSION['student_id']);
                $stat->bindParam(2, $status);
                $stat->execute();
                if($stat->rowCount() > 0){
                    while($row = $stat->fetch()){
                    $org = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
                    $org->bindParam(1, $row['org_id']);
                    $org->execute();
                    $org_row = $org->fetch();
                    echo "
                    <div class='list-container'>
                    <div class='list-image'>
                        <div class='preview'>
                            <img class='image' src='includes/show-image-payment.inc.php?id=".$org_row['organization_id']."' alt='try'>
                        </div>

                        <div class='list-info'>
                        <h2 class='org-name'>" .$org_row['organization_name']. " (" .$org_row['organization_abb']. ")</h2>
                        <p class='caption'>".$org_row['organization_description']. "</p>
                        <button class='btn-pay' data-panel='" . $row['reg_id'] ."'>Pay</button>
                        <form action='includes/cancel-registration.inc.php' method='POST'>
                        <button class='btn-cancel' name='cancel'>Cancel</button>
                        <input type='hidden' name='reg' value='" . $row['reg_id'] . "'>
                        </form>
                        <input type='hidden' id='".strtolower($org_row['organization_abb'])."' value='".$row['reg_id']."'>
                        </div>
                        </div>
                        </div>

                ";
                }
            }else{
                header("location: organization-payment-error.php");
                exit();
            }
                
            ?>
            <div class="modal-bg">
                <div class="modal" style="height: 400px;">
                    <form action="includes/payment.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="final" name="final">
                    <h2 class="membership-payment">Membership Payment</h2>
                    <div class="select-box">
                        <label>Mode of Payment:
                            <select class="input-field payment" name="mode" style="width: 100%; padding: 10px;text-align: left; font-family: 'Ubuntu Condensed', sans-serif; border: 2px solid;">
                                <option>Gcash</option>
                                <option>Paymaya</option>
                            </select>
                        </label>
                    </div>

                    <label class="label-number account-number"> Account Number:
                        <input class="input-field" type="number" name="account_number" style="width: 100%; padding: 10px;text-align: left; font-family: 'Ubuntu Condensed', sans-serif; border: 2px solid;">
                    </label>

                    <label> Account Name:
                        <input class="input-field student-number" type="name" name="account_name" style="width: 100%; padding: 10px;text-align: left; font-family: 'Ubuntu Condensed', sans-serif; border: 2px solid;">
                    </label>

                    <label>Receipt:
                        <input class="input-field receipt" type="file" id="receipt" name="receipt" accept="image/png, image/jpeg" style="width: 100%; padding: 10px;text-align: left; font-family: 'Ubuntu Condensed', sans-serif; border: 2px solid; margin-bottom: 10px;">
                    </label>
                    <br>

                    <button type="submit" name="submit" class="btn-modal-save">Save</button>
                    <button type="button" class="btn-modal-cancel">Cancel</button>
                    <input type="hidden" id="hehe" name="org">
                    </form>
                    
                </div>
            </div>

            <input type='hidden' id="error" value="0">

            <?php
            if(!empty(isset($_GET['error']))){
                echo "
                    
                    <script>
                        document.getElementById('error').value=1;
                    </script>
                ";
            }
            ?>
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