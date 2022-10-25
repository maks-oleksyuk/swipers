/**
 * @file
 * Web behaviors.
 */
(function (Drupal) {

  'use strict';

  function rangeAttributes() {
    let sliderStyleWidthType = document.getElementById('edit-slider-style-w-type');
    let sliderStyleWidthValue = document.getElementById('edit-slider-style-w-value');
    let sliderStyleHeightType = document.getElementById('edit-slider-style-h-type');
    let sliderStyleHeightValue = document.getElementById('edit-slider-style-h-value');

    sliderStyleWidthType.addEventListener('change', function () {
      if (sliderStyleWidthType.value === 'relative') {
        sliderStyleWidthValue.setAttribute('max', '100');
        sliderStyleWidthValue.setAttribute('value', '100');
      }
      else if (sliderStyleWidthType.value === 'fixed') {
        sliderStyleWidthValue.setAttribute('max', '1920');
        sliderStyleWidthValue.setAttribute('value', '960');
      }
    })

    sliderStyleHeightType.addEventListener('change', function () {
      if (sliderStyleHeightType.value === 'relative') {
        sliderStyleHeightValue.setAttribute('max', '100');
        sliderStyleHeightValue.setAttribute('value', '100');
      }
      else if (sliderStyleHeightType.value === 'fixed') {
        sliderStyleHeightValue.setAttribute('max', '1920');
        sliderStyleHeightValue.setAttribute('value', '540');
      }
    })
  }

  function observeCheckboxes() {
    let observer = document.getElementById('edit-pro-observer');
    let observerParents = document.getElementById('edit-pro-observer-parents');

    observer.addEventListener('change', function () {
      if (!observer.checked && observerParents.checked) {
        observerParents.checked = false;
      }
    })

    observerParents.addEventListener('change', function () {
      if (observerParents.checked && !observer.checked) {
        observer.checked = true;
      }
    })
  }

  rangeAttributes();
  observeCheckboxes()

}(Drupal));
