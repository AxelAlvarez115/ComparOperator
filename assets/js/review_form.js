const reviewModal       = document.getElementById('reviewModal');
const closeModalBtn     = document.getElementById('closeModal');
const reviewForm        = document.getElementById('reviewForm');
const operatorIdInput   = document.getElementById('operatorId');
const reviewsContainer  = document.getElementById('reviewsContainer');
const noReviewsMsg      = document.getElementById('noReviewsMsg');
const modalOperatorName = document.getElementById('modalOperatorName');

document.querySelectorAll('.reviewBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        const operatorId   = btn.dataset.operatorId;
        const operatorName = btn.dataset.operatorName || 'Reviews';

        operatorIdInput.value      = operatorId;
        modalOperatorName.textContent = operatorName;
        reviewsContainer.innerHTML = '';

        reviewModal.classList.remove('hidden');
        reviewModal.classList.add('flex');

        loadReviews(operatorId);
    });
});

closeModalBtn.addEventListener('click', closeModal);
reviewModal.addEventListener('click', e => {
    if (e.target === reviewModal) closeModal();
});

function closeModal() {
    reviewModal.classList.add('hidden');
    reviewModal.classList.remove('flex');
    reviewForm.reset();
}

async function loadReviews(operatorId) {
    try {
        const res     = await fetch(`/ComparOperator/process/get_reviews.php?tour_operator_id=${operatorId}`);
        const reviews = await res.json();

        reviewsContainer.innerHTML = '';

        if (!Array.isArray(reviews) || reviews.length === 0) {
            reviewsContainer.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">No reviews yet. Be the first!</p>';
            return;
        }

        reviews.forEach(r => {
            reviewsContainer.appendChild(buildReviewCard(r.username, r.content));
        });
    } catch {
        reviewsContainer.innerHTML = '<p class="text-red-400 text-sm text-center py-4">Failed to load reviews.</p>';
    }
}

reviewForm.addEventListener('submit', async e => {
    e.preventDefault();

    const username      = document.getElementById('reviewUsername').value.trim();
    const content       = document.getElementById('reviewContent').value.trim();
    const tourOperatorId = parseInt(operatorIdInput.value);

    if (!username || !content) return;

    const submitBtn = reviewForm.querySelector('[type="submit"]');
    submitBtn.disabled    = true;
    submitBtn.textContent = 'Sending…';

    try {
        const res  = await fetch('/ComparOperator/process/post_review.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify({ username, content, tour_operator_id: tourOperatorId }),
        });
        const data = await res.json();

        if (data.success) {
            const noMsg = reviewsContainer.querySelector('p');
            if (noMsg) noMsg.remove();

            reviewsContainer.prepend(buildReviewCard(data.username, data.content));
            reviewForm.reset();
        } else {
            alert(data.error || 'Failed to submit review.');
        }
    } catch {
        alert('Network error. Please try again.');
    } finally {
        submitBtn.disabled    = false;
        submitBtn.textContent = 'Send Review';
    }
});

function buildReviewCard(username, content) {
    const article = document.createElement('article');
    article.className = 'w-full border border-gray-100 rounded-xl p-3 bg-gray-50 flex flex-col gap-1';
    article.innerHTML = `
        <div class="flex items-center gap-2">
            <span class="font-semibold text-sm text-slate-800">${escapeHtml(username)}</span>
            <span class="text-xs text-gray-400">· just now</span>
        </div>
        <p class="text-sm text-gray-700 leading-relaxed">${escapeHtml(content)}</p>
    `;
    return article;
}

function escapeHtml(str) {
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
