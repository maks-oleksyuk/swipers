/**
 * @file
 * Web behaviors.
 */
(() => {
  const byId = (id) => document.getElementById(id);

  function updateRangeAttributes(e, el, value) {
    if (e.currentTarget.value === 'relative') {
      el.setAttribute('max', '100');
      el.setAttribute('value', '100');
      el.setAttribute('data-unit', '%');
      el.dispatchEvent(new Event('input'));
    } else if (e.currentTarget.value === 'fixed') {
      el.setAttribute('max', '1920');
      el.setAttribute('value', value);
      el.setAttribute('data-unit', 'px');
    }
    el.dispatchEvent(new Event('input'));
  }

  function rangeAttributes() {
    const sliderStyleWidthType = byId('edit-slider-style-w-type');
    const sliderStyleWidthValue = byId('edit-slider-style-w-value');
    const sliderStyleHeightType = byId('edit-slider-style-h-type');
    const sliderStyleHeightValue = byId('edit-slider-style-h-value');
    const parametersSlideSizeType = byId('edit-parameters-size-type');
    const parametersSlideSizeValue = byId('edit-parameters-size-value');

    sliderStyleWidthType.addEventListener('change', (e) => {
      updateRangeAttributes(e, sliderStyleWidthValue, '960');
    });

    sliderStyleHeightType.addEventListener('change', (e) => {
      updateRangeAttributes(e, sliderStyleHeightValue, '540');
    });

    parametersSlideSizeType.addEventListener('change', (e) => {
      updateRangeAttributes(e, parametersSlideSizeValue, '960');
    });
  }

  function observeCheckboxes() {
    const observer = byId('edit-pro-observer');
    const observerParents = byId('edit-pro-observer-parents');

    observer.addEventListener('change', (e) => {
      if (!e.currentTarget.checked && observerParents.checked) {
        observerParents.checked = false;
      }
    });

    observerParents.addEventListener('change', (e) => {
      if (e.currentTarget.checked && !observer.checked) {
        observer.checked = true;
      }
    });
  }

  rangeAttributes();
  observeCheckboxes();
})();
