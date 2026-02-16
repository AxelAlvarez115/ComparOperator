const backToTopBtn = document.getElementById('back-to-top');

window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        backToTopBtn.classList.remove('hidden');
        backToTopBtn.classList.add('flex');
    } else {
        backToTopBtn.classList.add('hidden');
        backToTopBtn.classList.remove('flex');
    }
});

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};