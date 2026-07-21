import './bootstrap';

// ─── Cart quantity controls ──────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    // Auto-dismiss flash messages after 4s
    document.querySelectorAll('.alert-success, .alert-error').forEach(el => {
        setTimeout(() => {
            el.style.transition = 'opacity .6s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 600);
        }, 4000);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});
