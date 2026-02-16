window.addEventListener('scroll', function() {
    const nav = document.querySelector('nav');
    if (window.scrollY > 0) {
        nav.classList.add('bg-white', 'bg-opacity-80', 'backdrop-blur-md', 'shadow-md', 'z-10', 'text-slate-700');
        nav.classList.remove('text-white');
    } else {
        nav.classList.remove('bg-white', 'bg-opacity-80', 'backdrop-blur-md', 'shadow-md', 'z-10', 'text-slate-700');
        nav.classList.add('text-white');
    }
});
const menuButton = document.querySelector('#menuButton');
const closeButton = document.querySelector('#closeButton');
const mobileMenu = document.querySelector('#mobileMenu');
menuButton.addEventListener('click', () => {
    mobileMenu.classList.remove('translate-x-full');
});
closeButton.addEventListener('click', () => {
    mobileMenu.classList.add('translate-x-full');
});