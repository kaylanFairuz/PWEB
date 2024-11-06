<?php
session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
  header("Location: admin_index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>CTheEarth | Home</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/main.css" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
</head>

<body>
  <header>
    <div>
      <img src="assets/logo.png" alt="logo" width="138px" height="66px" />
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="pages/about.php">About</a></li>
        <?php if (isset($_SESSION['user_email'])): ?>
          <li>
            <div class="dropdown">
              <button class="dropbtn" id="accountBtn">
                <img src="assets/defaultpp.png" alt="Profile Picture" class="profile-pic" />
                <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Account'; ?>
              </button>
              <div class="dropdown-content" id="dropdownMenu">
                <a href="php/logout.php">Logout</a>
              </div>
            </div>
          </li>
        <?php else: ?>
          <li><a href="javascript:void(0)" id="loginBtn">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <section class="banner">
    <?php include 'php/banner-slides.php'; ?>
  </section>
  <section class="main-content">
    <?php include 'php/main-content.php'; ?>
    <?php include 'php/archive-bar.php'; ?>
  </section>
  <footer>
    <a href="https://www.instagram.com/_kaylanfa_/">
      <img
        src="assets/instagram.png"
        alt="instagram"
        width="60px"
        height="60px" />
    </a>
    <a href="https://www.linkedin.com/in/kaylanfairuza/">
      <img
        src="assets/linkedin.png"
        alt="linkedin"
        width="60px"
        height="60px" />
    </a>
  </footer>

  <script src="js/main.js"></script>
  <script src="js/login.js"></script>
  <section id="loginModal" class="modal">
    <div class="modal-content">
      <span class="close-login">&times;</span>
      <h2>Login</h2>
      <form action="php/login.php" method="POST">
        <input id="email" name="email" required placeholder="Email" />
        <div style="color:red;">
          <?php if (isset($_SESSION['email_error'])): ?>
            <p><?php echo $_SESSION['email_error']; ?></p>
          <?php endif; ?>
        </div>

        <input type="password" id="password" name="password" required placeholder="Password" />
        <div style="color:red;">
          <?php if (isset($_SESSION['password_error'])): ?>
            <p><?php echo $_SESSION['password_error']; ?></p>
          <?php endif; ?>
        </div>

        <div>
          <input type="checkbox" name="remember" id="remember" />
          <label for="remember">Remember Me</label>
        </div>

        <button type="submit">Login</button>

        <p>Don't have an account? <a href="javascript:void(0)" id="registerBtn">Make one</a></p>
      </form>
    </div>
  </section>
  <section id="registerModal" class="modal">
    <div class="modal-content">
      <span class="close-register">&times;</span>
      <h2>Register</h2>
      <form method="POST" action="php/register.php">
        <input name="email" required placeholder="Email" />
        <div style="color:red;">
          <?php if (isset($_SESSION['register_email_error'])): ?>
            <p><?php echo $_SESSION['register_email_error']; ?></p>
          <?php endif; ?>
        </div>

        <input type="password" name="password" required placeholder="Password" />
        <div style="color:red;">
          <?php if (isset($_SESSION['register_password_error'])): ?>
            <p><?php echo $_SESSION['register_password_error']; ?></p>
          <?php endif; ?>
        </div>

        <button type="submit">Register</button>
      </form>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php if (isset($_SESSION['email_error']) || isset($_SESSION['password_error'])): ?>
        document.getElementById("loginModal").style.display = "block";
        <?php unset($_SESSION['email_error'], $_SESSION['password_error']); ?>
      <?php endif; ?>
      <?php if (isset($_SESSION['register_email_error']) || isset($_SESSION['register_password_error'])): ?>
        document.getElementById("registerModal").style.display = "block";
        <?php unset($_SESSION['register_email_error'], $_SESSION['register_password_error']); ?>
      <?php endif; ?>
    });
  </script>
</body>

</html>