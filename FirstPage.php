<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Fluturimesh</title>
    <link rel="stylesheet" href="Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
    
</head>

<body>
    <section class="header">
        <nav>
            <div class="nav-links" id="navLinks">
                <img src="Images/JetSetGo.png" alt="JetSetGo Logo">
                <i class="fa-solid fa-arrow-left" id="menuBack" onclick="hideMenu()" style="display: none"></i>
                <ul>
                    <li><a href="">HOME</a></li>
                    <li><a href="About us.php">ABOUT</a></li>
                    <li><a href="offers.php">OFFERS</a></li>
                    <li><a href="Seats.php">SEATS</a></li>
                    <li><a href="Destination.php">DESTINATION</a></li>
                </ul>
            </div>
            <i class="fa-solid fa-bars" id="menuShow" onclick="showMenu()" style="display: none"></i>
        </nav>

        <div class="text-box">
            <h1>WHERE TO FLY?</h1>
            <p>Find Countless Flights Options & Deals To Various Destinations Around The World.</p>
            <a href="Login.php" class="visit">Book Your Trip Now</a>
        </div>

    </section>

    <section class="airline">
        <h1>Why choose our airline ?</h1>
        <p>We offer safe, comfortable, and on-time flights with exceptional service to make every journey enjoyable.</p>

        <div class="row">
            <div class="airline-col">
                <h3>More than 100 flights a day</h3>
                <p>We operate over 100 flights daily,
                    connecting you to your favorite destinations with ease,
                    reliability, and comfort.</p>

            </div>
            <div class="airline-col">
                <h3>We fly all over the world</h3>
                <p>Experience the joy of traveling far and wide,
                    discovering new places and cultures around the world.</p>

            </div>
            <div class="airline-col">
                <h3>Help for passengers</h3>
                <p>Find all the information you need to make your journey smooth,
                    from check-in tips to guidance at the airport and during your flight.</p>

            </div>

        </div>
    </section>

    <section class="flights">
    <h1>Fair Deals From New York</h1>

    <div class="slider-container">

        <button class="arrow left" onclick="slideLeft()">&#10094;</button>

        <div class="slider">
            <div class="slide">
                <a href="destination.php?place=statue-of-liberty">
                <img src="Images/f1rstpic.jpg">
                <p>Statue of Liberty</p>
                </a>
            </div>

            <div class="slide">
                <a href="destination.php?place=empire-state">
                <img src="Images/photo2.png">
                <p>Empire State Building</p>
                </a>
            </div>

            <div class="slide">
                <a href="destination.php?place=times-square">
                <img src="Images/TS.jpg">
                <p>Times Square</p>
                </a>
            </div>

            
            <div class="slide">
                <a href="destination.php?place=central-park">
                <img src="Images/CP.jpg">
                <p>Central Park</p>
                </a>
            </div>

             <div class="slide">
                <a href="destination.php?place=madison-square-garden">
                <img src="Images/MG.jpg">
                <p>Madison square garden </p>
                </a>
            </div>

             <div class="slide">
                <a href="destination.php?place=rockefeller-center">
                <img src="Images/rock.jpg">
                <p>Rockefeller Center </p>
                </a>
            </div>
        </div>

        <button class="arrow right" onclick="slideRight()">&#10095;</button>

    </div>
</section>

    
    <script>
        var navLinks = document.getElementById("navLinks");
        var menu = document.getElementById("menuShow");
        var back = document.getElementById("menuBack");

        function showMenu() {
            navLinks.style.right = "0";
            navLinks.style.display = "flex";
            menu.style.display = "hidden";
        }
        function hideMenu() {
            navLinks.style.right = "-200px";
            navLinks.style.display = "none";
            back.style.display = "hidden";
        }
        
let slider = document.querySelector('.slider');
let slideWidth = document.querySelector('.slide').offsetWidth + 20;

function slideRight() {
    slider.scrollBy({
        left: slideWidth,
        behavior: 'smooth'
    });
}

function slideLeft() {
    slider.scrollBy({
        left: -slideWidth,
        behavior: 'smooth'
    });
}



    </script>
    <footer class="footer">
    <div class="footer-container">

        <div class="footer-box">
            <h3>About Us</h3>
            <p>
                We help you find the best flights at the best prices.
                Book easily, travel comfortably and explore the world with us.
            </p>
             <a href="About us.php" class="footer-btn">Learn More</a>
        </div>

        <div class="footer-box">
            <h3>Contact Us</h3>
            <p>Email: support@jetsetgo.com</p>
            <p>Phone: +383 44 123 456</p>
            <p>Location: Prishtina, Kosovo</p>
            <a href="Contact us.php" class="footer-btn">Get in Touch</a>
        </div>

        <div class="footer-box">
            <h3>Special Offers</h3>
            <p>Flights under 60€</p>
            <p> Top destinations worldwide</p>
            <a href="offers.php" class="footer-btn">Explore Deals</a>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2025 JetSetGo. All rights reserved.</p>
    </div>
</footer>

</body>
</html>