import './bootstrap';

// ══════════════════════════════════════════════════════════════════════════════
// ROG Store — Premium JS Enhancements
// Scroll animations · Loading states · Lazy images · Ripples · Toast · UX
// ══════════════════════════════════════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', () => {

    // ── 1. Scroll reveal via IntersectionObserver ──────────────────────────
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('[data-reveal]').forEach(el => revealObserver.observe(el));

    // Section titles — trigger the underline reveal
    document.querySelectorAll('.section-title').forEach(el => {
        const obs = new IntersectionObserver(([entry]) => {
            if (entry.isIntersecting) {
                el.classList.add('is-visible');
                obs.unobserve(el);
            }
        }, { threshold: 0.5 });
        obs.observe(el);
    });

    // ── 2. Auto-add data-reveal to key elements ────────────────────────────
    // Product cards get staggered reveal
    document.querySelectorAll('.product-card').forEach((card, i) => {
        if (!card.hasAttribute('data-reveal')) {
            card.setAttribute('data-reveal', '');
            const delay = (i % 4) + 1;
            if (delay > 1) card.setAttribute('data-delay', delay);
            revealObserver.observe(card);
        }
    });

    // Category cards
    document.querySelectorAll('.cat-card').forEach((card, i) => {
        if (!card.hasAttribute('data-reveal')) {
            card.setAttribute('data-reveal', 'scale');
            if (i > 0) card.setAttribute('data-delay', Math.min(i, 6));
            revealObserver.observe(card);
        }
    });

    // ── 3. Navbar shrink on scroll ─────────────────────────────────────────
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        const onScroll = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    // ── 4. Lazy image loading ──────────────────────────────────────────────
    const imgObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                img.classList.add('loaded');
                imgObserver.unobserve(img);
            }
        });
    }, { rootMargin: '200px' });

    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        img.classList.add('lazy');
        imgObserver.observe(img);
        // Trigger immediately if already in viewport
        if (img.complete) img.classList.add('loaded');
    });

    // ── 5. Button ripple effect ────────────────────────────────────────────
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-rog, .btn-rog-outline');
        if (!btn) return;
        const ripple = document.createElement('span');
        ripple.className = 'btn-ripple';
        const rect = btn.getBoundingClientRect();
        ripple.style.left = (e.clientX - rect.left) + 'px';
        ripple.style.top  = (e.clientY - rect.top) + 'px';
        btn.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    });

    // ── 6. Form submit loading states ──────────────────────────────────────
    document.querySelectorAll('form').forEach(form => {
        // Skip forms that are just qty updates (they submit often)
        if (form.querySelector('[name="quantity"]') && form.querySelector('[type="number"]')) return;
        if (form.id === 'checkout-form') return; // handled by bakong JS

        form.addEventListener('submit', () => {
            const submitBtn = form.querySelector('[type="submit"]');
            if (submitBtn && !submitBtn.classList.contains('btn-loading')) {
                submitBtn.classList.add('btn-loading');
                const origText = submitBtn.innerHTML;
                setTimeout(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.innerHTML = origText;
                }, 8000); // failsafe reset
            }
        });
    });

    // ── 7. Auto-dismiss flash messages ─────────────────────────────────────
    document.querySelectorAll('.alert-success, .alert-error').forEach(el => {
        setTimeout(() => {
            el.style.transition = 'opacity .5s, transform .5s';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-8px)';
            setTimeout(() => el.remove(), 500);
        }, 4500);
    });

    // ── 8. Smooth scroll for anchor links ──────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ── 9. Page exit transition for internal links ──────────────────────────
    document.querySelectorAll('a[href]').forEach(link => {
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('http') ||
            href.startsWith('mailto') || href.startsWith('tel') ||
            link.target === '_blank' || link.hasAttribute('data-no-transition')) return;

        link.addEventListener('click', (e) => {
            if (e.metaKey || e.ctrlKey || e.shiftKey) return;
            e.preventDefault();
            const main = document.querySelector('main');
            if (main) {
                main.classList.add('page-transition-out');
                setTimeout(() => { window.location.href = href; }, 220);
            } else {
                window.location.href = href;
            }
        });
    });

    // ── 10. Cart badge bounce on add ───────────────────────────────────────
    document.querySelectorAll('form[action*="cart/add"]').forEach(form => {
        form.addEventListener('submit', () => {
            const badge = document.querySelector('.mobile-tab-badge, .cart-badge');
            if (badge) {
                badge.classList.remove('cart-badge-bounce');
                void badge.offsetWidth; // reflow
                badge.classList.add('cart-badge-bounce');
            }
        });
    });

    // ── 11. Navbar active link highlight ───────────────────────────────────
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link[href]').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.style.color = 'var(--rog-red)';
        }
    });

    // ── 12. Image error fallback ────────────────────────────────────────────
    document.querySelectorAll('img').forEach(img => {
        if (!img.hasAttribute('onerror')) {
            img.addEventListener('error', () => {
                img.src = 'https://images.unsplash.com/photo-1593640408182-31c228034c55?w=400&q=60';
            });
        }
    });

    // ── 13. Add loading="lazy" to all product images not already set ────────
    document.querySelectorAll('.product-card img, .product-grid-mobile img').forEach(img => {
        if (!img.hasAttribute('loading')) {
            img.setAttribute('loading', 'lazy');
            img.classList.add('lazy');
            imgObserver.observe(img);
            if (img.complete) img.classList.add('loaded');
        }
    });

    // ── 14. Smooth number count-up for stat numbers ─────────────────────────
    const countObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = parseFloat(el.dataset.count);
            if (isNaN(target)) return;
            const prefix = el.dataset.prefix || '';
            const suffix = el.dataset.suffix || '';
            const duration = 1200;
            const start = performance.now();
            const isFloat = target % 1 !== 0;
            const step = (now) => {
                const p = Math.min((now - start) / duration, 1);
                const ease = 1 - Math.pow(1 - p, 3);
                const val = target * ease;
                el.textContent = prefix + (isFloat ? val.toFixed(2) : Math.round(val)) + suffix;
                if (p < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
            countObserver.unobserve(el);
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-count]').forEach(el => countObserver.observe(el));

});

// ── Toast utility (global) ─────────────────────────────────────────────────
window.rogToast = function(message, type = 'default', duration = 3500) {
    let container = document.getElementById('rog-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'rog-toast-container';
        document.body.appendChild(container);
    }
    const toast = document.createElement('div');
    toast.className = `rog-toast toast-${type}`;
    toast.innerHTML = message;
    container.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('toast-out');
        setTimeout(() => toast.remove(), 260);
    }, duration);
};
