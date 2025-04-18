document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            this.innerHTML = mobileMenu.classList.contains('active') ? 
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });
    }
    
    // User dropdown for mobile
    const userToggle = document.querySelector('.user-toggle');
    if (userToggle) {
        userToggle.addEventListener('click', function(e) {
            e.preventDefault();
            this.parentElement.classList.toggle('active');
        });
    }
    
    // Hide loader when page is loaded
    const loader = document.querySelector('.page-loader');
    if (loader) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 300);
            }, 500);
        });
    }
    
    // Book reader functionality
    if (document.querySelector('.book-reader-container')) {
        let currentPage = 1;
        const totalPages = 10; // This should come from the server
        
        document.getElementById('prev-page').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updatePageInfo();
            }
        });
        
        document.getElementById('next-page').addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                updatePageInfo();
            }
        });
        
        function updatePageInfo() {
            document.getElementById('page-info').textContent = `Page ${currentPage} of ${totalPages}`;
        }
        
        // Bookmark functionality
        document.getElementById('add-bookmark').addEventListener('click', function() {
            if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
                alert('Please login to bookmark pages');
                return;
            }
            
            this.innerHTML = '<i class="fas fa-bookmark"></i> Bookmarked';
            setTimeout(() => {
                this.innerHTML = '<i class="far fa-bookmark"></i> Bookmark';
            }, 2000);
            
            // Here you would send an AJAX request to save the bookmark
        });
    }
    
    // Search functionality
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = this.querySelector('input').value.trim();
            if (query) {
                window.location.href = `/books/browse.php?search=${encodeURIComponent(query)}`;
            }
        });
    }
});