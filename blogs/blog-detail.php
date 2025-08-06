<?php
// Include database connection
require_once '../includes/db_connect.php';

// Disable caching to ensure fresh data
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Get blog slug from URL parameter
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Fetch blog details
$blog = null;
$popularBlogs = [];

try {
    // First check table structure (always do this)
    $structureQuery = "DESCRIBE blogs";
    $structureResult = $conn->query($structureQuery);
    $availableColumns = [];
    if ($structureResult) {
        while ($field = $structureResult->fetch_assoc()) {
            $availableColumns[] = $field['Field'];
        }
    }
    
    if (!empty($slug)) {
        
        // Build dynamic query based on available columns
        $selectColumns = ['id', 'title', 'content'];
        
        // Add optional columns if they exist
        if (in_array('excerpt', $availableColumns)) $selectColumns[] = 'excerpt';
        if (in_array('image_url', $availableColumns)) $selectColumns[] = 'image_url';
        if (in_array('slug', $availableColumns)) $selectColumns[] = 'slug';
        if (in_array('categories', $availableColumns)) $selectColumns[] = 'categories';
        if (in_array('created_at', $availableColumns)) $selectColumns[] = 'created_at';
        if (in_array('image_alt', $availableColumns)) $selectColumns[] = 'image_alt';
        if (in_array('author', $availableColumns)) $selectColumns[] = 'author';
        
        // Fetch specific blog by slug
        $query = "SELECT " . implode(', ', $selectColumns) . " 
                  FROM blogs 
                  WHERE slug = ? 
                  LIMIT 1";
        
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        
        if ($result && $result->num_rows > 0) {
            $blog = $result->fetch_assoc();
            
            // Format date
            if (isset($blog['created_at'])) {
                $date = new DateTime($blog['created_at']);
                $blog['formatted_date'] = $date->format('F jS, Y');
                $blog['short_date'] = $date->format('M j');
            }
            
            // Handle categories
            if (isset($blog['categories']) && !empty($blog['categories'])) {
                if (strpos($blog['categories'], '[') === 0) {
                    $blog['categories'] = json_decode($blog['categories'], true) ?: [];
                } else {
                    $blog['categories'] = explode(',', $blog['categories']);
                }
            } else {
                $blog['categories'] = [];
            }
            
            // Set default author if not present
            if (empty($blog['author'])) {
                $blog['author'] = 'Sortout Innovation';
            }
        }
    }
    
    // Fetch popular blogs for sidebar
    $popularSelectColumns = ['id', 'title'];
    
    // Add optional columns if they exist
    if (in_array('image_url', $availableColumns)) $popularSelectColumns[] = 'image_url';
    if (in_array('created_at', $availableColumns)) $popularSelectColumns[] = 'created_at';
    if (in_array('author', $availableColumns)) $popularSelectColumns[] = 'author';
    if (in_array('slug', $availableColumns)) $popularSelectColumns[] = 'slug';
    
    $popularQuery = "SELECT " . implode(', ', $popularSelectColumns) . " 
                     FROM blogs 
                     WHERE id != ? 
                     ORDER BY " . (in_array('created_at', $availableColumns) ? 'created_at' : 'id') . " DESC 
                     LIMIT 5";
    
    $popularStmt = $conn->prepare($popularQuery);
    if ($popularStmt) {
        $blogId = $blog ? $blog['id'] : 0;
        $popularStmt->bind_param("i", $blogId);
        $popularStmt->execute();
        $popularResult = $popularStmt->get_result();
    } else {
        throw new Exception("Popular blogs prepare statement failed: " . $conn->error);
    }
    
    if ($popularResult) {
        while ($row = $popularResult->fetch_assoc()) {
            // Format date for popular blogs
            if (isset($row['created_at'])) {
                $date = new DateTime($row['created_at']);
                $row['formatted_date'] = $date->format('M j');
            }
            
            // Set default author if not present
            if (empty($row['author'])) {
                $row['author'] = 'Sortout Innovation';
            }
            
            $popularBlogs[] = $row;
        }
    }
    
} catch (Exception $e) {
    // Handle error silently
    error_log("Blog detail error: " . $e->getMessage());
}

// If no blog found, redirect to blog listing
if (!$blog) {
    header("Location: blog.php");
    exit;
}

