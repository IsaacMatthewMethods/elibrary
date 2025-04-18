<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' : ''; ?><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animations.css">
</head>
<body>
    <div class="page-loader"></div>
    
    <header class="main-header">
        <div class="container">
            <a href="/" class="logo">
                <i class="fas fa-book-open"></i>
                <span><?php echo SITE_NAME; ?></span>
            </a>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="/books/browse.php">Browse Books</a></li>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <?php if($_SESSION['role'] === 'admin'): ?>
                            <li><a href="/admin/dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="user-menu">
                            <a href="#" class="user-toggle">
                                <span><?php echo $_SESSION['username']; ?></span>
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <ul class="dropdown">
                                <li><a href="/profile.php">Profile</a></li>
                                <li><a href="/auth/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="/auth/login.php" class="btn btn-outline">Login</a></li>
                        <li><a href="/auth/register.php" class="btn btn-primary">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            
            <button class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
    
    <div class="mobile-menu">
        <ul>
            <li><a href="/books/browse.php">Browse Books</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if($_SESSION['role'] === 'admin'): ?>
                    <li><a href="/admin/dashboard.php">Dashboard</a></li>
                <?php endif; ?>
                <li><a href="/profile.php">Profile</a></li>
                <li><a href="/auth/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="/auth/login.php">Login</a></li>
                <li><a href="/auth/register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
    <main class="container">