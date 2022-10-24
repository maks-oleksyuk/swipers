/**
 * @file
 * Web behaviors.
 */
(function (Drupal) {

  'use strict';

  let sliderStyleWidthType = document.getElementById('edit-slider-style-w-type');
  let sliderStyleWidthValue = document.getElementById('edit-slider-style-w-value');
  let sliderStyleHeightType = document.getElementById('edit-slider-style-h-type');
  let sliderStyleHeightValue = document.getElementById('edit-slider-style-h-value');
  // @todo fix value on first load
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

}(Drupal));
