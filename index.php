<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="SLEP: Student's Login">
    <meta name="author" content="CISCONEK">
    <script src="https://kit.fontawesome.com/64d58efce2.js"crossorigin="anonymous"></script>
    <script src="//www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>SLEP: Login</title>
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
          <form action="includes/student.login.inc.php" method="post" class="sign-in-form">
            <h2 class="title">SIGN IN TO YOUR ACCOUNT</h2>

            <div class="input-field">
              <i class="fas fa-id-card icon"></i>
              <input type="number" name="student_number" placeholder="Student Number" />
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

            <div class="input-field-captcha">
              <div class="g-recaptcha"
                data-sitekey="6LfpeY8bAAAAAMjKvyqP3CkiIB38Y3ZbVDCNYpaK" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
            </div>
  
              <button class="btn solid" type="submit" name="submit-student">Login</button>
              <p class="social-text">Don't have an account? <a href="student-registration.php">Register here</a></p>
          </form>


          <form action="includes/admin.login.inc.php" method="post" class="sign-up-form">
            <h2 class="title">SIGN IN TO YOUR ACCOUNT</h2>
            <div class="input-field">
              <i class="fas fa-id-card icon"></i>
              <input type="number" name="input-id" placeholder="User ID Number" />
            </div>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="input-email" placeholder="Username" />
            </div>

            <div class="input-field-password">
              <i class="fas fa-lock"></i>
              <input id="txtPasswordOsa" type="password" name="input-password" placeholder="Password" />
              <span id="toggle_pwd_osa" class="fa fa-fw fa-eye field_icon"></span>
            </div>

            <div class="input-field-captcha">
              <div class="g-recaptcha"
                data-sitekey="6LfpeY8bAAAAAMjKvyqP3CkiIB38Y3ZbVDCNYpaK" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
            </div>

              <button class="btn solid" type="submit" name="submit-osa">Login</button>
          </form>

          <?php
            if(isset($_GET["error"])){
              if($_GET["error"] == "EmptyInput"){
                echo "<p class='fill-in'>Fill in all fields!</p>";
              }

              if($_GET["error"] == "InvalidCredentials"){
                echo "<p class='fill-in' style=' font-weight: bold; color: red;
                text-align: center;'>Invalid Credentials!</p>";
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
            <button class="btn transparent" id="sign-up-btn">
              OSA Staffs?
            </button>
          </div>
          <img src="images/sleplogonoBG.png" class="image" alt="SLEP Logo" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Welcome, OSA Staffs!</h3>
            <p>
            Enter your personal details and start leading your organization with us.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Student?
            </button>
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
      $("#toggle_pwd_osa").click(function () {
          $(this).toggleClass("fa-eye fa-eye-slash");
         var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
          $("#txtPasswordOsa").attr("type", type);
      });
  });
</script>
 <script src="javascript/index.js"></script>
  </body>
</html>
