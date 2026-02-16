const toggleHiddenCards = document.getElementById('toggleHiddenCards');
const destinationsCard = document.querySelectorAll('.destination-card');
const hiddenCards = [];

destinationsCard.forEach((card, index) => {
    if (index >= 4) {
        card.classList.add('hidden');
        hiddenCards.push(card);
    }
});

toggleHiddenCards.addEventListener('click', () => {
    hiddenCards.forEach(card => {
        card.classList.toggle('hidden');
        window.scrollBy({ top: card.offsetHeight, behavior: 'smooth' });
    });
});