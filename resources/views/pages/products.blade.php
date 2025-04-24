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

    <!-- products page -->
    <section class="Container1 other-content">
        <div class="content">
            <div class="product-grid">
                <div class="product">
                    <img src="./assets/images/product4.png" alt="product image">
                    <div class="product-description">
                        <p class="product-title">ტენტი ადერიდა</p>
                        <p class="product-desc">პერგოლა არის ერთ ერთი საუკეთესო სისტემა, შესაფერისია როგორც კომერციული, ასევე საყოფაცხოვრებო ფართების დასაჩრდილავად.</p>
                        <a href="./product-inner.html" class="learn-more">გაიგე მეტი</a>
                    </div>
                </div>
                <div class="product">
                    <img src="./assets/images/product1.png" alt="product image">
                    <div class="product-description">
                        <p class="product-title">ტენტი ადერიდა საყრდენებით</p>
                        <p class="product-desc">პერგოლა არის ერთ ერთი საუკეთესო სისტემა, შესაფერისია როგორც კომერციული, ასევე საყოფაცხოვრებო ფართების დასაჩრდილავად.</p>
                        <a href="./product-inner.html" class="learn-more">გაიგე მეტი</a>
                    </div>
                </div>
                <div class="product">
                    <img src="./assets/images/product2.png" alt="product image">
                    <div class="product-description">
                        <p class="product-title">ტენტი მუხლებით</p>
                        <p class="product-desc">პერგოლა არის ერთ ერთი საუკეთესო სისტემა, შესაფერისია როგორც კომერციული, ასევე საყოფაცხოვრებო ფართების დასაჩრდილავად.</p>
                        <a href="./product-inner.html" class="learn-more">გაიგე მეტი</a>
                    </div>
                </div>
                <div class="product">
                    <img src="./assets/images/product3.png" alt="product image">
                    <div class="product-description">
                        <p class="product-title">ვერტიკალური ტენტი (რიდო)</p>
                        <p class="product-desc">პერგოლა არის ერთ ერთი საუკეთესო სისტემა, შესაფერისია როგორც კომერციული, ასევე საყოფაცხოვრებო ფართების დასაჩრდილავად.</p>
                        <a href="./product-inner.html" class="learn-more">გაიგე მეტი</a>
                    </div>
                </div>
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