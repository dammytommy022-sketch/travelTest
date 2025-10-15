<style>
    /* Review Slider Styles - Scoped to avoid conflicts */
    .review-slider-container {
        background: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .review-slider-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 30%, rgba(13, 24, 131, 0.03) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(0, 168, 90, 0.03) 0%, transparent 50%);
        animation: subtle-move 15s ease-in-out infinite;
    }

    @keyframes subtle-move {
        0%, 100% { transform: translateX(0) translateY(0); }
        25% { transform: translateX(10px) translateY(-5px); }
        50% { transform: translateX(-5px) translateY(10px); }
        75% { transform: translateX(5px) translateY(-10px); }
    }

    .review-title {
        text-align: center;
        color: #0d1883;
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .review-subtitle {
        text-align: center;
        color: #666;
        font-size: 1.2rem;
        margin-bottom: 60px;
        font-weight: 400;
        position: relative;
        z-index: 2;
    }

    .review-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #0d1883, #00a85a);
        border-radius: 2px;
    }

    .review-slider-wrapper {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        z-index: 2;
    }

    .review-slider {
        position: relative;
        background: #ffffff;
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid rgba(13, 24, 131, 0.1);
    }

    .review-track {
        display: flex;
        transition: transform 0.7s cubic-bezier(0.25, 0.8, 0.25, 1);
        will-change: transform;
    }

    .review-card {
        flex: 0 0 100%;
        padding: 50px;
        background: #ffffff;
        position: relative;
        transform: translateY(30px);
        opacity: 0;
        transition: all 0.7s ease;
    }

    .review-card.active {
        transform: translateY(0);
        opacity: 1;
    }

    .review-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #0d1883, #00a85a);
    }

    .review-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .review-quote {
        font-size: 1.4rem;
        color: #333;
        line-height: 1.8;
        margin-bottom: 40px;
        font-style: italic;
        position: relative;
        padding: 0 40px;
    }

    .review-quote::before,
    .review-quote::after {
        content: '"';
        position: absolute;
        font-size: 4rem;
        color: #0d1883;
        opacity: 0.2;
        font-family: Georgia, serif;
        font-weight: bold;
    }

    .review-quote::before {
        top: -20px;
        left: 0;
    }

    .review-quote::after {
        bottom: -40px;
        right: 0;
    }

    .review-author {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .review-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d1883, #00a85a);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: bold;
        color: white;
        box-shadow: 0 8px 25px rgba(13, 24, 131, 0.3);
        position: relative;
        overflow: hidden;
    }

    .review-avatar::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(transparent, rgba(255,255,255,0.3), transparent);
        animation: rotate-shine 3s linear infinite;
    }

    @keyframes rotate-shine {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .review-author-info h4 {
        color: #0d1883;
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0 0 8px 0;
    }

    .review-author-info p {
        color: #666;
        font-size: 1rem;
        margin: 0;
        font-weight: 500;
    }

    .review-rating {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 25px;
    }

    .star {
        color: #ffa500;
        font-size: 24px;
        transition: all 0.3s ease;
        cursor: pointer;
        filter: drop-shadow(0 2px 4px rgba(255, 165, 0, 0.3));
    }

    .star:hover {
        transform: scale(1.3) rotate(15deg);
        filter: drop-shadow(0 4px 8px rgba(255, 165, 0, 0.5));
    }

    .review-service-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #0d1883, #00a85a);
        color: white;
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(13, 24, 131, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .review-service-tag:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(13, 24, 131, 0.4);
        color: white;
    }

    .review-service-tag::before {
        content: '✓';
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .review-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
        gap: 30px;
    }

    .review-btn {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #0d1883;
        color: #0d1883;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(13, 24, 131, 0.2);
        position: relative;
        overflow: hidden;
    }

    .review-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s ease;
    }

    .review-btn:hover {
        background: #0d1883;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(13, 24, 131, 0.4);
    }

    .review-btn:hover::before {
        left: 100%;
    }

    .review-btn:active {
        transform: scale(0.95);
    }

    .review-indicators {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .review-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: rgba(13, 24, 131, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        border: 2px solid transparent;
    }

    .review-dot.active {
        background: #0d1883;
        transform: scale(1.2);
        border-color: #00a85a;
        box-shadow: 0 0 0 3px rgba(0, 168, 90, 0.2);
    }

    .review-dot:hover {
        background: rgba(13, 24, 131, 0.5);
        transform: scale(1.1);
    }

    .review-counter {
        color: #666;
        font-size: 1rem;
        margin: 0 20px;
        font-weight: 600;
        background: rgba(13, 24, 131, 0.05);
        padding: 8px 16px;
        border-radius: 20px;
    }

    .review-counter .current {
        color: #0d1883;
        font-weight: 700;
    }

    /* Auto-play progress bar */
    .review-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, #0d1883, #00a85a);
        border-radius: 0 0 25px 25px;
        transition: width 0.1s linear;
        z-index: 10;
    }

    /* Decorative elements */
    .review-decoration {
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(13, 24, 131, 0.1), rgba(0, 168, 90, 0.1));
        animation: float 6s ease-in-out infinite;
    }

    .review-decoration:nth-child(1) {
        top: 10%;
        left: 5%;
        animation-delay: 0s;
    }

    .review-decoration:nth-child(2) {
        top: 60%;
        right: 10%;
        animation-delay: 2s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Review Form Button Styles */
    .review-form-toggle {
        display: block;
        margin: 20px auto;
        padding: 15px 30px;
        background: linear-gradient(90deg, #0d1883, #00a85a);
        color: white;
        border: none;
        border-radius: 30px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(13, 24, 131, 0.3);
    }

    .review-form-toggle:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(13, 24, 131, 0.4);
    }

    .review-form-toggle::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }

    .review-form-toggle:hover::before {
        left: 100%;
    }

    .review-form-toggle.active::after {
        content: '✕';
        position: absolute;
        right: 15px;
        font-size: 1.2rem;
    }

    .review-form-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        position: relative;
        z-index: 2;
        display: none;
        transform: scale(0.8);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .review-form-container.active {
        display: block;
        transform: scale(1);
        opacity: 1;
    }

    .review-form-title {
        font-size: 1.8rem;
        color: #0d1883;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 700;
    }

    .review-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .review-form input,
    .review-form textarea,
    .review-form select {
        padding: 12px;
        border: 1px solid rgba(13, 24, 131, 0.2);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .review-form input:focus,
    .review-form textarea:focus,
    .review-form select:focus {
        border-color: #0d1883;
        box-shadow: 0 0 8px rgba(13, 24, 131, 0.2);
        outline: none;
    }

    .review-form textarea {
        resize: vertical;
        min-height: 100px;
    }

    .review-form .rating-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-direction: row-reverse; /* Reverse for right-to-left hover effect */
    }

    .review-form .star-input {
        display: none;
    }

    .review-form .star-label {
        font-size: 24px;
        color: #ccc;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    /* Modified star rating hover and selection to count from left */
    .review-form .star-label:hover,
    .review-form .star-label:hover ~ .star-label,
    .review-form .star-input:checked ~ .star-label {
        color: #ffa500;
    }

    .review-form button {
        background: linear-gradient(90deg, #0d1883, #00a85a);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .review-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 24, 131, 0.3);
    }

    .review-form .error-message {
        color: #e74c3c;
        font-size: 0.9rem;
        display: none;
    }

    .review-form .success-message {
        color: #00a85a;
        font-size: 1rem;
        text-align: center;
        display: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .review-slider-container {
            padding: 60px 0;
        }
        
        .review-title {
            font-size: 2.2rem;
            margin-bottom: 15px;
        }
        
        .review-subtitle {
            font-size: 1rem;
            margin-bottom: 40px;
        }
        
        .review-card {
            padding: 30px 25px;
        }
        
        .review-quote {
            font-size: 1.2rem;
            padding: 0 25px;
            margin-bottom: 30px;
        }
        
        .review-author {
            flex-direction: column;
            gap: 15px;
        }
        
        .review-avatar {
            width: 70px;
            height: 70px;
            font-size: 24px;
        }
        
        .review-author-info h4 {
            font-size: 1.3rem;
        }
        
        .review-controls {
            margin-top: 40px;
            gap: 20px;
        }
        
        .review-btn {
            width: 50px;
            height: 50px;
            font-size: 18px;
        }
        
        .review-counter {
            margin: 0 15px;
            font-size: 0.9rem;
        }

        .review-form-container {
            padding: 20px;
        }

        .review-form-title {
            font-size: 1.5rem;
        }

        .review-form input,
        .review-form textarea,
        .review-form select {
            font-size: 0.9rem;
        }

        .review-form button {
            font-size: 0.9rem;
        }
    }

    /* Animation for card entrance */
    @keyframes slideInFromRight {
        from {
            transform: translateX(100px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInFromLeft {
        from {
            transform: translateX(-100px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .review-card.slide-in-right {
        animation: slideInFromRight 0.7s ease-out;
    }

    .review-card.slide-in-left {
        animation: slideInFromLeft 0.7s ease-out;
    }

    /* Hover effects for the entire card */
    .review-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.12);
    }
</style>

<section class="review-slider-container">
    <!-- Decorative elements -->
    <div class="review-decoration"></div>
    <div class="review-decoration"></div>

    <div class="review-slider-wrapper">
        <h2 class="review-title">Client Testimonials</h2>
        <p class="review-subtitle">Hear what our satisfied customers have to say about their experience</p>

        <!-- Review Form Toggle Button -->
        <button class="review-form-toggle" id="reviewFormToggle">Leave a Review</button>

        <!-- Review Submission Form -->
        <div class="review-form-container" id="reviewFormContainer">
            <h3 class="review-form-title">Leave a Review</h3>
            <div class="review-form">
                <form id="review-form" class="review-form">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="text" name="location" placeholder="Your Location" required>
                    <textarea name="review_text" placeholder="Your Review" required></textarea>
                    <div class="rating-container">
                        <input type="radio" name="rating" value="5" id="star5" class="star-input" checked>
                        <label for="star5" class="star-label">★</label>
                        <input type="radio" name="rating" value="4" id="star4" class="star-input">
                        <label for="star4" class="star-label">★</label>
                        <input type="radio" name="rating" value="3" id="star3" class="star-input">
                        <label for="star3" class="star-label">★</label>
                        <input type="radio" name="rating" value="2" id="star2" class="star-input">
                        <label for="star2" class="star-label">★</label>
                        <input type="radio" name="rating" value="1" id="star1" class="star-input">
                        <label for="star1" class="star-label">★</label>
                    </div>
                    <select name="service_type" required>
                        <option value="" disabled selected>Select Service</option>
                        <option value="Flight Booking Service">Flight Booking Service</option>
                        <option value="Hotel Booking Service">Hotel Booking Service</option>
                        <option value="Visa Assistance Service">Visa Assistance Service</option>
                        <option value="Airport Lounge Service">Airport Lounge Service</option>
                        <option value="Travel Insurance Service">Travel Insurance Service</option>
                        <option value="Protocol Service">Protocol Service</option>
                    </select>
                    <button type="submit">Submit Review</button>
                </form>
            </div>
            <div class="success-message"></div>
            <div class="error-message" id="errorMessage"></div>
        </div>

        <div class="review-slider">
            <div class="review-track" id="reviewTrack">
                <!-- Reviews will be dynamically inserted here -->
            </div>
            <div class="review-progress" id="reviewProgress"></div>
        </div>

        <div class="review-controls">
            <button class="review-btn" id="prevBtn">❮</button>
            <div class="review-indicators" id="reviewIndicators"></div>
            <span class="review-counter">
                <span class="current" id="currentSlide">1</span> / <span id="totalSlides">0</span>
            </span>
            <button class="review-btn" id="nextBtn">❯</button>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reviewTrack = document.getElementById('reviewTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const indicatorsContainer = document.getElementById('reviewIndicators');
        const currentSlideSpan = document.getElementById('currentSlide');
        const totalSlidesSpan = document.getElementById('totalSlides');
        const progressBar = document.getElementById('reviewProgress');
        const reviewForm = document.getElementById('review-form');
        const reviewFormContainer = document.getElementById('reviewFormContainer');
        const reviewFormToggle = document.getElementById('reviewFormToggle');
        const successMessage = document.querySelector('.success-message');
        const errorMessage = document.getElementById('errorMessage');

        let reviews = [];
        let currentSlide = 0;
        let autoPlayInterval;
        let progressInterval;
        let isAnimating = false;
        const autoPlayDelay = 6000;

        // Toggle review form visibility
        reviewFormToggle.addEventListener('click', () => {
            const isActive = reviewFormContainer.classList.toggle('active');
            reviewFormToggle.classList.toggle('active');
            reviewFormToggle.textContent = isActive ? 'Close Form' : 'Leave a Review';
            if (isActive) {
                reviewFormContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });

        // Fetch reviews from the server
        async function fetchReviews() {
            try {
                const response = await fetch('/api/reviews');
                reviews = await response.json();
                totalSlidesSpan.textContent = reviews.length;
                renderReviews();
                updateSlider();
                startAutoPlay();
            } catch (error) {
                console.error('Error fetching reviews:', error);
                totalSlidesSpan.textContent = '0';
            }
        }

        function renderReviews() {
            reviewTrack.innerHTML = '';
            indicatorsContainer.innerHTML = '';
            reviews.forEach((review, index) => {
                const initials = review.name.split(' ').map(word => word[0]).join('').toUpperCase().slice(0, 2);
                const reviewCard = `
                    <div class="review-card ${index === 0 ? 'active' : ''}">
                        <div class="review-content">
                            <div class="review-quote">${review.review_text}</div>
                            <div class="review-author">
                                <div class="review-avatar">${initials}</div>
                                <div class="review-author-info">
                                    <h4>${review.name}</h4>
                                    <p>${review.location}</p>
                                </div>
                            </div>
                            <div class="review-rating">
                                ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}
                            </div>
                            <div class="review-service-tag">${review.service_type}</div>
                        </div>
                    </div>
                `;
                reviewTrack.insertAdjacentHTML('beforeend', reviewCard);

                const dot = document.createElement('div');
                dot.classList.add('review-dot');
                dot.setAttribute('data-slide', index);
                dot.setAttribute('role', 'button');
                dot.setAttribute('aria-label', `Go to testimonial ${index + 1}`);
                dot.setAttribute('tabindex', '0');
                if (index === 0) dot.classList.add('active');
                indicatorsContainer.appendChild(dot);
            });
        }

        // Form submission
        reviewForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';

            const formData = new FormData(reviewForm);
            try {
                const response = await fetch('/api/reviews', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        name: formData.get('name'),
                        location: formData.get('location'),
                        review_text: formData.get('review_text'),
                        rating: parseInt(formData.get('rating')),
                        service_type: formData.get('service_type'),
                    }),
                });

                const result = await response.json();
                if (response.ok) {
                    successMessage.style.display = 'block';
                    reviewForm.reset();
                    document.getElementById('star5').checked = true; // Reset to 5 stars
                    // Refresh reviews after successful submission
                    await fetchReviews();
                    currentSlide = reviews.length - 1; // Go to the latest review
                    updateSlider('right');
                    setTimeout(() => {
                        reviewFormContainer.classList.remove('active');
                        reviewFormToggle.classList.remove('active');
                        reviewFormToggle.textContent = 'Leave a Review';
                    }, 2000);
                } else {
                    errorMessage.textContent = result.errors ? Object.values(result.errors).join(', ') : 'An error occurred.';
                    errorMessage.style.display = 'block';
                }
            } catch (error) {
                errorMessage.textContent = 'An error occurred while submitting the review.';
                errorMessage.style.display = 'block';
            }
        });

        // Navigation functions
        function goToSlide(index) {
            if (isAnimating || index === currentSlide || index < 0 || index >= reviews.length) return;
            const direction = index > currentSlide ? 'right' : 'left';
            currentSlide = index;
            updateSlider(direction);
            resetAutoPlay();
        }

        function nextSlide() {
            if (isAnimating) return;
            currentSlide = (currentSlide + 1) % reviews.length;
            updateSlider('right');
        }

        function prevSlide() {
            if (isAnimating) return;
            currentSlide = (currentSlide - 1 + reviews.length) % reviews.length;
            updateSlider('left');
        }

        function updateSlider(direction = 'right') {
            isAnimating = true;
            const translateX = -currentSlide * 100;
            reviewTrack.style.transform = `translateX(${translateX}%)`;
            const reviewCards = document.querySelectorAll('.review-card');
            reviewCards.forEach((card, index) => {
                card.classList.remove('active', 'slide-in-right', 'slide-in-left');
                if (index === currentSlide) {
                    setTimeout(() => {
                        card.classList.add('active');
                        card.classList.add(direction === 'right' ? 'slide-in-right' : 'slide-in-left');
                    }, 100);
                }
            });

            const dots = document.querySelectorAll('.review-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
                dot.setAttribute('aria-selected', index === currentSlide);
            });

            currentSlideSpan.textContent = currentSlide + 1;

            setTimeout(() => {
                const activeCard = reviewCards[currentSlide];
                const stars = activeCard.querySelectorAll('.star');
                stars.forEach((star, index) => {
                    setTimeout(() => {
                        star.style.animation = 'none';
                        star.offsetHeight; // Trigger reflow
                        star.style.animation = 'starPulse 0.6s ease-in-out';
                    }, index * 100);
                });
            }, 300);

            setTimeout(() => {
                isAnimating = false;
            }, 700);
        }

        function startAutoPlay() {
            autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
            startProgressBar();
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
            stopProgressBar();
        }

        function resetAutoPlay() {
            stopAutoPlay();
            startAutoPlay();
        }

        function startProgressBar() {
            let progress = 0;
            progressBar.style.width = '0%';
            progressInterval = setInterval(() => {
                progress += 0.5;
                progressBar.style.width = `${progress}%`;
                if (progress >= 100) {
                    clearInterval(progressInterval);
                }
            }, autoPlayDelay / 200);
        }

        function stopProgressBar() {
            clearInterval(progressInterval);
            progressBar.style.width = '0%';
        }

        // Event listeners
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAutoPlay();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAutoPlay();
        });

        indicatorsContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('review-dot')) {
                goToSlide(parseInt(e.target.getAttribute('data-slide')));
            }
        });

        indicatorsContainer.addEventListener('keydown', (e) => {
            if (e.target.classList.contains('review-dot') && (e.key === 'Enter' || e.key === ' ')) {
                e.preventDefault();
                goToSlide(parseInt(e.target.getAttribute('data-slide')));
            }
        });

        reviewTrack.addEventListener('mouseenter', stopAutoPlay);
        reviewTrack.addEventListener('mouseleave', startAutoPlay);

        let startX = 0;
        let endX = 0;
        let isDragging = false;

        reviewTrack.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
        });

        reviewTrack.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            endX = e.touches[0].clientX;
        });

        reviewTrack.addEventListener('touchend', () => {
            if (!isDragging) return;
            isDragging = false;
            const diff = startX - endX;
            const threshold = 50;
            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
                resetAutoPlay();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                prevSlide();
                resetAutoPlay();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                resetAutoPlay();
            }
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        });

        observer.observe(document.querySelector('.review-slider-container'));

        document.querySelectorAll('.review-service-tag').forEach(tag => {
            tag.addEventListener('click', (e) => {
                e.preventDefault();
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.background = 'rgba(255,255,255,0.6)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = `${e.clientX - e.target.getBoundingClientRect().left}px`;
                ripple.style.top = `${e.clientY - e.target.getBoundingClientRect().top}px`;
                ripple.style.width = '100px';
                ripple.style.height = '100px';
                ripple.style.transformOrigin = 'center';
                e.target.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        if (!reviewTrack || !prevBtn || !nextBtn || !indicatorsContainer || !currentSlideSpan || !totalSlidesSpan || !progressBar) {
            console.error('One or more required DOM elements are missing.');
            return;
        }

        reviewTrack.setAttribute('aria-live', 'polite');
        prevBtn.setAttribute('aria-label', 'Previous testimonial');
        nextBtn.setAttribute('aria-label', 'Next testimonial');

        // Fetch reviews on page load
        fetchReviews();

        // Additional CSS animations
        const additionalStyles = document.createElement('style');
        additionalStyles.textContent = `
            @keyframes starPulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.4); filter: drop-shadow(0 0 15px #ffa500); }
                100% { transform: scale(1); }
            }
            @keyframes ripple {
                0% { transform: scale(0); opacity: 1; }
                100% { transform: scale(4); opacity: 0; }
            }
        `;
        document.head.appendChild(additionalStyles);
    });
</script>