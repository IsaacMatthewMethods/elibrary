<?php
include '../includes/config.php';
include '../includes/header.php';

$search = $_GET['search'] ?? '';
$books = get_all_books($search);
?>

<div class="search-bar">
    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search books..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>

<div class="book-grid">
    <?php if ($books->num_rows > 0): ?>
        <?php while ($book = $books->fetch_assoc()): ?>
            <div class="book-card">
                <!-- Book card content (same as index.php) -->
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-results">No books found<?php echo $search ? ' for "' . htmlspecialchars($search) . '"' : ''; ?>.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>