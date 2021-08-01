<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="css/deliverables.css">
        <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"crossorigin="anonymous"/>
        <title>SLEP: Organization Deliverables</title>

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
                <span class="titles">Organization Deliverables</span>
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
                <?php
                    $id = isset($_GET['id'])? $_GET['id'] : "";
                    echo "<a href='includes/deliverables-status.inc.php?id=".$id."'>"
                ?>
                <button class='btn-register'>Updates</button></a>
                <button class='btn-payment btn-submit'>Submit</button>
            </div>

            <div class="list-container">
                    <div class="list-image">
                        <div class="preview">
                            <img class="image" src="images/doc.png" alt="try">
                        </div>

                        <div class="list-info">
                            <h2 class="org-name">After Activity Report</h2>
                            <p class="caption">An activity report, evaluation report and liquidation report must be submitted to the Office of Student Affairs (OSA) one (1) week after the activity.  No new activity shall  be allowed to be conducted unless the required reports of the previous activity are received by OSA. </p>
                            <button class="btn-download" onclick="window.location.href='forms/AFTER ACTIVITY REPORT.docx';">Download</button>

                        </div>
                    </div>
                </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Application for Student Activities</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/APPLICATION  FOR  STUDENT ACTIVITIES.doc';">Download</button>

                    </div>
                </div>
            </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Application for Recognition of Student Organization</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/APPLICATION FOR  RECOGNITION OF STUDENT ORGANIZATION.doc';">Download</button>

                    </div>
                </div>
            </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Liquidation Report</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/Liquidation  Report.doc';">Download</button>

                    </div>
                </div>
            </div>

            <div class="list-container">
                <div class="list-image">
                    <div class="preview">
                        <img class="image" src="images/doc.png" alt="try">
                    </div>

                    <div class="list-info">
                        <h2 class="org-name">Request for Working Fund/Disbursement</h2>
                        <p class="caption">All activities of the organization shall be recommended by the adviser of the organization, noted by the department chair and approved by the Office of Student Affairs. The proposal to conduct an activity must be filed two (2) weeks before the scheduled activity.</p>
                        <button class="btn-download" onclick="window.location.href='forms/REQUEST FOR WORKING  FUND-DISBURSEMENT.docx';">Download</button>

                    </div>
                </div>
            </div>
              
        </div>


        <div class="modal-bg">
                <div class="modal">
                    <?php
                        $id = isset($_GET['id'])? $_GET['id'] : "";
                        echo "<form action='includes/deliverables.inc.php?id=".$id."' method='POST' enctype='multipart/form-data'>
                        ";
                    ?>
                    
                    <h2 class="modal-header">Student Leaders' Submission</h2>
                    <div class="select-box">
                            <label>
                                <h3>Privacy Consent</h3>
                                <hr>
                                <p class="consent-details">I understand and agree that by filling-out this form I am allowing the Technological Institute of the Philippines (T.I.P.) to collect, use, and disclose the personal information for document submission and to store it as long as necessary for the fulfillment of the stated purpose in accordance with applicable laws, including the Data Privacy Act of 2012 and its Implementing Rules and Regulations, and the T.I.P. Privacy Policy. The purpose and extent of collection, use, sharing and disclosure, and storage of the data subjects' personal information was explained to me.</p>
                                <input type="radio" id="consent-yes" class="radio-button"  value="yes" name="consent">
                                <label for="consent-yes">Yes, I agree.</label>

                            </label>
                        </div>

                        <label class="label-document-type"> 
                            <h3>Type of Document</h3>
                            
                            <hr>
                            <input type="radio" id="document-after-activity" class="radio-button" name="document" value="After Activity Report">
                            <label for="document-after-activity">After Activity Report</label><br>
                            
                            <input type="radio" id="document-student-activities" class="radio-button" name="document" value="Application for Student Activities">
                            <label for="document-student-activities">Application for Student Activities</label><br>

                            <input type="radio" id="document-recognition-student-organization" class="radio-button" name="document" value="Application for Recognition of Student Organization">
                            <label for="document-recognition-student-organization">Application for Recognition of Student Organization</label><br>

                            <input type="radio" id="document-liquidation-report" class="radio-button" name="document" value="Liquidation Report">
                            <label for="document-liquidation-report">Liquidation Report</label><br>

                            <input type="radio" id="document-request-working-fund" class="radio-button"  name="document" value="Request for Working Fund/Disbursement">
                            <label for="document-request-working-fund">Request for Working Fund/Disbursement</label><br>
                        </label>


                        <label>
                            <h3>Upload Document</h3>
                            <hr>
                            <input class="upload-document" type="file" id="document" name="myfile" accept=".doc, .docx">
                        </label>
                    
                    <div class="buttons">
                        <p class="fill-in" id="message"></p>
                        <button type="button" class="btn-modal-cancel btn-modal">Cancel</button>
                        <button type="submit" class="btn-modal-submit btn-modal" name="submit">Submit</button>
                    </div>
                </form>
                </div>
            </div>

            <div class="modal-bg_02">
                <div class="modal">
                    <h2 class="confirmation">Confirmation</h2>
                    <p class="text">Upon submitting this document, I confirm that all information stipulated in the document are factual and were approved the by all appropriate signatories.</p>

                    <p class="text">In the event that there are erroneous information in the document I submitted, it is my responsibility to have them corrected and be approved by all appropriate signatories; that I may be held liable of fabricating documents or misrepresentation of information if no corrective actions are done to the document.</p>

                    <p class="text">By clicking the SUBMIT button, I understand the above statements.</p>
                        
                    <button type="button" class="btn-modal-submit_02">Submit</button>
                    <button type="button" class="btn-modal-cancel">Cancel</button>
                </div>
            </div>

        </div>

    </div>
    
    

            
            
        <!--===== MAIN JS =====-->
        <script src="javascript/student-leaders-dashboard.js"></script>
        <script src="javascript/osa-add-budget.js"></script>

        <script>
            var error = document.getElementById("error").value;
            var message = document.getElementById("message");
            if(error == 1){
                alert("FILL IN ALL THE FIELDS!");
                
            }
        </script>
    <script src="javascript/deliverables.js"></script>

    </body>
</html>