// WhatsApp Floating Button
document.addEventListener('DOMContentLoaded', function () {

    const waButton = document.createElement('a');
    waButton.href = 'https://wa.me/8801981040269';
    waButton.target = '_blank';
    waButton.innerHTML = '<i class="fab fa-whatsapp text-2xl"></i>';
    waButton.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5);
        z-index: 9999;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
    `;

    waButton.addEventListener('mouseenter', function () {
        this.style.transform = 'scale(1.15)';
        this.style.boxShadow = '0 6px 25px rgba(37, 211, 102, 0.7)';
    });

    waButton.addEventListener('mouseleave', function () {
        this.style.transform = 'scale(1)';
        this.style.boxShadow = '0 4px 20px rgba(37, 211, 102, 0.5)';
    });

    document.body.appendChild(waButton);

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Scroll animation
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.shadow-lg').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });

});
