// Micro-interactions for UI elements
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        // Ripple effect
        const ripple = document.createElement('span');
        ripple.classList.add('ripple');
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 500);
    });
});

// Hover effects for cards
document.querySelectorAll('.book-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-5px)';
    });
    
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
    });
});