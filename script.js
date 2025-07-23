// Form validation and interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Form validation for registration
    const form = document.getElementById('registrationForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form elements
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            
            // Get error elements
            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const phoneError = document.getElementById('phoneError');
            
            // Reset error messages
            if (nameError) nameError.textContent = '';
            if (emailError) emailError.textContent = '';
            if (phoneError) phoneError.textContent = '';
            
            // Remove error styling
            if (name) name.classList.remove('error-input');
            if (email) email.classList.remove('error-input');
            if (phone) phone.classList.remove('error-input');
            
            let isValid = true;
            
            // Validate name
            if (name && (!name.value.trim() || name.value.trim().length < 2)) {
                if (nameError) nameError.textContent = name.value.trim() ? 'Name must be at least 2 characters long' : 'Name is required';
                if (name) name.classList.add('error-input');
                isValid = false;
            }
            
            // Validate email
            if (email && (!email.value.trim() || !isValidEmail(email.value))) {
                if (emailError) emailError.textContent = email.value.trim() ? 'Please enter a valid email address' : 'Email is required';
                if (email) email.classList.add('error-input');
                isValid = false;
            }
            
            // Validate phone
            if (phone && (!phone.value.trim() || !isValidPhone(phone.value))) {
                if (phoneError) phoneError.textContent = phone.value.trim() ? 'Please enter a valid phone number' : 'Phone number is required';
                if (phone) phone.classList.add('error-input');
                isValid = false;
            }
            
            // If form is valid, submit it
            if (isValid) {
                form.submit();
            }
        });
        
        // Real-time validation
        const inputs = [name, email, phone];
        inputs.forEach(input => {
            if (input) {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    // Clear error when user starts typing
                    const errorElement = document.getElementById(this.id + 'Error');
                    if (errorElement) {
                        errorElement.textContent = '';
                    }
                    this.classList.remove('error-input');
                });
            }
        });
    }
    
    // Mobile menu functionality
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
        
        // Close menu when clicking on a link
        const navLinks = document.querySelectorAll('.nav-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }
    
    // Image Slider for Hero Section
    const slider = document.querySelector('.hero-slider');
    if (slider) {
        const slides = slider.querySelectorAll('.slide');
        const dots = slider.querySelectorAll('.slider-dot');
        let currentSlide = 0;
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? '1' : '0';
            });
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        
        // Auto-advance slides every 5 seconds
        setInterval(nextSlide, 5000);
        
        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });
        
        // Show first slide initially
        showSlide(0);
    }
    
    // Form Feedback for all forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                // Show loading state
                const originalText = submitBtn.textContent || submitBtn.value;
                submitBtn.textContent = 'Submitting...';
                submitBtn.value = 'Submitting...';
                submitBtn.disabled = true;
                
                // Reset button after 3 seconds (simulate form submission)
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.value = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        });
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add scroll effect to navigation
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (header) {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });
});

// Email validation function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Phone validation function
function isValidPhone(phone) {
    // Allow various phone number formats
    const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
    return phoneRegex.test(phone);
}

// Individual field validation
function validateField(field) {
    const errorElement = document.getElementById(field.id + 'Error');
    
    if (!errorElement) return;
    
    errorElement.textContent = '';
    field.classList.remove('error-input');
    
    switch(field.id) {
        case 'name':
            if (!field.value.trim()) {
                errorElement.textContent = 'Name is required';
                field.classList.add('error-input');
            } else if (field.value.trim().length < 2) {
                errorElement.textContent = 'Name must be at least 2 characters long';
                field.classList.add('error-input');
            }
            break;
            
        case 'email':
            if (!field.value.trim()) {
                errorElement.textContent = 'Email is required';
                field.classList.add('error-input');
            } else if (!isValidEmail(field.value)) {
                errorElement.textContent = 'Please enter a valid email address';
                field.classList.add('error-input');
            }
            break;
            
        case 'phone':
            if (!field.value.trim()) {
                errorElement.textContent = 'Phone number is required';
                field.classList.add('error-input');
            } else if (!isValidPhone(field.value)) {
                errorElement.textContent = 'Please enter a valid phone number';
                field.classList.add('error-input');
            }
            break;
    }
}

// Add CSS for error styling and interactive features
const style = document.createElement('style');
style.textContent = `
    .error-input {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .form-group input.error-input:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    /* Mobile Menu Styles */
    .hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 5px;
    }
    
    .hamburger span {
        width: 25px;
        height: 3px;
        background-color: white;
        margin: 3px 0;
        transition: 0.3s;
    }
    
    .hamburger.active span:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 6px);
    }
    
    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }
    
    .hamburger.active span:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -6px);
    }
    
    /* Image Slider Styles */
    .hero-slider {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    
    .slide.active {
        opacity: 1;
    }
    
    .slider-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
    }
    
    .slider-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .slider-dot.active {
        background-color: white;
    }
    
    /* Scroll effect for header */
    header.scrolled {
        background-color: rgba(41, 32, 32, 0.95);
        backdrop-filter: blur(10px);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hamburger {
            display: flex;
        }
        
        .nav-menu {
            position: fixed;
            left: -100%;
            top: 70px;
            flex-direction: column;
            background-color: #800000;
            width: 100%;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 10px 27px rgba(0, 0, 0, 0.05);
            padding: 2rem 0;
        }
        
        .nav-menu.active {
            left: 0;
        }
        
        .nav-menu li {
            margin: 1rem 0;
        }
        
        .hero-slider {
            height: 250px;
        }
    }
`;
document.head.appendChild(style); 