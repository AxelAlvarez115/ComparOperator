const reviewBtns = document.querySelectorAll('.reviewBtn');
const reviewModal = document.querySelector('#reviewModal');

reviewBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        reviewModal.classList.remove('hidden');
        reviewModal.classList.add('flex');
    });
});

closeModal.addEventListener('click', () => {
    reviewModal.classList.add('hidden');
    reviewModal.classList.remove('flex');
});
