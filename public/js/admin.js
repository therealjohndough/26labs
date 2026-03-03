/**
 * Admin Panel JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    // Mobile sidebar toggle
    const toggle = document.getElementById('admin-mobile-toggle');
    if (toggle) {
        toggle.addEventListener('click', () => {
            const open = document.body.classList.toggle('admin-nav-open');
            toggle.setAttribute('aria-expanded', open);
            toggle.querySelector('span').textContent = open ? 'Close' : 'Menu';
        });

        // Close sidebar on outside click
        document.addEventListener('click', (e) => {
            if (document.body.classList.contains('admin-nav-open') &&
                !e.target.closest('#admin-sidebar') &&
                !e.target.closest('#admin-mobile-toggle')) {
                document.body.classList.remove('admin-nav-open');
                toggle.setAttribute('aria-expanded', false);
                toggle.querySelector('span').textContent = 'Menu';
            }
        });
    }


    // Table row interactivity
    document.querySelectorAll('.admin-table tbody tr').forEach(row => {
        row.addEventListener('click', (e) => {
            // Don't trigger on button clicks
            if (e.target.tagName !== 'BUTTON' && !e.target.closest('a')) {
                const link = row.querySelector('a');
                if (link) {
                    window.location.href = link.href;
                }
            }
        });
    });

    // Confirm dialogs
    document.querySelectorAll('[onclick*="confirm"]').forEach(button => {
        button.addEventListener('click', (e) => {
            if (!window.confirm('Are you sure?')) {
                e.preventDefault();
            }
        });
    });

    // Form validation
    const adminForm = document.querySelector('.admin-form');
    if (adminForm) {
        adminForm.addEventListener('submit', (e) => {
            if (!adminForm.checkValidity()) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    }
});

// Close alerts after 5 seconds
document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
        alert.style.transition = 'opacity 300ms ease-out';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }, 5000);
});
