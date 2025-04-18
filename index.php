<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="hero-section">
    <div class="hero-content">
        <h1>Welcome to KadPoly eLibrary</h1>
        <p>Access thousands of books anytime, anywhere</p>
        <a href="/books/browse.php" class="btn btn-primary">Browse Books</a>
    </div>
    <div class="hero-image">
        <img src="/assets/images/hero-books.png" alt="Books">
    </div>
</div>

<section class="featured-books">
    <h2>Featured Books</h2>
    <div class="book-grid">
        <?php
        $query = "SELECT * FROM books ORDER BY upload_date DESC LIMIT 6";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="book-card">
                    <div class="book-cover">
                        <img src="'.($row['cover_image'] ?: 'assets/images/default-cover.jpg').'" alt="'.$row['title'].'">
                    </div>
                    <div class="book-info">
                        <h3 class="book-title">'.$row['title'].'</h3>
                        <p class="book-author">'.$row['author'].'</p>
                        <div class="book-actions">
                            <a href="/books/reader.php?id='.$row['id'].'" class="btn btn-outline">Read</a>
                            <a href="#" class="btn btn-primary">Borrow</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No books available yet.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>