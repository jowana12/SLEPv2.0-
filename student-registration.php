<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="SLEP: Student's Registration">
    <meta name="author" content="CISCONEK">
    <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
    <script src="//www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="css/student-registration.css" />
    <title>SLEP: Registration</title>
  </head>
  <body>
    <?php
      session_start();
      session_unset();
      session_destroy();
    ?>

    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="includes/student.registration.inc.php" method="post" class="sign-in-form">
            <h2 class="title">CREATE YOUR ACCOUNT</h2>

            <div class="input-field">
              <i class="fas fa-id-card icon"></i>
              <input type="number" name="student_number" placeholder="Student Number" />
            </div>

            <div class="input-field">
              <i class="fas fa-id-card-alt"></i>
              <input type="text" name="student_firstname" placeholder="First Name" />
            </div>

            <div class="input-field">
              <i class="fas fa-id-card-alt"></i>
              <input type="text" name="student_middlename" placeholder="Middle Name" />
            </div>

            <div class="input-field">
              <i class="fas fa-id-card-alt"></i>
              <input type="text" name="student_lastname" placeholder="Last Name" />
            </div>

            <div class="input-field">
                <i class="fas fa-book-reader"></i>
                <select name="student_program" class="drop-down">
                    <option value="Electronics Engineering">Electronics Engineering (ECE)</option>
                    <option value="Mechanical Engineering">Mechanical Engineering (ME)</option>
                    <option value="Chemical Engineering">Chemical Engineering (ChE)</option>
                    <option value="Computer Science">Computer Science (CS)</option>
                    <option value="Entertainment and Multimedia Computing">Entertainment and Multimedia Computing (EMC)</option>
                    <option value="Information Systems">Information Systems (IS)</option>
                    <option value="Information Technology">Information Technology (IT)</option>
                    <option value="Senior High School">Senior High School (SHS)</option>
                    <option value="Electrical Engineering">Electrical Engineering (EE)</option>
                    <option value="Marine Transportation">Marine Transportation (MarT)</option>
                    <option value="Architecture">Architecture  (ARCHI)</option>
                    <option value="Computer Engineering">Computer Engineering (CpE)</option>
                    <option value="Accountancy">Accountancy (BSA)</option>
                    <option value="Accounting Information Systems">Accounting Information Systems (BSAIS)</option>
                    <option value="Logistics and Supply Chain Management">Logistics and Supply Chain Management</option>
                    <option value="Financial Management">Financial Management</option>
                    <option value="Human Resource Management">Human Resource Management</option>
                    <option value="Marketing Management">Marketing Management</option>
                    <option value="Marketing Management">English Language</option>
                    <option value="Marketing Management">Political Science</option>
                    <option value="Industrial Engineering">Industrial Engineering (IE)</option>
                </select>
            </div>

            <div class="input-field">
                <i class="fas fa-list-ol"></i>
                <select name="student_year" class="drop-down">
                    <option value="1st Year">First Year</option>
                    <option value="2nd Year">Second Year</option>
                    <option value="3rd Year">Third Year</option>
                    <option value="4th Year">Fourth Year</option>
                    <option value="5th Year">Fifth Year</option>
                </select>
            </div>

            <div class="input-field">
              <i class="fas fa-user-friends"></i>
              <select name="student_type" class="drop-down">
                    <option value="Student">Student</option>
                    <option value="Student Leader">Student Leader</option>
                </select>
            </div>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="student_email" placeholder="Username" />
            </div>

            <div class="input-field-password">
              <i class="fas fa-lock"></i>
              <input id="txtPassword" type="password" name="student_password" placeholder="Password" />
              <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
            </div>

            <div class="input-field-password">
              <i class="fas fa-unlock-alt"></i>
              <input id="txtPasswordConfirm" type="password" name="student_confirm_password" placeholder="Confirm Password" />
              <span id="toggle_pwd_confirm" class="fa fa-fw fa-eye field_icon"></span>
            </div>

            <div class="input-field-terms">
                <input type="checkbox" name="terms-conditions" class="checkbox"/>
                <label for="terms-conditions" class="label-checkbox">I agree to <a href="#">terms and conditions</a></label>
            </div>

            <div class="input-field-captcha">
              <div class="g-recaptcha"
                data-sitekey="6LfpeY8bAAAAAMjKvyqP3CkiIB38Y3ZbVDCNYpaK" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
            </div>
  
              <button class="btn solid" type="submit" name="submit">Register</button>

          </form>

          <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "EmptyInput"){
                    echo "<p class='fill-in sign-in-form'>Fill in all fields!</p>";
                }

                if($_GET["error"] == "InvalidCredentials"){
                    echo "<p class='fill-in'>Invalid Credentials!</p>";
                }

                if ($_GET['error'] == "PasswordDoNotMatch") {
                    echo "<p class='fill-in'>Password do not match!</p>";
                }

                if ($_GET['error'] == "UsernameTaken") {
                    echo "<p class='fill-in'>Username Already Exists!</p>";
                }

                if ($_GET['error'] == "TermsConditions") {
                    echo "<p class='fill-in'>Please accept the terms and conditions!</p>";
                }
            }
          ?>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Welcome, Students!</h3>
            <p>
            Enter your personal details and start leading your organization with us.
            </p>
            <a href="index.php">
            <button class="btn transparent" id="sign-up-btn">
              Login
            </button>
            </a>
          </div>
          <img src="images/sleplogonoBG.png" class="image" alt="SLEP Logo" />
        </div>
      </div>
    </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <script type="text/javascript">
  $(function () {
      $("#toggle_pwd").click(function () {
          $(this).toggleClass("fa-eye fa-eye-slash");
         var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
          $("#txtPassword").attr("type", type);
      });
  });
</script>

<script type="text/javascript">
  $(function () {
      $("#toggle_pwd_confirm").click(function () {
          $(this).toggleClass("fa-eye fa-eye-slash");
         var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
          $("#txtPasswordConfirm").attr("type", type);
      });
  });
</script>

 <script src="javascript/index.js"></script>
  </body>
</html>
