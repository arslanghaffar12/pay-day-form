// Rates Modal
const modal = document.getElementById('ratesModal');
const openBtn = document.getElementById('openRatesModal');
const closeBtn = document.getElementById('closeModalBtn');

if (openBtn && modal && closeBtn) {
  openBtn.addEventListener('click', function (e) {
    e.preventDefault();
    modal.style.display = 'flex';
  });

  closeBtn.addEventListener('click', function () {
    modal.style.display = 'none';
  });

  window.addEventListener('click', function (e) {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
}

// FAQ Modal
const faqModal = document.getElementById('faqModal');
const openFaqBtn = document.getElementById('openFaqModal');
const closeFaqBtn = document.getElementById('closeFaqModal');

if (openFaqBtn && faqModal && closeFaqBtn) {
  openFaqBtn.addEventListener('click', function (e) {
    e.preventDefault();
    faqModal.style.display = 'flex';
  });

  closeFaqBtn.addEventListener('click', function () {
    faqModal.style.display = 'none';
  });

  window.addEventListener('click', function (e) {
    if (e.target === faqModal) {
      faqModal.style.display = 'none';
    }
  });
}
