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

  function rangeChange(e) {
    const { id, value, min, max } = e.currentTarget;
    const { unit } = e.currentTarget.dataset;
    const rangeCounter = byId(`${id}-counter`);
    const percentage = ((value - min) / (max - min)) * 100;
    rangeCounter.textContent = value + unit;
    e.currentTarget.style.setProperty('--percentage', `${percentage}%`);
  }

  function rangeProcess() {
    const wv = byId('edit-slider-style-w-value');
    wv.addEventListener('input', rangeChange);
    wv.dispatchEvent(new Event('input'));

    const hv = byId('edit-slider-style-h-value');
    hv.addEventListener('input', rangeChange);
    hv.dispatchEvent(new Event('input'));

    const ps = byId('edit-slider-style-ps');
    ps.addEventListener('input', rangeChange);
    ps.dispatchEvent(new Event('input'));

    const pe = byId('edit-slider-style-pe');
    pe.addEventListener('input', rangeChange);
    pe.dispatchEvent(new Event('input'));
  }

  toolbar();
  rangeProcess();

  // @todo fix select on close details in Chrome
  document.querySelectorAll('.form-element--type-select').forEach((el) => {
    // eslint-disable-next-line no-undef
    NiceSelect.bind(el, {});
  });

  // eslint-disable-next-line no-undef
  tippy('[data-tippy-content]', {
    arrow: false,
    maxWidth: 240,
    offset: [0, 3],
    theme: 'swiper',
  });
})();
