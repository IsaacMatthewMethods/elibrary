<?php
include '../../includes/config.php';
include '../../includes/auth_functions.php';

if (!is_logged_in() || $_SESSION['role'] !== 'admin') {
    header("Location: /auth/login.php");
    exit();
}

// Get stats
$books_count = $conn->query("SELECT COUNT(*) FROM books")->fetch_row()[0];
$users_count = $conn->query("SELECT COUNT(*) FROM users WHERE role = 'student'")->fetch_row()[0];
$borrows_count = $conn->query("SELECT COUNT(*) FROM book_borrows WHERE return_date IS NULL")->fetch_row()[0];
?>

<?php include '../../includes/header.php'; ?>

<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $books_count; ?></h3>
                <p>Total Books</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $users_count; ?></h3>
                <p>Registered Users</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo $borrows_count; ?></h3>
                <p>Active Borrows</p>
            </div>
        </div>
    </div>
    
    <div class="recent-activity">
        <h2>Recent Activity</h2>
        
        <div class="activity-list">
            <?php
            $query = "SELECT b.title, u.username, bb.borrow_date 
                      FROM book_borrows bb
                      JOIN books b ON bb.book_id = b.id
                      JOIN users u ON bb.user_id = u.id
                      ORDER BY bb.borrow_date DESC LIMIT 5";
            $result = $conn->query($query);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <div class="activity-details">
                            <p><strong>'.$row['username'].'</strong> borrowed <strong>'.$row['title'].'</strong></p>
                            <small>'.date('M j, Y', strtotime($row['borrow_date'])).'</small>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No recent activity.</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>