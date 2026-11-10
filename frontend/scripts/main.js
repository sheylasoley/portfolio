// -> Menü (Hamburger) auf dem Handy
const header = document.querySelector('[data-layout="header"]');
const menuToggle = document.querySelector('[data-menu-toggle]');

if (header && menuToggle) {
    menuToggle.addEventListener('click', () => {
        const isOpen = header.classList.toggle('open');
        menuToggle.setAttribute('aria-expanded', isOpen);
    });

    header.querySelectorAll('.nav a').forEach((link) => {
        link.addEventListener('click', () => {
            header.classList.remove('open');
            menuToggle.setAttribute('aria-expanded', 'false');
        });
    });
}

// -> Slider: Punkte und Pfeile, synchron mit dem Scrollen
document.querySelectorAll('[data-slider]').forEach((slider) => {
    const section = slider.closest('[data-module]');
    const dotsContainer = section.querySelector('[data-slider-dots]');
    const prev = section.querySelector('[data-slider-prev]');
    const next = section.querySelector('[data-slider-next]');
    const cards = Array.from(slider.children);

    if (cards.length === 0) {
        return;
    }

    cards.forEach((card, index) => {
        const dot = document.createElement('button');
        dot.className = 'dot';
        dot.setAttribute('aria-label', 'Projekt ' + (index + 1));
        dot.addEventListener('click', () => {
            card.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        });
        dotsContainer.appendChild(dot);
    });

    const dots = Array.from(dotsContainer.children);

    const updateDots = () => {
        const center = slider.scrollLeft + slider.clientWidth / 2;
        let active = 0;
        let smallest = Infinity;
        cards.forEach((card, index) => {
            const distance = Math.abs(card.offsetLeft + card.offsetWidth / 2 - center);
            if (distance < smallest) {
                smallest = distance;
                active = index;
            }
        });
        dots.forEach((dot, index) => dot.classList.toggle('active', index === active));
    };

    const step = () => (cards.length > 1 ? cards[1].offsetLeft - cards[0].offsetLeft : cards[0].offsetWidth);

    if (prev) {
        prev.addEventListener('click', () => slider.scrollBy({ left: -step(), behavior: 'smooth' }));
    }
    if (next) {
        next.addEventListener('click', () => slider.scrollBy({ left: step(), behavior: 'smooth' }));
    }

    slider.addEventListener('scroll', updateDots);
    updateDots();
});