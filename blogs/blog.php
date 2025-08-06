<?php
// Include database connection
require_once '../includes/db_connect.php';

// Disable caching to ensure fresh data
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Get current page from URL parameter
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$posts_per_page = 6; // Number of posts per page

// Calculate offset
$offset = ($current_page - 1) * $posts_per_page;

// Fetch blogs directly from database
try {
    // Check table structure
    $structureQuery = "DESCRIBE blogs";
    $structureResult = $conn->query($structureQuery);
    $availableColumns = [];
    if ($structureResult) {
        while ($field = $structureResult->fetch_assoc()) {
            $availableColumns[] = $field['Field'];
        }
    }
    
    // Count total blogs
    $countQuery = "SELECT COUNT(*) as total FROM blogs";
    $countResult = $conn->query($countQuery);
    
    if (!$countResult) {
        throw new Exception("Count query failed: " . $conn->error);
    }
    
    $totalRows = $countResult->fetch_assoc()['total'];
    
    // Build dynamic query based on available columns
    $selectColumns = ['id', 'title', 'content'];
    
    // Add optional columns if they exist
    if (in_array('excerpt', $availableColumns)) $selectColumns[] = 'excerpt';
    if (in_array('image_url', $availableColumns)) $selectColumns[] = 'image_url';
    if (in_array('slug', $availableColumns)) $selectColumns[] = 'slug';
    if (in_array('categories', $availableColumns)) $selectColumns[] = 'categories';
    if (in_array('created_at', $availableColumns)) $selectColumns[] = 'created_at';
    if (in_array('image_alt', $availableColumns)) $selectColumns[] = 'image_alt';
    
    // Fetch blogs with pagination
    $query = "SELECT " . implode(', ', $selectColumns) . " 
              FROM blogs 
              ORDER BY " . (in_array('created_at', $availableColumns) ? 'created_at' : 'id') . " DESC 
              LIMIT $posts_per_page OFFSET $offset";
    
    $result = $conn->query($query);
    
    if ($result) {
        $blogs = [];
        while ($row = $result->fetch_assoc()) {
            // Format date
            if (isset($row['created_at'])) {
                $date = new DateTime($row['created_at']);
                $row['formatted_date'] = $date->format('M d, Y');
            } else {
                $row['formatted_date'] = 'N/A';
            }
            
            // Handle categories
            if (isset($row['categories']) && !empty($row['categories'])) {
                if (strpos($row['categories'], '[') === 0) {
                    // JSON format
                    $row['categories'] = json_decode($row['categories'], true) ?: [];
                } else {
                    // Comma-separated format
                    $row['categories'] = explode(',', $row['categories']);
                }
            } else {
                $row['categories'] = [];
            }
            
            // Generate excerpt if not present
            if (!isset($row['excerpt']) && isset($row['content'])) {
                $row['excerpt'] = substr(strip_tags($row['content']), 0, 150) . '...';
            }
            
            $blogs[] = $row;
        }
        
        // Calculate pagination
        $totalPages = ceil($totalRows / $posts_per_page);
        $pagination = [
            'current_page' => $current_page,
            'total_pages' => $totalPages,
            'total_rows' => $totalRows
        ];
    } else {
        throw new Exception("Database query failed");
    }
} catch (Exception $e) {
    // Fallback if database fails
    $blogs = [];
    $pagination = [
        'current_page' => 1,
        'total_pages' => 1,
        'total_rows' => 0
    ];
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

// Function to truncate text
function truncateText($text, $length = 150) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}
?>
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
            height: 100%;
            display: flex;
            flex-direction: column;
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
            font-size: 1.1rem;
            line-height: 1.4;
            margin-bottom: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ezy__blog7_uzmYkEn6-description {
            color: var(--bs-body-color);
            opacity: 0.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
            margin-bottom: 1rem;
            flex-grow: 1;
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

        /* Category Tags */
        .blog-category-tag {
            display: inline-block;
            background-color: rgba(var(--ezy-theme-color-rgb), 0.1);
            color: var(--ezy-theme-color);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            margin: 0.1rem;
            border-radius: 0.25rem;
            font-weight: 500;
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

        /* No posts message */
        .no-posts {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .no-posts i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
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
                        <!-- <a href="#" class="btn ezy__blog7_uzmYkEn6-btn">
                            <i class="fas fa-plus me-2"></i>Explore All Posts
                        </a> -->
                    </div>
                </div>
                
                <?php if (empty($blogs)): ?>
                <!-- No Posts Message -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="no-posts">
                            <i class="fas fa-newspaper"></i>
                            <h3>No Blog Posts Available</h3>
                            <p>We're working on creating amazing content for you. Check back soon!</p>
                            

                        </div>
                    </div>
                </div>
                <?php else: ?>
                <!-- Blog Posts Grid -->
                <div class="row mt-5">
                    <?php foreach ($blogs as $blog): ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <article class="ezy__blog7_uzmYkEn6-post">
                            <div class="position-relative">
                                <img
                                    src="<?php echo !empty($blog['image_url']) ? htmlspecialchars($blog['image_url']) : 'https://cdn.easyfrontend.com/pictures/blog/blog_3.jpg'; ?>"
                                    alt="<?php echo htmlspecialchars($blog['title']); ?>"
                                    class="img-fluid w-100 ezy-blog7-banner"
                                    style="height: 200px; object-fit: cover; object-position: center;"
                                />
                                <?php if (isset($blog['created_at'])): ?>
                                <?php $date = formatDate($blog['created_at']); ?>
                                <div class="px-4 py-3 ezy__blog7_uzmYkEn6-calendar">
                                    <?php echo $date['day']; ?><br />
                                    <?php echo $date['month']; ?><br />
                                    <?php echo $date['year']; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-3 p-md-4 d-flex flex-column h-100">
                                <p class="ezy__blog7_uzmYkEn6-author">
                                    By <a href="#" class="text-decoration-none">Sortout Innovation</a>
                                </p>
                                
                                <!-- Category Tags -->
                                <?php if (!empty($blog['categories'])): ?>
                                <div class="mb-2">
                                    <?php 
                                    $categories = is_array($blog['categories']) ? $blog['categories'] : explode(',', $blog['categories']);
                                    foreach (array_slice($categories, 0, 2) as $category): // Show max 2 categories
                                    ?>
                                    <span class="blog-category-tag"><?php echo htmlspecialchars(trim($category)); ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                
                                <h4 class="mt-3 ezy__blog7_uzmYkEn6-title fs-4">
                                    <?php echo htmlspecialchars($blog['title']); ?>
                                </h4>
                                <p class="ezy__blog7_uzmYkEn6-description mt-3 mb-4">
                                    <?php 
                                    $excerpt = !empty($blog['excerpt']) ? $blog['excerpt'] : $blog['content'];
                                    $cleanExcerpt = html_entity_decode(strip_tags($excerpt), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                                    echo htmlspecialchars(truncateText($cleanExcerpt, 120));
                                    ?>
                                </p>
                                <a href="/blogs/blog-detail.php?slug=<?php echo urlencode($blog['slug']); ?>" class="btn ezy__blog7_uzmYkEn6-btn-read-more mt-auto">
                                    <i class="fas fa-arrow-right me-1"></i>Read More
                                </a>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($pagination['total_pages'] > 1): ?>
                <div class="row mt-5">
                    <div class="col-12">
                        <nav aria-label="Blog pagination">
                            <ul class="pagination justify-content-center mb-0">
                                <!-- Previous Page -->
                                <li class="page-item <?php echo ($pagination['current_page'] <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $pagination['current_page'] - 1; ?>" 
                                       <?php echo ($pagination['current_page'] <= 1) ? 'tabindex="-1" aria-disabled="true"' : ''; ?> 
                                       aria-label="Previous page">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                
                                <!-- Page Numbers -->
                                <?php
                                $start_page = max(1, $pagination['current_page'] - 2);
                                $end_page = min($pagination['total_pages'], $pagination['current_page'] + 2);
                                
                                // Show first page if not in range
                                if ($start_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=1" aria-label="Page 1">1</a>
                                </li>
                                <?php if ($start_page > 2): ?>
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                                <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <li class="page-item <?php echo ($i == $pagination['current_page']) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>" aria-label="Page <?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                                <?php endfor; ?>
                                
                                <!-- Show last page if not in range -->
                                <?php if ($end_page < $pagination['total_pages']): ?>
                                <?php if ($end_page < $pagination['total_pages'] - 1): ?>
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                                <?php endif; ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $pagination['total_pages']; ?>" aria-label="Page <?php echo $pagination['total_pages']; ?>"><?php echo $pagination['total_pages']; ?></a>
                                </li>
                                <?php endif; ?>
                                
                                <!-- Next Page -->
                                <li class="page-item <?php echo ($pagination['current_page'] >= $pagination['total_pages']) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $pagination['current_page'] + 1; ?>" 
                                       <?php echo ($pagination['current_page'] >= $pagination['total_pages']) ? 'aria-disabled="true"' : ''; ?> 
                                       aria-label="Next page">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        
                        <!-- Pagination Info -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Showing <?php echo (($pagination['current_page'] - 1) * $posts_per_page) + 1; ?>-<?php echo min($pagination['current_page'] * $posts_per_page, $pagination['total_rows']); ?> of <?php echo $pagination['total_rows']; ?> blog posts
                            </small>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
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