const toggleBtn      = document.getElementById('toggleHiddenCards');
const destinationCards = document.querySelectorAll('.destination-card');
const hiddenCards    = [];
let expanded         = false;

destinationCards.forEach((card, index) => {
    if (index >= 4) {
        card.classList.add('hidden');
        hiddenCards.push(card);
    }
});

if (hiddenCards.length === 0 && toggleBtn) {
    toggleBtn.style.display = 'none';
}

toggleBtn?.addEventListener('click', () => {
    expanded = !expanded;
    hiddenCards.forEach(card => {
        card.classList.toggle('hidden', !expanded);
    });
    toggleBtn.textContent = expanded ? 'Show less ↑' : 'See all ↓';
});
