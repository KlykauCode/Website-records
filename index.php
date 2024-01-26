<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Octowhere Records</title>
    <link rel="stylesheet" href="CSS/index.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
  <header id="home">
    <div class="container">
      <div class="header_inner">
        <a href="#home">
          <h2>OctoRec</h2>
        </a>
        <nav class="nav">
          <a href="#about">About</a>
          <a href="#contacts">Contacts</a>
          <a href="prices.php">Price</a>
          <a href="#services">Services</a>
          <a href="#portfolio">Portfolio</a>
          <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] === true): ?>
          <a href="myprofile.php" class="profile">My Profile</a> 
          <a href="logout.php" class="sign_in">Logout</a> 
          <?php else: ?>
              <a href="login.php" class="sign_in">Sign In</a>
          <?php endif; ?>
        </nav>
      </div>
    </div>
  </header>

  <div class="intro"> 
    <h1 class="intro_title">OCTOWHERE RECORDS</h1>
    <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] === true): ?>
        <a class="button" href="rezervation.php">Create Reservation</a>
    <?php else: ?>
        <a class="button" href="login.php">Login to Reserve</a>
    <?php endif; ?>
  </div>

  <section id="about">
    <div class="container">
      <div class="section_header">
        <h2>About us</h2>
        <p>Our recording studio is a hub of creativity and technical excellence, offering a range of services tailored to meet the needs of both budding and seasoned artists. 
          Clients can effortlessly register, select from our diverse service offerings, and book their recording sessions. 
          We pride ourselves on showcasing a varied portfolio of our studio's work, demonstrating the high-quality audio and distinctive style we bring to every project.
          From the initial concept to the final mix, our studio is dedicated to 
          providing an unparalleled recording experience, blending state-of-the-art technology with a passion for music and sound.</p>
          <h2 id="services">Services</h2>
      </div>
      <div class="section_about">
        <div class="about_item">
          <div class="transimg">
            <a href="prices.php">
              <img src="Assets/section1.jpg" alt="Recording Equipment">
              <h3>Recording</h3>
            </a>
          </div> 
        </div>
        <div class="about_item">
          <div class="transimg">
            <a href="prices.php">
              <img src="Assets/section2.jpeg" alt="Mixing Console">
              <h3>Mixing</h3>
            </a>
          </div>
        </div>
        <div class="about_item">
          <div class="transimg">
            <a href="prices.php">
            <img src="Assets/section3.jpeg" alt="Songwriting Process">
              <h3>Song Writing</h3>
            </a>
          </div>
        </div>
        <div class="about_item">
          <div class="transimg">
            <a href="prices.php">
              <img src="Assets/section4.jpeg" alt="Mastering Studio">
              <h3>Mastering</h3>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="portfolio_section" id="portfolio">
  <div class="container">
    <div class="portfolio_header">
      <h2>Portfolio</h2>
      <p>Dive into our portfolio and experience the rich tapestry of music we've created alongside a diverse range of artists. 
        From soul-stirring acoustic pieces to vibrant electronic compositions, our portfolio showcases our versatility and dedication to excellence in sound production. 
        Listen to these samples and envision the possibilities for your own music in our hands. Let's craft your unique sound together!</p> 
    </div> 
    <div class="port_item">
      <div class="item">
        <a href="https://soundcloud.com/octowhere/octowhere-apathy01?si=69d8d0337d34432c8431aec7d2b1a8b7&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing" target="_blank">
          <img src="Assets/port1.jpg" alt="Music Track Apathy01">
          <img src="Assets/play.png" class="play-button-image" alt="Play Button">
        </a>
      </div>
      <div class="item">
        <a href="https://soundcloud.com/octowhere/sleep-token-drag-me-under-octowhere-remix?si=69d8d0337d34432c8431aec7d2b1a8b7&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing" target="_blank">
          <img src="Assets/port2.jpg" alt="Sleep Token Drag Me Under Remix">
          <img src="Assets/play.png" class="play-button-image" alt="Play Button">
        </a>
      </div>
      <div class="item">
        <a href="https://soundcloud.com/octowhere/everything?si=69d8d0337d34432c8431aec7d2b1a8b7&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing" target="_blank">
          <img src="Assets/port3.2.jpg" alt="Music Track Everything">
          <img src="Assets/play.png" class="play-button-image" alt="Play Button">
        </a>
      </div>
      <div class="item">
        <a href="https://soundcloud.com/octowhere/bitches-brew-reimagined?si=69d8d0337d34432c8431aec7d2b1a8b7&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing" target="_blank">
          <img src="Assets/port4.jpg" alt="Bitches Brew Reimagined Track">
          <img src="Assets/play.png" class="play-button-image" alt="Play Button">
        </a>
      </div>
    </div>
  </div>
</section>
<section class="contacts" id="contacts">
  <div class="container">
    <div class="contacts_header">
      <h2>Contacts</h2>
    </div>
    <div class="contacts_content">
      <div class="contact_info">
        <p>Address: Zikova 702/13</p>
        <p>Phone: +420774109091</p>
        <p>E-mail: klykau.daniil@gmail.com</p>
      </div>
      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2559.1880058205984!2d14.387355176536728!3d50.10148787152766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470b950395ce14bd%3A0x47aeea4ca6c6af91!2sSinkuleho%20kolej!5e0!3m2!1sru!2scz!4v1700499811476!5m2!1sru!2scz" 
        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<?php
  include "footer.php";
?>
</body>
</html>