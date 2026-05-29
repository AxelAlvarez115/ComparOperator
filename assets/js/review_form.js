const reviewModal       = document.getElementById('reviewModal');
const closeModalBtn     = document.getElementById('closeModal');
const reviewForm        = document.getElementById('reviewForm');
const operatorIdInput   = document.getElementById('operatorId');
const reviewsContainer  = document.getElementById('reviewsContainer');
const modalOperatorName = document.getElementById('modalOperatorName');
const starBtns          = document.querySelectorAll('.star-btn');
const reviewGradeInput  = document.getElementById('reviewGrade');
const starLabel         = document.getElementById('starLabel');

const STAR_LABELS = ['', 'Poor', 'Fair', 'Good', 'Very good', 'Excellent'];
let selectedGrade = 0;

// ── Star rating ──────────────────────────────────────────────────────────────

function renderStars(grade) {
    starBtns.forEach(btn => {
        const filled = parseInt(btn.dataset.value) <= grade;
        btn.textContent = filled ? '★' : '☆';
        btn.style.setProperty('color', filled ? '#facc15' : '#d1d5db', 'important');
    });
    if (starLabel) starLabel.textContent = grade > 0 ? STAR_LABELS[grade] : '';
}

// Délégation sur le conteneur : plus robuste que les listeners individuels
const starRating = document.getElementById('starRating');
if (starRating) {
    starRating.addEventListener('mouseover', e => {
        const btn = e.target.closest('.star-btn');
        if (btn) renderStars(parseInt(btn.dataset.value));
    });
    starRating.addEventListener('mouseleave', () => renderStars(selectedGrade));
    starRating.addEventListener('click', e => {
        const btn = e.target.closest('.star-btn');
        if (btn) {
            selectedGrade = parseInt(btn.dataset.value);
            reviewGradeInput.value = selectedGrade;
            renderStars(selectedGrade);
        }
    });
}

renderStars(0);

function resetStars() {
    selectedGrade = 0;
    reviewGradeInput.value = '';
    renderStars(0);
}

// ── Modal open / close ────────────────────────────────────────────────────────

document.querySelectorAll('.reviewBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        const operatorId   = btn.dataset.operatorId;
        const operatorName = btn.dataset.operatorName || 'Reviews';

        operatorIdInput.value         = operatorId;
        modalOperatorName.textContent = operatorName;
        reviewsContainer.innerHTML    = '';

        reviewModal.classList.remove('hidden');
        reviewModal.classList.add('flex');
        resetStars();

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
    resetStars();
}

// ── Load reviews ──────────────────────────────────────────────────────────────

async function loadReviews(operatorId) {
    try {
        const res     = await fetch(`/ComparOperator/process/get_reviews.php?tour_operator_id=${operatorId}`);
        const reviews = await res.json();

        reviewsContainer.innerHTML = '';

        if (!Array.isArray(reviews) || reviews.length === 0) {
            reviewsContainer.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">No reviews yet. Be the first!</p>';
            return;
        }

        reviews.forEach(r => reviewsContainer.appendChild(buildReviewCard(r.username, r.content, r.grade)));
    } catch {
        reviewsContainer.innerHTML = '<p class="text-red-400 text-sm text-center py-4">Failed to load reviews.</p>';
    }
}

// ── Submit ────────────────────────────────────────────────────────────────────

reviewForm.addEventListener('submit', async e => {
    e.preventDefault();

    const username       = document.getElementById('reviewUsername').value.trim();
    const content        = document.getElementById('reviewContent').value.trim();
    const tourOperatorId = parseInt(operatorIdInput.value);
    const grade          = selectedGrade > 0 ? selectedGrade : null;

    if (!username || !content) return;

    const submitBtn = reviewForm.querySelector('[type="submit"]');
    submitBtn.disabled    = true;
    submitBtn.textContent = 'Sending…';

    try {
        const res  = await fetch('/ComparOperator/process/post_review.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify({ username, content, tour_operator_id: tourOperatorId, grade }),
        });
        const data = await res.json();

        if (data.success) {
            const noMsg = reviewsContainer.querySelector('p');
            if (noMsg) noMsg.remove();
            reviewsContainer.prepend(buildReviewCard(data.username, data.content, data.grade));
            reviewForm.reset();
            resetStars();
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

// ── Build review card ─────────────────────────────────────────────────────────

function buildReviewCard(username, content, grade) {
    const article = document.createElement('article');
    article.className = 'w-full border border-gray-100 rounded-xl p-3 bg-gray-50 flex justify-between items-start gap-4';

    // Badge de note (note chiffrée + étoiles), cohérent avec card_review.php
    const ratingHtml = grade
        ? `<div class="flex flex-col items-end gap-1 shrink-0">
               <span class="flex gap-0.5">${Array.from({ length: 5 }, (_, i) =>
                   `<span style="color:${i < grade ? '#facc15' : '#d1d5db'};font-size:0.85rem">★</span>`
               ).join('')}</span>
               <span class="flex items-center gap-1 bg-orange-50 border border-orange-200 rounded-full px-2 py-0.5">
                   <span class="text-xs font-bold text-orange-500">${grade}/5</span>
               </span>
           </div>`
        : '';

    article.innerHTML = `
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-semibold text-sm text-slate-800">${escapeHtml(username)}</span>
                <span class="text-xs text-gray-400">·</span>
                <span class="text-xs text-gray-400 italic">just now</span>
            </div>
            <p class="text-sm text-gray-700 leading-relaxed">${escapeHtml(content)}</p>
        </div>
        ${ratingHtml}
    `;
    return article;
}

function escapeHtml(str) {
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
