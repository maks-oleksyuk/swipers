/**
 * @file
 * Web behaviors.
 */
(function (Drupal) {

  'use strict';

  let byId = (id) => document.getElementById(id);

  function toolbar() {
    let form = byId('swiper-form-wrapper');
    let formToggle = byId('swiper-form-toggle');
    formToggle.addEventListener('click', function () {
      if (this.classList.contains('active')) {
        this.classList.remove('active');
        form.style.display = 'none';
      }
      else {
        this.classList.add('active');
        form.style.display = 'block';
      }
    });
  }

  function rangeAttributes() {
    let sliderStyleWidthType = byId('edit-slider-style-w-type');
    let sliderStyleWidthValue = byId('edit-slider-style-w-value');
    let sliderStyleHeightType = byId('edit-slider-style-h-type');
    let sliderStyleHeightValue = byId('edit-slider-style-h-value');
    let parametersSlideSizeType = byId('edit-parameters-size-type');
    let parametersSlideSizeValue = byId('edit-parameters-size-value');

    sliderStyleWidthType.addEventListener('change', function () {
      if (this.value === 'relative') {
        sliderStyleWidthValue.setAttribute('max', '100');
        sliderStyleWidthValue.setAttribute('value', '100');
      }
      else if (this.value === 'fixed') {
        sliderStyleWidthValue.setAttribute('max', '1920');
        sliderStyleWidthValue.setAttribute('value', '960');
      }
    });

    sliderStyleHeightType.addEventListener('change', function () {
      if (this.value === 'relative') {
        sliderStyleHeightValue.setAttribute('max', '100');
        sliderStyleHeightValue.setAttribute('value', '100');
      }
      else if (this.value === 'fixed') {
        sliderStyleHeightValue.setAttribute('max', '1920');
        sliderStyleHeightValue.setAttribute('value', '540');
      }
    });

    parametersSlideSizeType.addEventListener('change', function () {
      if (this.value === 'relative') {
        parametersSlideSizeValue.setAttribute('max', '100');
        parametersSlideSizeValue.setAttribute('value', '100');
      }
      else if (this.value === 'fixed') {
        parametersSlideSizeValue.setAttribute('max', '1920');
        parametersSlideSizeValue.setAttribute('value', '960');
      }
    });
  }

  function observeCheckboxes() {
    let observer = byId('edit-pro-observer');
    let observerParents = byId('edit-pro-observer-parents');

    observer.addEventListener('change', function () {
      if (!this.checked && observerParents.checked) {
        observerParents.checked = false;
      }
    });

    observerParents.addEventListener('change', function () {
      if (this.checked && !observer.checked) {
        observer.checked = true;
      }
    });
  }

  toolbar();
  rangeAttributes();
  observeCheckboxes();

  tippy('[data-tippy-content]', {
    arrow: false,
    offset: [0, 3],
    theme: 'swiper',
  });

}(Drupal));
