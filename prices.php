<?php
    include "mysql/mysql.php";
    Connection();
    session_start();
    global $connection;

    $itemsPerPage = 4;
    $totalRows = getTotalRows($connection);
    $pages = ceil($totalRows / $itemsPerPage);

    $currentPage = 1;
    if (isset($_GET["page-nr"]) && is_numeric($_GET["page-nr"])) {
        $currentPage = (int)$_GET["page-nr"];
        $currentPage = max(1, min($pages, $currentPage));
    }

    $startOffset = ($currentPage - 1) * $itemsPerPage;
    $result = getPaginatedData($connection, $startOffset, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css"> 
    <title>Prices</title>
</head>
<body class="body_prices">
    <header id="home">
        <div class="container">
        <div class="header_inner">
            <a href="/~klykadan/#home">
            <h2>OctoRec</h2>
            </a>
            <nav>
                <a href="/~klykadan/#about">About</a>
                <a href="/~klykadan/#contacts">Contacts</a>
                <a href="/~klykadan/#services">Services</a>
                <a href="/~klykadan/#portfolio">Portfolio</a>
                <!-- <a href="index.php #about">About</a>
                <a href="index.php #contacts">Contacts</a>
                <a href="index.php #services">Services</a>
                <a href="index.php #portfolio">Portfolio</a> -->
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
    <section>
        <div class="container">
            <div class="section_header">
                <h2>Prices</h2>
                <p>Dive into a world where your musical visions come to life. 
                    Our state-of-the-art recording studio combines the essence of professionalism with affordable pricing. 
                    We understand that every musician and producer has unique needs, and our diverse service packages are crafted 
                    to cater to everyone from aspiring artists to seasoned professionals.</p>
            </div>
            <div class="section_price">
                <div class="price_item">
                    <h3>Standard Package</h3>
                    <p>Standard Package - For the Solo Artist or Quick Sessions
                        Duration: 2 Hours of Recording
                        Ideal For: Perfect for recording single tracks, voice-overs, or short music sessions. Whether you're a solo artist, a podcaster, or a voice actor, this package is tailored for quick, efficient, and quality recording sessions.
                        Price: $65
                        Additional Features: Access to standard recording equipment and soundproof booths.</p>
                </div>
                <div class="price_item">
                    <h3>Professional Package</h3>
                    <p>Duration: 6 Hours of Recording
                        Ideal For: Producing a full album, EPs, or extended recording sessions. Ideal for bands, ensembles, and solo artists who need more time to perfect their sound.
                        Includes: In-depth mixing and mastering services with experienced sound engineers.
                        Price: $155
                        Additional Perks: Comfortable lounge area, high-end recording equipment, and a wide selection of microphones and instruments.</p>  
                </div>
                <div class="price_item">
                    <h3>Premium Package</h3>
                    <p>Duration: Full Day Recording
                        Unlimited Possibilities: Comprehensive music projects, album recordings, or extensive creative sessions.
                        Complete Sound Production: Advanced mixing, mastering, and post-production services for perfect sound quality.
                        Personalized Approach: Dedicated producer and sound engineer, including personalized consultations.
                        Price: $260
                        Exclusive Access: Full studio facilities, including high-end recording rooms and professional-grade equipment.</p>
                </div>
                <div class="price_item">
                    <h3>Diamond Package</h3>
                    <p>Duration: Two Full Days of Recording
                        Ultimate Creative Freedom: Ideal for intricate and ambitious projects requiring ample time and resources.
                        All-Inclusive Service: Extensive mixing, mastering, editing, and production support to bring the highest level of professionalism to your project.
                        Dedicated Team: Exclusive access to our top-tier producers, sound engineers, and studio technicians.
                        Price: $500
                        Luxury Experience: Private studio lounge, catering services, and access to a wide range of rare and vintage equipment.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="content" id="content">
        <?php while($row = $result->fetch_assoc()): ?>
            <p><?php echo htmlspecialchars($row["id"]) . " - " . htmlspecialchars($row["title"]); ?></p>
        <?php endwhile; ?>
    </div>

    <div class="info">
        Showing page <?php echo $currentPage; ?> of <?php echo $pages; ?> pages
    </div>

    <div class="pagination">
        <a href="?page-nr=1">First</a>
        <?php if($currentPage > 1): ?>
            <a href="?page-nr=<?php echo $currentPage - 1; ?>">Previous</a>
        <?php endif; ?>
        
        <?php for($i = 1; $i <= $pages; $i++): ?>
            <a href="?page-nr=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if($currentPage < $pages): ?>
            <a href="?page-nr=<?php echo $currentPage + 1; ?>">Next</a>
        <?php endif; ?>
        <a href="?page-nr=<?php echo $pages; ?>">Last</a>
    </div>
    
    <?php
     include "footer.php";
    ?>
</body>
</html>