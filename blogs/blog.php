<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Sortout Innovation</title>
    
    <!-- SEO Meta Description -->
    <meta name="description" content="Explore our latest insights, industry trends, and expert tips in digital marketing, IT solutions, and business innovation." />
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Blog - Sortout Innovation" />
    <meta property="og:description" content="Latest insights and expert tips in business innovation and digital solutions." />
    <meta property="og:url" content="https://sortoutinnovation.com/blog" />
    <meta property="og:image" content="https://sortoutinnovation.com/logo.png" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://sortoutinnovation.com/favicon-32x32.png" />
    <link rel="apple-touch-icon" href="https://sortoutinnovation.com/apple-touch-icon.png" />
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/CSS/styles.css?v=2.0" />
    
    <!-- Blog Specific CSS -->
    <style>
        .ezy__blog7_uzmYkEn6 {
            /* Bootstrap variables */
            --bs-body-color: #28303b;
            --bs-body-bg: #fff;

            /* easy frontend variables */
            --ezy-theme-color: rgb(209, 0, 0);
            --ezy-theme-color-rgb: 209, 0, 0;
            --ezy-card-bg: #fff;
            --ezy-card-shadow: 0 25px 41px rgba(89, 88, 109, 0.15);

            background-color: var(--bs-body-bg);
            padding: 0;
        }

        /* Gray Block Style */
        .gray .ezy__blog7_uzmYkEn6,
        .ezy__blog7_uzmYkEn6.gray {
            /* Bootstrap variables */
            --bs-body-bg: rgb(246, 246, 246);

            /* easy frontend variables */
            --ezy-card-bg: #fff;
            --ezy-card-shadow: 0px 8px 44px rgba(182, 198, 222, 0.48);
        }

        /* Dark Gray Block Style */
        .dark-gray .ezy__blog7_uzmYkEn6,
        .ezy__blog7_uzmYkEn6.dark-gray {
            /* Bootstrap variables */
            --bs-body-color: rgb(241, 241, 241);
            --bs-body-bg: rgb(30, 39, 53);

            /* easy frontend variables */
            --ezy-card-bg: rgb(11, 23, 39);
            --ezy-card-shadow: none;
        }

        /* Dark Block Style */
        .dark .ezy__blog7_uzmYkEn6,
        .ezy__blog7_uzmYkEn6.dark {
            /* Bootstrap variables */
            --bs-body-color: rgb(255, 255, 255);
            --bs-body-bg: rgb(11, 23, 39);

            /* easy frontend variables */
            --ezy-card-bg: rgb(30, 39, 53);
            --ezy-card-shadow: none;
        }

        .ezy__blog7_uzmYkEn6 .ezy__blog7_uzmYkEn6-wrapper {
            padding: 60px 0;
        }

        @media (min-width: 768px) {
            .ezy__blog7_uzmYkEn6 .ezy__blog7_uzmYkEn6-wrapper {
                padding: 60px 0 100px 0;
            }
        }

        /* heading and sub-heading */
        .ezy__blog7_uzmYkEn6-heading {
            font-weight: 700;
            font-size: 32px;
            line-height: 1;
            color: var(--bs-body-color);
        }

        .ezy__blog7_uzmYkEn6-sub-heading {
            color: var(--bs-body-color);
            font-size: 18px;
            font-weight: 500;
            line-height: 26px;
            opacity: 0.8;
        }

        @media (min-width: 991px) {
            .ezy__blog7_uzmYkEn6-heading {
                font-size: 45px;
            }
        }

        .ezy__blog7_uzmYkEn6-post {
            border-radius: 10px;
            background-color: var(--ezy-card-bg);
            box-shadow: var(--ezy-card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .ezy__blog7_uzmYkEn6-post:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 60px rgba(89, 88, 109, 0.25);
        }

        .ezy__blog7_uzmYkEn6-calendar {
            background-color: var(--ezy-card-bg);
            color: var(--bs-body-color);
            font-weight: 900;
            font-size: 18px;
            line-height: 24px;
            border-radius: 10px;
            position: absolute;
            bottom: 10px;
            left: 10px;
            opacity: 0.85;
        }

        .ezy__blog7_uzmYkEn6-author {
            color: var(--bs-body-color) !important;
            font-weight: 300;
            font-size: 14px;
            line-height: 24px;
            margin-bottom: 0;
        }

        .ezy__blog7_uzmYkEn6-title {
            font-weight: 500;
            margin-top: 0 !important;
            color: var(--bs-body-color);
        }

        .ezy__blog7_uzmYkEn6-description {
            color: var(--bs-body-color);
            opacity: 0.6;
        }

        .ezy__blog7_uzmYkEn6-btn {
            padding: 12px 30px;
            font-weight: bold;
            color: #ffffff;
            background-color: var(--ezy-theme-color);
            border-color: var(--ezy-theme-color);
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .ezy__blog7_uzmYkEn6-btn:hover {
            color: #ffffff;
            background-color: rgba(var(--ezy-theme-color-rgb), 0.9);
            transform: translateY(-2px);
        }

        .ezy__blog7_uzmYkEn6-btn-read-more {
            padding: 7px 20px;
            color: var(--bs-body-color);
            border-color: var(--ezy-theme-color);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .ezy__blog7_uzmYkEn6-btn-read-more:hover {
            background-color: rgba(var(--ezy-theme-color-rgb), 0.9);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .ezy__blog7_uzmYkEn6-author a {
            color: var(--ezy-theme-color);
        }



        /* Breadcrumb */
        .breadcrumb-section {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        .breadcrumb-item a {
            color: var(--ezy-theme-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        /* Modern Pagination Styling */
        .pagination {
            gap: 8px;
            margin: 0;
        }

        .pagination .page-link {
            border: none;
            color: #495057;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 50%;
            transition: all 0.2s ease;
            background-color: transparent;
            min-width: 40px;
            height: 40px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .pagination .page-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--ezy-theme-color), #b30000);
            border-radius: 50%;
            transform: scale(0);
            transition: transform 0.2s ease;
            z-index: -1;
        }

        .pagination .page-link:hover {
            color: #ffffff;
            transform: scale(1.1);
        }

        .pagination .page-link:hover::before {
            transform: scale(1);
        }

        .pagination .page-item.active .page-link {
            color: #ffffff;
            background: linear-gradient(135deg, var(--ezy-theme-color), #b30000);
            box-shadow: 0 4px 15px rgba(209, 0, 0, 0.4);
        }

        .pagination .page-item.active .page-link::before {
            display: none;
        }

        .pagination .page-item.disabled .page-link {
            color: #dee2e6;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .pagination .page-item.disabled .page-link:hover {
            transform: none;
            color: #dee2e6;
        }

        .pagination .page-item.disabled .page-link::before {
            display: none;
        }

        /* Pagination Icons */
        .pagination .page-link i {
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover i {
            transform: scale(1.1);
        }

        /* Responsive Pagination */
        @media (max-width: 576px) {
            .pagination {
                gap: 5px;
            }
            
            .pagination .page-link {
                padding: 8px 12px;
                min-width: 35px;
                height: 35px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <?php 
    // Set current page for navbar active state
    $currentPage = 'blog';
    
    // Include navbar
    include '../components/navbar/navbar.php'; 
    ?>



    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="ezy__blog7_uzmYkEn6">
        <img src="https://cdn.easyfrontend.com/pictures/blog/wide-banner.png" alt="Blog Banner" class="img-fluid w-100" />

        <div class="ezy__blog7_uzmYkEn6-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="ezy__blog7_uzmYkEn6-heading mb-3 mt-0">Let's Now make an impression.</h2>
                        <p class="ezy__blog7_uzmYkEn6-sub-heading mb-4">
                            Explore our latest insights on digital transformation, marketing strategies, and innovative business solutions that drive success in today's competitive landscape.
                        </p>
                        <a href="#" class="btn ezy__blog7_uzmYkEn6-btn">
                            <i class="fas fa-plus me-2"></i>Load All Posts
                        </a>
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <article class="ezy__blog7_uzmYkEn6-post">
                            <div class="position-relative">
                                <img
                                    src="https://cdn.easyfrontend.com/pictures/blog/blog_3.jpg"
                                    alt="Digital Marketing Trends"
                                    class="img-fluid w-100 ezy-blog7-banner"
                                />
                                <div class="px-4 py-3 ezy__blog7_uzmYkEn6-calendar">26<br />Oct<br />2024</div>
                            </div>
                            <div class="p-3 p-md-4">
                                <p class="ezy__blog7_uzmYkEn6-author">By <a href="#" class="text-decoration-none">Ben Stokes</a></p>
                                <h4 class="mt-3 ezy__blog7_uzmYkEn6-title fs-4">Digital Marketing Trends That Will Dominate 2024</h4>
                                <p class="ezy__blog7_uzmYkEn6-description mt-3 mb-4">
                                    Discover the latest digital marketing trends that are reshaping how businesses connect with their audiences and drive growth.
                                </p>
                                <a href="#" class="btn ezy__blog7_uzmYkEn6-btn-read-more">
                                    <i class="fas fa-arrow-right me-1"></i>Read More
                                </a>
                            </div>
                        </article>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <article class="ezy__blog7_uzmYkEn6-post">
                            <div class="position-relative">
                                <img
                                    src="https://cdn.easyfrontend.com/pictures/blog/blog_13_1.jpg"
                                    alt="IT Solutions"
                                    class="img-fluid w-100 ezy-blog7-banner"
                                />
                                <div class="px-4 py-3 ezy__blog7_uzmYkEn6-calendar">11<br />May<br />2024</div>
                            </div>
                            <div class="p-3 p-md-4">
                                <p class="ezy__blog7_uzmYkEn6-author">By <a href="#" class="text-decoration-none">Moein Ali</a></p>
                                <h4 class="mt-3 ezy__blog7_uzmYkEn6-title fs-4">Modern IT Solutions for Business Growth</h4>
                                <p class="ezy__blog7_uzmYkEn6-description mt-3 mb-4">
                                    Learn how cutting-edge IT solutions can transform your business operations and accelerate growth in the digital age.
                                </p>
                                <a href="#" class="btn ezy__blog7_uzmYkEn6-btn-read-more">
                                    <i class="fas fa-arrow-right me-1"></i>Read More
                                </a>
                            </div>
                        </article>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <article class="ezy__blog7_uzmYkEn6-post">
                            <div class="position-relative">
                                <img
                                    src="https://cdn.easyfrontend.com/pictures/blog/blog_9.jpg"
                                    alt="Business Innovation"
                                    class="img-fluid w-100 ezy-blog7-banner"
                                />
                                <div class="px-4 py-3 ezy__blog7_uzmYkEn6-calendar">19<br />Mar<br />2024</div>
                            </div>
                            <div class="p-3 p-md-4">
                                <p class="ezy__blog7_uzmYkEn6-author">By <a href="#" class="text-decoration-none">Maxy Paulo</a></p>
                                <h4 class="mt-3 ezy__blog7_uzmYkEn6-title fs-4">Innovation Strategies for Business Success</h4>
                                <p class="ezy__blog7_uzmYkEn6-description mt-3 mb-4">
                                    Explore proven innovation strategies that successful companies use to stay ahead of the competition and drive sustainable growth.
                                </p>
                                <a href="#" class="btn ezy__blog7_uzmYkEn6-btn-read-more">
                                    <i class="fas fa-arrow-right me-1"></i>Read More
                                </a>
                            </div>
                        </article>
                    </div>
                </div>

                <!-- Additional Blog Posts -->
                <div class="row mt-4">
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <article class="ezy__blog7_uzmYkEn6-post">
                            <div class="position-relative">
                                <img
                                    src="https://cdn.easyfrontend.com/pictures/blog/blog_3.jpg"
                                    alt="HR Solutions"
                                    class="img-fluid w-100 ezy-blog7-banner"
                                />
                                <div class="px-4 py-3 ezy__blog7_uzmYkEn6-calendar">15<br />Feb<br />2024</div>
                            </div>
                            <div class="p-3 p-md-4">
                                <p class="ezy__blog7_uzmYkEn6-author">By <a href="#" class="text-decoration-none">Sarah Johnson</a></p>
                                <h4 class="mt-3 ezy__blog7_uzmYkEn6-title fs-4">Modern HR Solutions for Remote Teams</h4>
                                <p class="ezy__blog7_uzmYkEn6-description mt-3 mb-4">
                                    Discover effective HR strategies and tools for managing remote teams and maintaining productivity in the new work environment.
                                </p>
                                <a href="#" class="btn ezy__blog7_uzmYkEn6-btn-read-more">
                                    <i class="fas fa-arrow-right me-1"></i>Read More
                                </a>
                            </div>
                        </article>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <article class="ezy__blog7_uzmYkEn6-post">
                            <div class="position-relative">
                                <img
                                    src="https://cdn.easyfrontend.com/pictures/blog/blog_13_1.jpg"
                                    alt="E-commerce Solutions"
                                    class="img-fluid w-100 ezy-blog7-banner"
                                />
                                <div class="px-4 py-3 ezy__blog7_uzmYkEn6-calendar">08<br />Jan<br />2024</div>
                            </div>
                            <div class="p-3 p-md-4">
                                <p class="ezy__blog7_uzmYkEn6-author">By <a href="#" class="text-decoration-none">David Chen</a></p>
                                <h4 class="mt-3 ezy__blog7_uzmYkEn6-title fs-4">E-commerce Solutions for Business Growth</h4>
                                <p class="ezy__blog7_uzmYkEn6-description mt-3 mb-4">
                                    Learn how to leverage e-commerce platforms and solutions to expand your business reach and increase sales revenue.
                                </p>
                                <a href="#" class="btn ezy__blog7_uzmYkEn6-btn-read-more">
                                    <i class="fas fa-arrow-right me-1"></i>Read More
                                </a>
                            </div>
                        </article>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <article class="ezy__blog7_uzmYkEn6-post">
                            <div class="position-relative">
                                <img
                                    src="https://cdn.easyfrontend.com/pictures/blog/blog_9.jpg"
                                    alt="Event Management"
                                    class="img-fluid w-100 ezy-blog7-banner"
                                />
                                <div class="px-4 py-3 ezy__blog7_uzmYkEn6-calendar">22<br />Dec<br />2023</div>
                            </div>
                            <div class="p-3 p-md-4">
                                <p class="ezy__blog7_uzmYkEn6-author">By <a href="#" class="text-decoration-none">Emma Wilson</a></p>
                                <h4 class="mt-3 ezy__blog7_uzmYkEn6-title fs-4">Event Management in the Digital Age</h4>
                                <p class="ezy__blog7_uzmYkEn6-description mt-3 mb-4">
                                    Explore innovative event management strategies and digital tools that are revolutionizing how we plan and execute events.
                                </p>
                                <a href="#" class="btn ezy__blog7_uzmYkEn6-btn-read-more">
                                    <i class="fas fa-arrow-right me-1"></i>Read More
                                </a>
                            </div>
                        </article>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col-12">
                        <nav aria-label="Blog pagination">
                            <ul class="pagination justify-content-center mb-0">
                                <!-- Previous Page -->
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Previous page">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                
                                <!-- Page Numbers -->
                                <li class="page-item active">
                                    <a class="page-link" href="#" aria-label="Page 1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 2">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 3">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 4">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 5">5</a>
                                </li>
                                
                                <!-- Next Page -->
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next page">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        
                        <!-- Pagination Info -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Showing 1-6 of 24 blog posts
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Include the footer component
    include '../components/footer/footer.php';
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Force Red Colors Script - Fallback for Hostinger -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Force red color for all primary text elements
            const primaryTextElements = document.querySelectorAll('.text-primary');
            primaryTextElements.forEach(function(element) {
                element.style.color = '#d10000';
            });

            // Force red background for all primary background elements
            const primaryBgElements = document.querySelectorAll('.bg-primary');
            primaryBgElements.forEach(function(element) {
                element.style.backgroundColor = '#d10000';
            });

            // Force red border for all primary border elements
            const primaryBorderElements = document.querySelectorAll('.border-primary, .border-start-primary');
            primaryBorderElements.forEach(function(element) {
                element.style.borderColor = '#d10000';
            });

            // Force red for primary buttons
            const primaryButtons = document.querySelectorAll('.btn-primary');
            primaryButtons.forEach(function(element) {
                element.style.backgroundColor = '#d10000';
                element.style.borderColor = '#d10000';
                element.style.color = '#fff';
            });

            // Force red for outline primary buttons
            const outlinePrimaryButtons = document.querySelectorAll('.btn-outline-primary');
            outlinePrimaryButtons.forEach(function(element) {
                element.style.color = '#d10000';
                element.style.borderColor = '#d10000';
            });

            // Force red background with opacity
            const bgOpacityElements = document.querySelectorAll('.bg-primary.bg-opacity-10');
            bgOpacityElements.forEach(function(element) {
                element.style.backgroundColor = 'rgba(209, 0, 0, 0.1)';
            });

            console.log('Red color override script executed');
        });
    </script>
</body>
</html> 