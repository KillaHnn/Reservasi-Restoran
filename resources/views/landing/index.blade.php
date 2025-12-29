<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <section class="hero-section" id="home">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <header class="custom-header d-flex align-items-center px-4 py-3">
            <nav class="navbar-custom">
                <a class="nav-link-custom active" href="#home">Home</a>
                <a class="nav-link-custom" href="#about">About Us</a>
                <a class="nav-link-custom" href="#reservation">Reservation</a>
                <a class="nav-link-custom" href="#menu">Menu</a>
                <a class="nav-link-custom" href="#contact">Contact</a>
            </nav>

            <div class="auth-buttons">
                <a href="/login" class="btn-signin">Sign In</a>
                <a href="/register" class="btn-signup">Sign Up</a>
            </div>
        </header>


        <div class="hero-content">
            <h1 class="hero-title">
                Reserve your <br>
                <span class="highlight-text">table</span> in second.
            </h1>
            <p class="hero-text">
                Book a warm corner at Restaurant, share your details, and receive a QR-code receipt that makes check-in
                at the door effortless.
            </p>

            <div class="hero-actions">
                <a href="#" class="btn btn-reserve">Reserve a table</a>
                <a href="#" class="btn btn-view">View my reservations</a>
            </div>

        </div>

        <div class="info-bar">
            Same-day reservations - instant confirmation - Cashier-ready QR code
        </div>

    </section>

    <section class="about-section" id="about">
        <div class="about-container">

            <div class="about-image-layout">
                <div class="image-placeholder img-1"></div>
                <div class="image-placeholder img-2"></div>
                <div class="image-placeholder img-3"></div>
                <div class="image-placeholder img-4"></div>
            </div>

            <div class="about-content">
                <h2 class="about-title">About Us</h2>
                <p class="about-text">
                    Welcome to The Rustic Spoon, where <span>flavor</span>, <span>quality</span>, and
                    <span>comfort</span> come together. We use carefully selected ingredients and
                    <span>special recipes</span> to create a delicious and enjoyable dining experience.
                    With a <span>warm atmosphere</span> and <span>friendly service</span>, we are ready
                    to be your favorite place to share special moments with
                    <span>your loved ones</span>.
                </p>
            </div>

        </div>
    </section>

    <section class="reservation-section" id="reservation">
        <div class="reservation-container">

            <div class="opening-text-wrapper">
                <div class="opening-text-scroll scroll-up">
                    <div>OPENING</div>
                    <div>OPENING</div>
                </div>

                <div class="opening-text-scroll scroll-down">
                    <div>TIME</div>
                    <div>TIME</div>
                </div>
            </div>

            <div class="timing-box">
                <table class="timing-table">
                    <tr>
                        <td>Sunday</td>
                        <td>8:00 am – 12:00 pm</td>
                    </tr>
                    <tr>
                        <td>Monday</td>
                        <td>8:00 am – 10:00 pm</td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td>8:00 am – 10:00 pm</td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td>8:00 am – 10:00 pm</td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td>8:00 am – 10:00 pm</td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td>Closed</td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>8:00 am – 12:00 pm</td>
                    </tr>
                </table>

                <a href="#" class="btn-reserve-inside">Reserve a table</a>
            </div>

        </div>
    </section>

    <section class="menu-section py-5" id="menu">
        <div class="container">
            <h1 class="text-center menu-title mb-4">Menu</h1>

            <ul class="nav nav-tabs justify-content-center border-0" id="menuTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="main-course-tab" data-bs-toggle="tab"
                        data-bs-target="#main-course" type="button" role="tab" aria-controls="main-course"
                        aria-selected="true">
                        Main Course
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="drinks-tab" data-bs-toggle="tab" data-bs-target="#drinks"
                        type="button" role="tab" aria-controls="drinks" aria-selected="false">
                        Drinks
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="desserts-tab" data-bs-toggle="tab" data-bs-target="#desserts"
                        type="button" role="tab" aria-controls="desserts" aria-selected="false">
                        Desserts
                    </button>
                </li>
            </ul>

            <div class="tab-content menu-content-bg">
                <div class="tab-pane fade show active" id="main-course" role="tabpanel"
                    aria-labelledby="main-course-tab">
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Grilled Chicken Steak</span>
                            <span class="item-price">55K</span>
                        </div>
                        <p class="item-description">Juicy grilled chicken served with black pepper sauce and seasonal
                            vegetables.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Beef Burger Classic</span>
                            <span class="item-price">60K</span>
                        </div>
                        <p class="item-description">Grilled beef patty with fresh lettuce, tomato, cheese, and special
                            house sauce.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Creamy Chicken Alfredo Pasta</span>
                            <span class="item-price">58K</span>
                        </div>
                        <p class="item-description">Pasta tossed in creamy Alfredo sauce with tender chicken slices.
                        </p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Fried Rice Special</span>
                            <span class="item-price">45K</span>
                        </div>
                        <p class="item-description">Indonesian-style fried rice served with chicken, egg, and crackers.
                        </p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Sweet & Sour Fish</span>
                            <span class="item-price">62K</span>
                        </div>
                        <p class="item-description">Crispy fish fillet topped with sweet and sour sauce, served with
                            steamed rice.</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="drinks" role="tabpanel" aria-labelledby="drinks-tab">
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Fresh Lemon Tea</span>
                            <span class="item-price">20K</span>
                        </div>
                        <p class="item-description">Refreshing black tea blended with fresh lemon juice.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Iced Chocolate</span>
                            <span class="item-price">25K</span>
                        </div>
                        <p class="item-description">Rich chocolate drink served cold and creamy.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Mineral Water</span>
                            <span class="item-price">10K</span>
                        </div>
                        <p class="item-description">Chilled bottled mineral water.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Vanilla Milkshake</span>
                            <span class="item-price">28K</span>
                        </div>
                        <p class="item-description">Smooth vanilla ice cream blended with fresh milk.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Hot Cappuccino</span>
                            <span class="item-price">30K</span>
                        </div>
                        <p class="item-description">Freshly brewed coffee topped with steamed milk foam.</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Chocolate Lava Cake</span>
                            <span class="item-price">35K</span>
                        </div>
                        <p class="item-description">Warm chocolate cake with a rich molten center.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Classic Cheesecake</span>
                            <span class="item-price">38K</span>
                        </div>
                        <p class="item-description">Creamy cheesecake with a buttery biscuit base.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Vanilla Ice Cream</span>
                            <span class="item-price">25K</span>
                        </div>
                        <p class="item-description">Smooth and creamy vanilla ice cream.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Fruit Pancake</span>
                            <span class="item-price">32K</span>
                        </div>
                        <p class="item-description">Soft pancake served with fresh fruits and honey.</p>
                    </div>
                    <div class="menu-item">
                        <div class="item-header">
                            <span class="item-name">Banana Split</span>
                            <span class="item-price">34K</span>
                        </div>
                        <p class="item-description">Fresh bananas served with ice cream and chocolate sauce.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section" id="contact">
        <div class="contact-wrapper">


            <div class="contact-info">
                <div class="contact-title-wrapper">
                    <h1 class="contact-title">
                        <span class="d-block">C</span>
                        <span class="d-block">o</span>
                        <span class="d-block">n</span>
                        <span class="d-block">t</span>
                        <span class="d-block">a</span>
                        <span class="d-block">c</span>
                        <span class="d-block">t</span>
                    </h1>
                    <h1 class="contact-title us-title">
                        <span class="d-block">U</span>
                        <span class="d-block">s</span>
                        <span class="d-block">!</span>
                    </h1>
                </div>


                <div class="info-container">
                    <div class="info-box">
                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="info-text">
                            <h4>Address</h4>
                            <p>Jl. Jend. Sudirman No.48, Hulu Sungai Utara</p>
                        </div>
                    </div>


                    <div class="info-box">
                        <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="info-text">
                            <h4>Phone Number</h4>
                            <p>+62 825 4799 2727</p>
                        </div>
                    </div>


                    <div class="info-box">
                        <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div class="info-text">
                            <h4>E-Mail</h4>
                            <p>therusticspoon@gmail.com</p>
                        </div>
                    </div>


                    <div class="follow-us">
                        <h4>Follow Us</h4>
                        <div class="socials">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="contact-form">
                <h2>Send a message</h2>


                <div class="form-group">
                    <input type="text" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="email" placeholder="E-Mail Address">
                </div>
                <div class="form-group">
                    <textarea placeholder="Message"></textarea>
                </div>


                <p class="form-note">By submitting, you agree to the processing of your personal data by Subx as
                    described in the privacy statement</p>
                <button class="btn-submit">Submit</button>
            </div>


        </div>
    </section>

    <footer class="site-footer">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 col-sm-12 footer-col mb-4">
                    <h3 class="footer-logo">The Rustic Spoon</h3>
                    <p class="footer-text">
                        Menyajikan hidangan terbaik dengan cita rasa autentik dan suasana pedesaan yang hangat. Nikmati
                        setiap suapan dengan hati.
                    </p>
                </div>

                <div class="col-md-3 col-sm-6 footer-col mb-4">
                    <h5 class="footer-heading">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#reservation">Reservation</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6 footer-col mb-4">
                    <h5 class="footer-heading">Contact Info</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Jend. Sudirman No. 48</li>
                        <li><i class="fas fa-phone me-2"></i>+62 825-4799-2727</li>
                        <li><i class="fas fa-envelope me-2"></i>therusticspoon@gmail.com</li>
                        <li><i class="fas fa-clock me-2"></i>Open Daily: 10:00 - 22:00</li>
                    </ul>
                </div>

                <div class="col-md-2 col-sm-12 footer-col mb-4">
                    <h5 class="footer-heading">Follow Us</h5>
                    <div class="social-icons-footer d-flex">
                        <a href="#" class="social-icon-link-footer me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon-link-footer me-2"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-icon-link-footer me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon-link-footer"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <hr class="footer-divider my-4">

            <div class="row">
                <div class="col-12 text-center">
                    <p class="copyright-text mb-0">&copy; 2025 The Rustic Spoon. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link-custom');
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    navLinks.forEach(nav => nav.classList.remove('active'));
                    e.currentTarget.classList.add('active');
                });
            });

            const menuTab = document.getElementById('menuTab');
            if (menuTab) {
                function runAnimation(targetId) {
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('animate');
                    });
                    setTimeout(() => {
                        document.getElementById(targetId).classList.add('animate');
                    }, 100);
                }

                const activePane = menuTab.querySelector('.nav-link.active').getAttribute('data-bs-target')
                    .substring(1);
                runAnimation(activePane);

                menuTab.addEventListener('shown.bs.tab', function(event) {
                    const targetId = event.target.getAttribute('data-bs-target').substring(1);
                    runAnimation(targetId);
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
