<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>CTheEarth | About</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/about.css" />
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
</head>

<body>
  <header>
    <?php include '../php/navbar.php'; ?>
  </header>
  <section class="banner">
    <section class="slide active">
      <h1>CTheEarth</h1>
      <p>
        CTheEarth (as in 'See' The Earth) is a website where you can explore
        the wonderful places at our earth
      </p>
    </section>
  </section>
  <section class="main-content">
    <div class="text-image-container">
      <img
        src="../assets/pribadi.jpg"
        alt="Description of image"
        class="side-image" />
      <div class="text-content">
        <h2>About Me</h2>
        <p>
          My name is Kaylan Fairuza Aqila, I'm an undergraduate student from
          Insitut Teknologi Sepuluh Nopember, Surabaya, Indonesia. I'm
          currently pursuing a degree in Computer Science.
        </p>
      </div>
    </div>
  </section>
  <footer>
    <?php
    $FilePath = __DIR__ . "/../php/footer.php";
    include $FilePath;
    ?>
  </footer>

  <script src="../js/login.js"></script>
  <?php
  $FilePath = __DIR__ . "/../php/modals.php";
  include $FilePath;
  ?>
</body>

</html>