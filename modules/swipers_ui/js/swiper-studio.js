/**
 * @file
 * Web behaviors.
 */
(() => {
  const byId = (id) => document.getElementById(id);

  function toolbar() {
    const form = byId('swiper-form-wrapper');
    const formToggle = byId('swiper-form-toggle');
    formToggle.addEventListener('click', (e) => {
      if (e.currentTarget.classList.contains('active')) {
        e.currentTarget.classList.remove('active');
        form.style.display = 'none';
      } else {
        e.currentTarget.classList.add('active');
        form.style.display = 'block';
      }
    });
  }

  function rangeProcess() {
    const ps = byId('edit-slider-style-ps');
    const pe = byId('edit-slider-style-pe');
    const psCounter = byId('edit-slider-style-ps-counter');
    const peCounter = byId('edit-slider-style-pe-counter');

    psCounter.textContent = ps.value + psCounter.getAttribute('data-unit');
    peCounter.textContent = pe.value + peCounter.getAttribute('data-unit');

    ps.addEventListener('input', (e) => {
      psCounter.textContent =
        e.currentTarget.value + psCounter.getAttribute('data-unit');
    });
    pe.addEventListener('input', (e) => {
      peCounter.textContent =
        e.currentTarget.value + peCounter.getAttribute('data-unit');
    });
  }

  toolbar();
  rangeProcess();

  // eslint-disable-next-line no-undef
  tippy('[data-tippy-content]', {
    arrow: false,
    maxWidth: 240,
    offset: [0, 3],
    theme: 'swiper',
  });
})();
