const updateBtns      = document.querySelectorAll('.updateBtn');
const updateModal     = document.getElementById('updateModal');
const cancelUpdate    = document.getElementById('cancelUpdate');
const closeUpdateModal = document.getElementById('closeUpdateModal');

// Detect which admin page we're on
const isDestinationPage  = !!document.getElementById('updateDestinationForm');
const isTourOperatorPage = !!document.getElementById('updateTourOperatorForm');

updateBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const row = btn.closest('tr');
        if (!row) return;

        if (isDestinationPage) {
            document.getElementById('upd_id').value               = row.dataset.id;
            document.getElementById('upd_location').value         = row.dataset.location;
            document.getElementById('upd_country').value          = row.dataset.country;
            document.getElementById('upd_price').value            = row.dataset.price;
            document.getElementById('upd_tour_operator_id').value = row.dataset.tourOperatorId;
        }

        if (isTourOperatorPage) {
            document.getElementById('upd_id').value         = row.dataset.id;
            document.getElementById('upd_name').value       = row.dataset.name;
            document.getElementById('upd_link').value       = row.dataset.link;
            document.getElementById('upd_is_premium').checked = row.dataset.isPremium === '1';
        }

        updateModal.classList.remove('hidden');
        updateModal.classList.add('flex');
    });
});

function closeModal() {
    updateModal.classList.add('hidden');
    updateModal.classList.remove('flex');
}

cancelUpdate.addEventListener('click', closeModal);
closeUpdateModal.addEventListener('click', closeModal);
updateModal.addEventListener('click', e => {
    if (e.target === updateModal) closeModal();
});
