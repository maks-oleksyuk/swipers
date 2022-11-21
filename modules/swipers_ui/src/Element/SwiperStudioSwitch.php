<?php

namespace Drupal\swipers_ui\Element;

use Drupal\Core\Render\Element\Checkbox;

/**
 * Provides a form element for a single switch using in Swiper Studio.
 *
 * Properties:
 * - #return_value: The value to return when the switch is checked.
 *
 * Usage example:
 *
 * @code
 * $form['copy'] = [
 *   '#type' => 'swiper_studio_switch',
 *   '#title' => $this->t('Send me a copy'),
 * ];
 * @endcode
 *
 * @see \Drupal\Core\Render\Element\Checkboxes
 *
 * @FormElement("swiper_studio_switch")
 */
class SwiperStudioSwitch extends Checkbox {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    $class = static::class;
    return [
      '#input' => TRUE,
      '#return_value' => 1,
      '#process' => [
        [$class, 'processCheckbox'],
        [$class, 'processAjaxForm'],
        [$class, 'processGroup'],
      ],
      '#pre_render' => [
        [$class, 'preRenderCheckbox'],
        [$class, 'preRenderGroup'],
      ],
      '#theme' => 'swiper_studio_switch',
      '#theme_wrappers' => ['swiper_studio_form_element'],
      '#title_display' => 'inline',
    ];
  }

}
