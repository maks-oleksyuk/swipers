/**
 * @file
 * Web behaviors.
 */
(() => {
  const byId = (id) => document.getElementById(id);

  function addMultipleEventListener(element, events, handler) {
    events.forEach((e) => element.addEventListener(e, handler));
  }

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
    const ps = byId('edit-slider-style-ps');
    const pe = byId('edit-slider-style-pe');

    addMultipleEventListener(ps, ['load', 'input'], rangeChange);
    addMultipleEventListener(pe, ['load', 'input'], rangeChange);
    ps.addEventListener('c', rangeChange);
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
