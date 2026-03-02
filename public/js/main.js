/**
 * Main JavaScript - Client-side functionality
 */

// ─── Hero headline stagger ───────────────────────────────────────────────────
// Progressive enhancement: text visible by default, JS adds hidden state
// then animates in. No JS = headline always visible.
// Fires 300ms after load. Each line staggers 80ms apart.
// Respects prefers-reduced-motion.
(function () {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) return; // no-op — text stays visible, no animation

    // Inject hidden state now, before DOM is fully ready
    const hideStyle = document.createElement('style');
    hideStyle.textContent = '.hero-line { opacity: 0; transform: translateY(24px); }';
    document.head.appendChild(hideStyle);

    function revealHeroLines() {
        const lines = document.querySelectorAll('.hero-line');
        if (!lines.length) return;
        lines.forEach((line, i) => {
            setTimeout(() => {
                line.style.transition = 'opacity 500ms cubic-bezier(0.16, 1, 0.3, 1), transform 500ms cubic-bezier(0.16, 1, 0.3, 1)';
                line.style.opacity = '1';
                line.style.transform = 'translateY(0)';
            }, i * 80);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => setTimeout(revealHeroLines, 300));
    } else {
        setTimeout(revealHeroLines, 300);
    }
})();

// ─── Stat count-up ───────────────────────────────────────────────────────────
// IntersectionObserver at threshold 0.3. 1500ms ease-out cubic.
// Numbers ≥ 1000 formatted with comma. Suffix appended after count completes.
(function () {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function formatNumber(n) {
        return n >= 1000 ? n.toLocaleString('en-US') : String(n);
    }

    function animateCountUp(el) {
        const target = parseInt(el.dataset.target, 10);
        const suffix = el.dataset.suffix || '';

        if (prefersReduced || target === 0) {
            el.textContent = formatNumber(target) + suffix;
            return;
        }

        const duration = 1500;
        const start = performance.now();

        function tick(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            // Cubic ease-out — decelerates near the end
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(eased * target);

            el.textContent = formatNumber(current) + (progress >= 1 ? suffix : '');

            if (progress < 1) {
                requestAnimationFrame(tick);
            }
        }

        // Reset to 0 before counting
        el.textContent = '0';
        requestAnimationFrame(tick);
    }

    function initCountUp() {
        const statEls = document.querySelectorAll('.stat-number');
        if (!statEls.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCountUp(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        statEls.forEach(el => observer.observe(el));
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCountUp);
    } else {
        initCountUp();
    }
})();

// ─── Nav scroll effect ────────────────────────────────────────────────────────
// Adds .nav-scrolled class after 60px scroll → CSS applies bg-opacity transition
(function () {
    const nav = document.getElementById('site-nav');
    if (!nav) return;
    window.addEventListener('scroll', () => {
        nav.classList.toggle('nav-scrolled', window.scrollY > 60);
    }, { passive: true });
})();

// ─── Mobile menu toggle ───────────────────────────────────────────────────────
(function () {
    const toggle = document.getElementById('mobile-menu-toggle');
    const panel = document.getElementById('mobile-menu-panel');
    if (!toggle || !panel) return;

    const icon = toggle.querySelector('i');

    function closeMenu() {
        panel.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        if (icon) {
            icon.className = 'hn hn-angle-right';
        }
    }

    function openMenu() {
        panel.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        if (icon) {
            icon.className = 'hn hn-angle-down';
        }
    }

    toggle.addEventListener('click', () => {
        if (panel.classList.contains('is-open')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('click', (event) => {
        if (!panel.classList.contains('is-open')) return;
        if (toggle.contains(event.target) || panel.contains(event.target)) return;
        closeMenu();
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });
})();

// ─── Stats scroll — lift, dots, drag-to-scroll ───────────────────────────────
// Mobile: proximity lift on active card, dot indicator, mouse drag-to-scroll.
// Desktop: CSS grid takes over at 1024px, JS effects are benign (no-op layout).
(function () {
    const scroll = document.getElementById('stats-scroll');
    const dots = document.querySelectorAll('.stats-dot');
    if (!scroll) return;

    // Dot indicator — update active dot based on scroll position
    function updateDots() {
        if (!dots.length) return;
        const cards = scroll.querySelectorAll('.stat-card');
        if (!cards.length) return;
        const cardWidth = cards[0].offsetWidth + 2; // +2 for gap
        const active = Math.min(
            Math.round(scroll.scrollLeft / cardWidth),
            dots.length - 1
        );
        dots.forEach((d, i) => d.classList.toggle('active', i === active));
    }

    scroll.addEventListener('scroll', updateDots, { passive: true });

    // Lift animation — skip if prefers-reduced-motion
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!prefersReduced) {
        scroll.addEventListener('scroll', () => {
            const cards = scroll.querySelectorAll('.stat-card');
            const center = scroll.scrollLeft + scroll.offsetWidth / 2;
            cards.forEach(card => {
                const cardCenter = card.offsetLeft + card.offsetWidth / 2;
                const dist = Math.abs(center - cardCenter);
                const maxDist = scroll.offsetWidth * 0.75;
                const proximity = Math.max(0, 1 - dist / maxDist);
                const lift = proximity * -8;
                const scale = 0.97 + proximity * 0.03;
                card.style.transform = `translateY(${lift}px) scale(${scale})`;
                card.style.borderColor = proximity > 0.6
                    ? 'rgba(217,255,92,0.15)'
                    : 'transparent';
                card.style.background = proximity > 0.6 ? '#2a2a2a' : '#242424';
            });
        }, { passive: true });
    }

    // Drag-to-scroll (mouse)
    let isDown = false;
    let startX = 0;
    let startLeft = 0;

    scroll.addEventListener('mousedown', e => {
        isDown = true;
        scroll.classList.add('is-dragging');
        startX = e.pageX - scroll.offsetLeft;
        startLeft = scroll.scrollLeft;
    });
    document.addEventListener('mouseup', () => {
        isDown = false;
        scroll.classList.remove('is-dragging');
    });
    scroll.addEventListener('mouseleave', () => {
        isDown = false;
        scroll.classList.remove('is-dragging');
    });
    scroll.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scroll.offsetLeft;
        scroll.scrollLeft = startLeft - (x - startX);
    });
})();

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
