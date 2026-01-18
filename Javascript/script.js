document.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');

    burger.addEventListener('click', () => {
        nav.classList.toggle('active');
        burger.classList.toggle('toggle');
    });
    
    // FAQ Accordion Functionality
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });
    
    // Reviews Carousel Functionality
    const reviewsTrack = document.querySelector('.reviews-track');
    const reviewCards = document.querySelectorAll('.review-card');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    
    if (reviewsTrack && reviewCards.length > 0) {
        let currentIndex = 0;
        const totalCards = reviewCards.length;
        
        function getCardsPerView() {
            if (window.innerWidth <= 768) return 1;
            if (window.innerWidth <= 992) return 2;
            return 3;
        }
        
        function updateCarousel() {
            const cardsPerView = getCardsPerView();
            const maxIndex = Math.max(0, totalCards - cardsPerView);
            
            // Calculate translateX based on card width and gap
            const cardWidth = reviewCards[0].offsetWidth;
            const gap = 30;
            const translateX = -(currentIndex * (cardWidth + gap));
            reviewsTrack.style.transform = `translateX(${translateX}px)`;
            
            // Update button states
            if (prevBtn) {
                prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
                prevBtn.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
            }
            if (nextBtn) {
                nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
                nextBtn.style.cursor = currentIndex >= maxIndex ? 'not-allowed' : 'pointer';
            }
        }
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                const cardsPerView = getCardsPerView();
                const maxIndex = Math.max(0, totalCards - cardsPerView);
                if (currentIndex < maxIndex) {
                    currentIndex++;
                    updateCarousel();
                }
            });
        }
        
        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                const cardsPerView = getCardsPerView();
                const maxIndex = Math.max(0, totalCards - cardsPerView);
                if (currentIndex > maxIndex) {
                    currentIndex = maxIndex;
                }
                updateCarousel();
            }, 250);
        });
        
        // Initialize on load
        setTimeout(() => {
            updateCarousel();
        }, 100);
    }
});

// Simple form validation confirmation
function confirmSubmission() {
    return confirm("Are you sure your details are correct?");
}