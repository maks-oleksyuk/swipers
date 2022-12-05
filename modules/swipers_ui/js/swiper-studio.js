/**
 * @file
 * Web behaviors.
 */
(() => {
  const byId = (id) => document.getElementById(id);
  const $ = (selectors) => document.querySelectorAll(selectors);

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
    $('.form-range').forEach((el) => {
      el.addEventListener('input', rangeChange);
      el.dispatchEvent(new Event('input'));
    });
  }

  toolbar();
  rangeProcess();

  $('.form-element--type-select').forEach((el) => {
    // eslint-disable-next-line no-undef
    return new Choices(el, {
      searchEnabled: false,
      itemSelectText: '',
      shouldSort: false,
    });
  });

  // eslint-disable-next-line no-undef
  tippy('[data-tippy-content]', {
    arrow: false,
    maxWidth: 240,
    offset: [0, 3],
    theme: 'swiper',
  });

  $('.form-element--type-color').forEach((el) => {
    // eslint-disable-next-line no-undef
    return new Alwan(el, {
      theme: 'dark',
      color: el.value,
      inputs: { hex: true, rgb: false, hsl: false },
      preview: false,
      copy: false,
    });
  });
})();
