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

    <!-- inner product page -->
    <div class="product-banner-container other-content">
        <div class="swiper productswiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide product-slide">
                    <img src="./assets/images/product-banner.png" alt="banner">
                    <div class="product-text">
                        <p>პერგოლა</p>
                    </div>
                </div>
                <div class="swiper-slide product-slide">
                    <img src="./assets/images/banner.png" alt="banner">
                    <div class="product-text">
                        <p>პერგოლა</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-buttons">
            <button class="arrow-btn prev-prod"><img src="./assets/images/arrow-left.svg" alt="arrow left"></button>
            <button class="arrow-btn next-prod"><img src="./assets/images/arrow-right.svg" alt="arrow right"></button>
        </div>
    </div>


    <section class="product-container">
        <div class="product-info-container">
            <div class="product-info">
                <p>
                    პერგოლა არის ერთ ერთი საუკეთესო სისტემა, შესაფერისია როგორც კომერციული, 
                    ასევე საყოფაცხოვრებო ფართების დასაჩრდილავად. ეს არის ინოვაციური დაჩრდილვა რადგან მისი 
                    ინოვაციური კონსტრუქცია საშუალებას იძლევა დამონტაჟდეს ნებისმიერ არსებულ სტრუქტურაში. 
                    პერგოლა დამზადებულია სპეციალური მაღალი სიმტკიცის ალუმინის შენადნობისგან, რომელიც შექმნილია 
                    დიდი ტერიტორიების დასაფარავად, მდგრადია ყველა ამინდის პირობების მიმართ, სიცივის და სიცხისთვის. 
                    ჩარჩო შეღებილია RAL ფერით მოთხოვნის მიხედვით თქვენთვის სასურველი ფერით და ხის იმიტაციით. 
                    საფარის მასალა არის PVC Block Out მონოქრომული, თქვენი არჩევანის დიზაინით, მოძრაობა ხდება უკაბელო 
                    ან სადენიანი ძრავით. შეგიძლიათ შეგვიკვეთოთ ლედ ნათურებითაც.
                </p>
                <hr>
                <div class="social-media">
                    <p>გააზიარე:</p>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9.844" height="20.255" viewBox="0 0 9.844 20.255">
                            <path d="M2.513,20.255v-9.5H0V7.329H2.513V4.406C2.513,2.109,4,0,7.418,0A20.769,20.769,0,0,1,9.827.133l-.08,3.2s-1.044-.01-2.184-.01c-1.233,0-1.431.568-1.431,1.512v2.5H9.844l-.161,3.422H6.131v9.5H2.513"></path>
                        </svg> 
                    </a>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.642" height="20.255" viewBox="0 0 21.642 20.255">
                            <g>
                              <path d="M483.993,356.79l8.356,11.172-8.408,9.083h1.893l7.361-7.953,5.948,7.953h6.44l-8.826-11.8,7.826-8.455H502.69l-6.779,7.324-5.478-7.324Zm2.783,1.394h2.958L502.8,375.651H499.84Z" transform="translate(-483.94 -356.79)"></path>
                            </g>
                        </svg>  
                    </a>
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.255" height="20.255" viewBox="0 0 20.255 20.255">
                            <path d="M24.117,7.293a5.86,5.86,0,0,0-8.067-.21l-.006-.006-2.963,2.963a5.836,5.836,0,0,0-1.229,1.812,5.82,5.82,0,0,0-1.591,1.017l-.006-.006L7.293,15.828a5.86,5.86,0,1,0,8.287,8.287l2.963-2.963-.006-.006a5.818,5.818,0,0,0,1.017-1.591,5.836,5.836,0,0,0,1.812-1.229l2.963-2.963-.006-.006a5.859,5.859,0,0,0-.21-8.066ZM13.58,22.01h0A2.957,2.957,0,0,1,9.4,17.829h0l2.162-2.162a5.823,5.823,0,0,0,4.181,4.181L13.58,22.01Zm1.606-5.788a2.942,2.942,0,0,1-.857-1.894,2.946,2.946,0,0,1,2.751,2.751,2.944,2.944,0,0,1-1.894-.857ZM22.193,13.4l-.182.182h0l-2.163,2.163a5.819,5.819,0,0,0-4.181-4.181L17.83,9.4h0l.182-.182.008.008a2.956,2.956,0,0,1,4.165,4.165l.008.009Z" transform="translate(-5.577 -5.577)"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <a href="./products.html" class="go-back">
                <i class="fa-solid fa-chevron-left"></i>
                <span>უკან დაბრუნება</span>
            </a>
        </div>
        <div class="product-gallery">
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/product1.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product1.png" />
            </a>
            <a href="./assets/images/product2.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product2.png" />
            </a>
            <a href="./assets/images/banner.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/banner.png" />
            </a>
            <a href="./assets/images/product-banner.png" data-fancybox="gallery" class="product-img">
                <img src="./assets/images/product-banner.png" />
            </a>
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