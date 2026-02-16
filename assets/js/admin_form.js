const updateBtns = document.querySelectorAll('.updateBtn');
const updateModal = document.querySelector('#updateModal');
const cancelUpdate = document.querySelector('#cancelUpdate');
const closeUpdateModal = document.querySelector('#closeUpdateModal');

updateBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        updateModal.classList.remove('hidden');
        updateModal.classList.add('flex');
    });
});

cancelUpdate.addEventListener('click', () => {
    updateModal.classList.add('hidden');
    updateModal.classList.remove('flex');
});

closeUpdateModal.addEventListener('click', () => {
    updateModal.classList.add('hidden');
    updateModal.classList.remove('flex');
});
