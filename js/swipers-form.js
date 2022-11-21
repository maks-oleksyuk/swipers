/**
 * @file
 * Web behaviors.
 */
(() => {
  const byId = (id) => document.getElementById(id);

  function rangeAttributes() {
    const sliderStyleWidthType = byId('edit-slider-style-w-type');
    const sliderStyleWidthValue = byId('edit-slider-style-w-value');
    const sliderStyleHeightType = byId('edit-slider-style-h-type');
    const sliderStyleHeightValue = byId('edit-slider-style-h-value');
    const parametersSlideSizeType = byId('edit-parameters-size-type');
    const parametersSlideSizeValue = byId('edit-parameters-size-value');

    sliderStyleWidthType.addEventListener('change', (e) => {
      if (e.currentTarget.value === 'relative') {
        sliderStyleWidthValue.setAttribute('max', '100');
        sliderStyleWidthValue.setAttribute('value', '100');
      } else if (e.currentTarget.value === 'fixed') {
        sliderStyleWidthValue.setAttribute('max', '1920');
        sliderStyleWidthValue.setAttribute('value', '960');
      }
    });

    sliderStyleHeightType.addEventListener('change', (e) => {
      if (e.currentTarget.value === 'relative') {
        sliderStyleHeightValue.setAttribute('max', '100');
        sliderStyleHeightValue.setAttribute('value', '100');
      } else if (e.currentTarget.value === 'fixed') {
        sliderStyleHeightValue.setAttribute('max', '1920');
        sliderStyleHeightValue.setAttribute('value', '540');
      }
    });

    parametersSlideSizeType.addEventListener('change', (e) => {
      if (e.currentTarget.value === 'relative') {
        parametersSlideSizeValue.setAttribute('max', '100');
        parametersSlideSizeValue.setAttribute('value', '100');
      } else if (e.currentTarget.value === 'fixed') {
        parametersSlideSizeValue.setAttribute('max', '1920');
        parametersSlideSizeValue.setAttribute('value', '960');
      }
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