// Function to format date
function formatDate($date_string) {
    $date = new DateTime($date_string);
    return [
        'day' => $date->format('d'),
        'month' => $date->format('M'),
        'year' => $date->format('Y')
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog['title']); ?> - Sortout Innovation</title>
    
    <!-- SEO Meta Description -->
    <meta name="description" content="<?php echo htmlspecialchars(substr(strip_tags($blog['content']), 0, 160)); ?>..." />
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo htmlspecialchars($blog['title']); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars(substr(strip_tags($blog['content']), 0, 160)); ?>..." />
    <meta property="og:url" content="https://sortoutinnovation.com/blog/detail.php?slug=<?php echo urlencode($blog['slug']); ?>" />
    <meta property="og:image" content="<?php echo htmlspecialchars($blog['image_url']); ?>" />
    <meta property="article:published_time" content="<?php echo $blog['created_at']; ?>" />
    <meta property="article:author" content="<?php echo htmlspecialchars($blog['author']); ?>" />
    
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
    
    <!-- Blog Detail Specific CSS -->
    <style>
        .ezy__blogdetails2_f7S9fPCj {
            /* Bootstrap variables */
            --bs-body-bg: rgb(255, 255, 255);

            /* Easy Frontend variables */
            --ezy-theme-color: rgb(209, 0, 0);
            --ezy-theme-color-rgb: 209, 0, 0;
            --ezy-blog-top-color: #21252d;
            --ezy-card-shadow: 0 10px 75px rgba(186, 204, 220, 0.33);

            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            overflow: hidden;
            padding: 60px 0;
            position: relative;
        }

        @media (min-width: 768px) {
            .ezy__blogdetails2_f7S9fPCj {
                padding: 100px 0;
            }
        }

        /* Gray Block Style */
        .gray .ezy__blogdetails2_f7S9fPCj,
        .ezy__blogdetails2_f7S9fPCj.gray {
            /* Bootstrap variables */
            --bs-body-bg: rgb(246, 246, 246);
        }

        /* Dark Gray Block Style */
        .dark-gray .ezy__blogdetails2_f7S9fPCj,
        .ezy__blogdetails2_f7S9fPCj.dark-gray {
            /* Bootstrap variables */
            --bs-body-color: #ffffff;
            --bs-body-bg: rgb(30, 39, 53);

            /* Easy Frontend variables */
            --ezy-blog-top-color: rgb(11, 23, 39);
            --ezy-card-shadow: 0 10px 75px rgba(0, 0, 0, 0.33);
        }

        /* Dark Block Style */
        .dark .ezy__blogdetails2_f7S9fPCj,
        .ezy__blogdetails2_f7S9fPCj.dark {
            /* Bootstrap variables */
            --bs-body-color: #ffffff;
            --bs-body-bg: rgb(11, 23, 39);

            /* Easy Frontend variables */
            --ezy-blog-top-color: rgb(30, 39, 53);
            --ezy-card-shadow: 0 10px 75px rgba(0, 0, 0, 0.63);
        }

        .ezy__blogdetails2_f7S9fPCj-heading {
            font-weight: 700;
            font-size: 25px;
            line-height: 1.2;
            color: var(--bs-body-color);
        }

        @media (min-width: 768px) {
            .ezy__blogdetails2_f7S9fPCj-heading {
                font-size: 45px;
            }
        }

        .ezy__blogdetails2_f7S9fPCj-sub-heading {
            font-size: 18px;
            line-height: 25px;
            opacity: 0.8;
        }

        .ezy__blogdetails2_f7S9fPCj-social a {
            color: var(--bs-body-color);
            font-size: 22px;
            transition: color 0.3s ease;
        }

        .ezy__blogdetails2_f7S9fPCj-social a:hover {
            color: var(--ezy-theme-color);
        }

        /* sidebar */
        .ezy__blogdetails2_f7S9fPCj-posts {
            overflow: hidden;
            box-shadow: var(--ezy-card-shadow);
            background-color: var(--bs-body-bg);
            border-radius: 10px;
        }

        .ezy__blogdetails2_f7S9fPCj-posts .card-header {
            background-color: var(--ezy-blog-top-color);
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .ezy__blogdetails2_f7S9fPCj hr {
            color: rgba(var(--ezy-theme-color-rgb), 0.6);
        }

        /* Content style */
        .ezy__blogdetails2_f7S9fPCj-content,
        .ezy__blogdetails2_f7S9fPCj-content p {
            color: var(--bs-body-color);
            font-size: 17px;
            line-height: 1.8;
            opacity: 0.9;
        }

        .ezy__blogdetails2_f7S9fPCj-content h5 {
            color: var(--bs-body-color);
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        /* Popular blog items */
        .ezy__blogdetails2_f7S9fPCj-item {
            transition: all 0.3s ease;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            border: 1px solid rgba(var(--ezy-theme-color-rgb), 0.1);
            position: relative;
            overflow: hidden;
        }

        .ezy__blogdetails2_f7S9fPCj-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(var(--ezy-theme-color-rgb), 0.1), transparent);
            transition: left 0.5s ease;
        }

        .ezy__blogdetails2_f7S9fPCj-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(var(--ezy-theme-color-rgb), 0.15);
            border-color: rgba(var(--ezy-theme-color-rgb), 0.3);
        }

        .ezy__blogdetails2_f7S9fPCj-item:hover::before {
            left: 100%;
        }

        .ezy__blogdetails2_f7S9fPCj-item img {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .ezy__blogdetails2_f7S9fPCj-item:hover img {
            transform: scale(1.05);
        }

        .ezy__blogdetails2_f7S9fPCj-item h6 {
            font-size: 15px;
            line-height: 1.4;
            margin-bottom: 8px;
            color: var(--bs-body-color);
            font-weight: 600;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ezy__blogdetails2_f7S9fPCj-item .blog-meta {
            font-size: 12px;
            color: rgba(var(--bs-body-color-rgb), 0.7);
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .ezy__blogdetails2_f7S9fPCj-item .blog-meta i {
            color: var(--ezy-theme-color);
            font-size: 10px;
        }

        .ezy__blogdetails2_f7S9fPCj-item .blog-meta b {
            color: var(--ezy-theme-color);
            font-weight: 600;
        }

        /* Popular blogs card enhancements */
        .ezy__blogdetails2_f7S9fPCj-posts {
            position: relative;
            overflow: hidden;
        }

        .ezy__blogdetails2_f7S9fPCj-posts::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--ezy-theme-color), #b30000, var(--ezy-theme-color));
            background-size: 200% 100%;
            animation: shimmer 2s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .ezy__blogdetails2_f7S9fPCj-posts .card-header {
            position: relative;
            background: linear-gradient(135deg, var(--ezy-blog-top-color) 0%, #2a3441 100%);
            border-bottom: 2px solid rgba(var(--ezy-theme-color-rgb), 0.3);
        }

        .ezy__blogdetails2_f7S9fPCj-posts .card-header h5 {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 16px;
        }

        .ezy__blogdetails2_f7S9fPCj-posts .card-body {
            padding: 20px;
        }

        /* Empty state styling */
        .no-blogs-message {
            text-align: center;
            padding: 40px 20px;
            color: rgba(var(--bs-body-color-rgb), 0.6);
        }

        .no-blogs-message i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .no-blogs-message h6 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .no-blogs-message p {
            font-size: 14px;
            margin: 0;
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

        /* Author info */
        .author-info img {
            width: 47px;
            height: 47px;
            object-fit: cover;
        }

        .author-info p {
            margin-bottom: 0;
            font-size: 14px;
        }

        .author-info b {
            color: var(--ezy-theme-color);
        }

        /* Main blog image */
        .blog-main-image {
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .ezy__blogdetails2_f7S9fPCj-social {
                margin-top: 1rem;
            }
            
            .ezy__blogdetails2_f7S9fPCj-heading {
                font-size: 28px;
            }

            /* Mobile responsive popular blogs */
            .ezy__blogdetails2_f7S9fPCj-item {
                padding: 12px;
                margin-bottom: 12px;
            }

            .ezy__blogdetails2_f7S9fPCj-item img {
                width: 70px;
                height: 55px;
            }

            .ezy__blogdetails2_f7S9fPCj-item h6 {
                font-size: 14px;
                -webkit-line-clamp: 2;
            }

            .ezy__blogdetails2_f7S9fPCj-item .blog-meta {
                font-size: 11px;
                gap: 6px;
            }

            .ezy__blogdetails2_f7S9fPCj-posts .card-body {
                padding: 15px;
            }

            .ezy__blogdetails2_f7S9fPCj-posts .card-header h5 {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .ezy__blogdetails2_f7S9fPCj-item {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .ezy__blogdetails2_f7S9fPCj-item img {
                width: 100%;
                height: 120px;
                margin-bottom: 12px;
            }

            .ezy__blogdetails2_f7S9fPCj-item .ms-3 {
                margin-left: 0 !important;
                width: 100%;
            }

            .ezy__blogdetails2_f7S9fPCj-item h6 {
                font-size: 16px;
                margin-bottom: 10px;
            }

            .ezy__blogdetails2_f7S9fPCj-item .blog-meta {
                justify-content: center;
                font-size: 12px;
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
                    <li class="breadcrumb-item"><a href="/blogs/blog.php">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars(substr($blog['title'], 0, 30)); ?>...</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blog Detail Content Section -->
    <section class="ezy__blogdetails2_f7S9fPCj" id="ezy__blogdetails2_f7S9fPCj">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h1 class="ezy__blogdetails2_f7S9fPCj-heading"><?php echo htmlspecialchars($blog['title']); ?></h1>

                    <div class="d-flex justify-content-between my-5 me-5">
                        <div class="d-flex align-items-center author-info">
                            <!-- <div class="me-2">
                                <img
                                    src="https://cdn.easyfrontend.com/pictures/testimonial/testimonial_square_3.jpeg"
                                    alt="<?php echo htmlspecialchars($blog['author']); ?>"
                                    class="img-fluid rounded-circle border"
                                    width="47"
                                />
                            </div> -->
                            <div>
                                <p class="mb-0">By <b><?php echo htmlspecialchars($blog['author']); ?></b></p>
                            </div>
                            <p class="mb-0 ms-3"><?php echo $blog['formatted_date']; ?></p>
                        </div>
                        <div class="ezy__blogdetails2_f7S9fPCj-social">
                            <ul class="nav ezy__footer13_f7S9fPCj-quick-links">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://sortoutinnovation.com/blog/detail.php?slug=' . $blog['slug']); ?>" target="_blank"><i class="fab fa-facebook me-3"></i></a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://sortoutinnovation.com/blog/detail.php?slug=' . $blog['slug']); ?>&text=<?php echo urlencode($blog['title']); ?>" target="_blank"><i class="fab fa-twitter me-3"></i></a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('https://sortoutinnovation.com/blog/detail.php?slug=' . $blog['slug']); ?>" target="_blank"><i class="fab fa-linkedin-in me-3"></i></a>
                                <a href="https://wa.me/?text=<?php echo urlencode($blog['title'] . ' - https://sortoutinnovation.com/blog/detail.php?slug=' . $blog['slug']); ?>" target="_blank"><i class="fab fa-whatsapp me-3"></i></a>
                                <a href="#" onclick="navigator.share({title: '<?php echo addslashes($blog['title']); ?>', url: 'https://sortoutinnovation.com/blog/detail.php?slug=<?php echo $blog['slug']; ?>'})"><i class="fas fa-share-alt me-3"></i></a>
                                <a href="#" onclick="bookmarkPage()"><i class="fas fa-bookmark"></i></a>
                            </ul>
                        </div>
                    </div>

                    <?php if (!empty($blog['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($blog['image_url']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="img-fluid rounded blog-main-image" />
                    <?php endif; ?>

                    <div class="ezy__blogdetails2_f7S9fPCj-content mt-5">
                        <?php 
                        // Clean and display content properly
                        $cleanContent = html_entity_decode($blog['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        
                        // Remove data attributes and clean up HTML
                        $cleanContent = preg_replace('/\s+data-[^=]*="[^"]*"/', '', $cleanContent);
                        $cleanContent = preg_replace('/\s+class=""/', '', $cleanContent);
                        
                        // Display the cleaned HTML content
                        echo $cleanContent;
                        ?>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card ezy__blogdetails2_f7S9fPCj-posts border-0">
                        <div class="card-header py-3 border-0">
                            <h5 class="mb-0">Popular Blogs</h5>
                        </div>
                        <div class="card-body py-4">
                            <?php if (!empty($popularBlogs)): ?>
                                <?php foreach ($popularBlogs as $popularBlog): ?>
                                <!-- blog item -->
                                <div class="ezy__blogdetails2_f7S9fPCj-item d-flex justify-content-between align-items-start">
                                    <img
                                        src="<?php echo !empty($popularBlog['image_url']) ? htmlspecialchars($popularBlog['image_url']) : 'https://cdn.easyfrontend.com/pictures/blog/blog_3.jpg'; ?>"
                                        alt="<?php echo htmlspecialchars($popularBlog['title']); ?>"
                                        class="img-fluid rounded"
                                    />
                                    <div class="ms-3">
                                        <h6>
                                            <a href="/blogs/blog-detail.php?slug=<?php echo urlencode($popularBlog['slug']); ?>" class="text-decoration-none">
                                                <?php echo htmlspecialchars(substr($popularBlog['title'], 0, 50)); ?>...
                                            </a>
                                        </h6>
                                        <div class="blog-meta">
                                            <span><i class="fas fa-calendar-alt"></i> <?php echo $popularBlog['formatted_date']; ?></span>
                                            <span><i class="fas fa-user"></i> By <b><?php echo htmlspecialchars($popularBlog['author']); ?></b></span>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="no-blogs-message">
                                    <i class="fas fa-newspaper"></i>
                                    <h6>No Other Blogs</h6>
                                    <p>Check back soon for more amazing content!</p>
                                </div>
                            <?php endif; ?>
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

    <!-- Share and Bookmark Scripts -->
    <script>
        function bookmarkPage() {
            if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox
                window.sidebar.addPanel(document.title, window.location.href, '');
            } else if (window.external && ('AddFavorite' in window.external)) { // IE
                window.external.AddFavorite(window.location.href, document.title);
            } else { // Other browsers
                alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
            }
        }

        // Modern Web Share API
        if (navigator.share) {
            document.querySelector('.fa-share-alt').parentElement.style.display = 'inline-block';
        } else {
            document.querySelector('.fa-share-alt').parentElement.style.display = 'none';
        }
    </script>

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