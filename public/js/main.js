/**
 * Main JavaScript - Client-side functionality
 */

document.addEventListener('DOMContentLoaded', () => {
    // Smooth scroll functionality
    document.querySelectorAll('[data-scroll-to]').forEach(element => {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.getElementById(element.dataset.scrollTo);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Mobile navbar toggle
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');

    if (navbarToggle) {
        navbarToggle.addEventListener('click', () => {
            navbarMenu.classList.toggle('active');
        });
    }

    // Sticky navbar effect
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                navbar.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';
            } else {
                navbar.style.boxShadow = '0 1px 3px rgba(0,0,0,0.05)';
            }
        });
    }

    // Inquiry form submission
    const inquiryForm = document.getElementById('inquiryForm');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(inquiryForm);
            const messageDiv = document.getElementById('formMessage');

            try {
                const response = await fetch('/inquiry', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    messageDiv.className = 'form-feedback success';
                    messageDiv.textContent = data.message;
                    inquiryForm.reset();

                    // Scroll to message
                    messageDiv.scrollIntoView({ behavior: 'smooth' });
                } else if (response.status === 422) {
                    // Validation errors
                    messageDiv.className = 'form-feedback error';
                    const errors = data.errors;
                    const errorMessages = Object.values(errors)
                        .flat()
                        .join('\n');
                    messageDiv.textContent = errorMessages;
                } else {
                    messageDiv.className = 'form-feedback error';
                    messageDiv.textContent = data.error || 'An error occurred';
                }
            } catch (error) {
                messageDiv.className = 'form-feedback error';
                messageDiv.textContent = 'Failed to submit form. Please try again.';
                console.error('Form submission error:', error);
            }
        });
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.case-card, .service-card, .post-card').forEach(el => {
        observer.observe(el);
    });
});

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    .case-card, .service-card, .post-card {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 250ms ease-out, transform 250ms ease-out;
    }
    
    .case-card.in-view, .service-card.in-view, .post-card.in-view {
        opacity: 1;
        transform: translateY(0);
    }
    
    @media (prefers-reduced-motion: reduce) {
        .case-card, .service-card, .post-card {
            opacity: 1 !important;
            transform: none !important;
        }
    }
`;
document.head.appendChild(style);
