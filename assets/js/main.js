// ===== NAVBAR: shrink on scroll =====
const nav = document.getElementById('mainNav');
window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 50);
});

// ===== SMOOTH SCROLL for anchor links =====
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
        const target = document.querySelector(link.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        const offset = nav.offsetHeight + 10;
        window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
        // Close mobile menu if open
        const collapse = document.getElementById('navMenu');
        if (collapse.classList.contains('show')) {
            bootstrap.Collapse.getInstance(collapse)?.hide();
        }
    });
});

// ===== COUNTER ANIMATION =====
function animateCounter(el) {
    const target = +el.dataset.target;
    const duration = 1800;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = Math.floor(current).toLocaleString();
        if (current >= target) clearInterval(timer);
    }, 16);
}

const counterObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.stat-number[data-target]').forEach(el => counterObserver.observe(el));

// ===== CONTACT FORM: basic client-side feedback =====
const form = document.getElementById('contactForm');
if (form) {
    form.addEventListener('submit', e => {
        const btn = form.querySelector('[type="submit"]');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
        // Re-enable after 3s if no page reload (placeholder — wire up contact.php for real sending)
        setTimeout(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-send me-2"></i>Send Message';
        }, 3000);
    });
}
