<?php
include '../includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: /books/browse.php");
    exit();
}

$book_id = intval($_GET['id']);
$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: /books/browse.php");
    exit();
}

$book = $result->fetch_assoc();

// Record view if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT INTO book_views (book_id, user_id) VALUES ($book_id, $user_id)");
}
?>

<?php include '../includes/header.php'; ?>

<div class="book-reader-container">
    <div class="reader-header">
        <h1><?php echo $book['title']; ?></h1>
        <p>by <?php echo $book['author']; ?></p>
        
        <div class="reader-actions">
            <button id="prev-page" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Previous
            </button>
            <span id="page-info">Page 1 of 10</span>
            <button id="next-page" class="btn btn-outline">
                Next <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
    
    <div class="reader-content">
        <?php if (pathinfo($book['file_path'], PATHINFO_EXTENSION) === 'pdf'): ?>
            <embed src="<?php echo $book['file_path']; ?>" type="application/pdf" width="100%" height="600px">
        <?php else: ?>
            <div class="text-content">
                <?php 
                // For text/HTML content
                echo file_get_contents($book['file_path']); 
                ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="reader-footer">
        <div class="bookmark-actions">
            <button id="add-bookmark" class="btn btn-outline">
                <i class="far fa-bookmark"></i> Bookmark
            </button>
            <button id="add-note" class="btn btn-outline">
                <i class="far fa-sticky-note"></i> Add Note
            </button>
        </div>
    </div>
</div>

<script src="/assets/js/reader.js"></script>

<?php include '../includes/footer.php'; ?>