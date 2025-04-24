<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/font.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/responsive.css">
    <!-- Additional Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/> 
    <!-- Link to Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Tents</title>
</head>
<body>
    <header class="Container">
        <section class="content header-content">
            <a href="index.html"><img src="./assets/images/logo.svg" alt="site logo" class="logo"></a>
            <ul class="menu">
                <li><a href="./products.html">პროდუქცია</a></li>
                <li><a href="./about-us.html">ჩვენ შესახებ</a></li>
                <li><a href="./video.html">ვიდეო</a></li>
                <li><a href="./systems.html">სისტემების მახასიათებლები</a></li>
                <li><a href="./contact.html">კონტაქტი</a></li>
            </ul>
            <div class="utility-bar">
                <form class="search">
                    <button id="toggle-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" name="search" id="search" placeholder="ძიება">
                </form>
                <a href=""><i class="fa-brands fa-facebook-f"></i></a>
            </div>
            <img class="menu-toggle" src="./assets/images/menu-icon.svg" alt="menu icon" id="menu-toggle-button">
        </section>
        <div class="dropdownMenu" id="dropdownMenu">
            <ul class="mobile-menu">
                <li><a href="./products.html">პროდუქცია</a></li>
                <li><a href="./about-us.html">ჩვენ შესახებ</a></li>
                <li><a href="./video.html">ვიდეო</a></li>
                <li><a href="./systems.html">სისტემების მახასიათებლები</a></li>
                <li><a href="./contact.html">კონტაქტი</a></li>
            </ul>
            <form class="mobile-search">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
                <input type="text" name="search" placeholder="ძიება">
            </form>
            <a href="" class="mobile-fb"><i class="fa-brands fa-facebook-f"></i></a>
        </div>
    </header>

    <!-- systems page -->
    <section class="banner other-content systems-banner">
        <img src="./assets/images/systems-banner.png" alt="banner">
        <p>სისტემის მახასიათებლები</p>
    </section>

    <!-- system items -->
    <section class="Container systems-container">
        <div class="content1 systems-content">
            <div class="systems-gallery">
                <a href="./assets/images/system1.png" data-fancybox="system-gallery">
                    <img src="./assets/images/system1.png" />
                </a>
                <a href="./assets/images/system2.png" data-fancybox="system-gallery">
                    <img src="./assets/images/system2.png" />
                </a>
                <a href="./assets/images/system3.png" data-fancybox="system-gallery">
                    <img src="./assets/images/system3.png" />
                </a>
                <a href="./assets/images/system4.png" data-fancybox="system-gallery">
                    <img src="./assets/images/system4.png" />
                </a>
                <a href="./assets/images/system5.png" data-fancybox="system-gallery">
                    <img src="./assets/images/system5.png" />
                </a>
            </div>
        </div>
    </section>

    <footer>
        <p>All Rights Reserved © 2024 tents.ge</p>
        <p>Created By <a href="https://proservice.ge/" target="_blank">Proservice</a></p>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- fancybox -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <!-- other scripts -->
    <script src="./assets/JS/swiper.js"></script>
    <script src="./assets/JS/functions.js"></script>
</body>
</html>