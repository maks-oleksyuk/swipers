<?php

namespace Drupal\swipers\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Swiper Slider form class.
 *
 * @property \Drupal\swipers\SwiperSliderInterface $entity
 */
class SwiperSliderForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state): array {
    $form = parent::form($form, $form_state);
    $form['#tree'] = TRUE;
    // Main config settings.
    $form['main'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Main Settings'),
    ];
    $form['main']['label'] = [
      '#type' => 'textfield',
      '#maxlength' => 255,
      '#required' => TRUE,
      '#title' => $this->t('Label'),
      '#description' => $this->t('Label for the slider.'),
      '#default_value' => $this->entity->label(),
    ];
    $form['main']['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\swipers\Entity\SwiperSlider::load',
        'source' => ['main', 'label'],
      ],
      '#disabled' => !$this->entity->isNew(),
    ];
    $form['main']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#default_value' => $this->entity->status(),
    ];
    $form['main']['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#description' => $this->t('Description of the slider.'),
      '#default_value' => $this->entity->get('description'),
      '#resizable' => 'none',
    ];
    // Slider.
    $slider = $this->entity->get('slider');
    $form['slider'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Slider'),
    ];
    $form['slider']['direction'] = [
      '#type' => 'select',
      '#title' => $this->t('Language direction'),
      '#default_value' => $slider['direction'] ?? 'ltr',
      '#options' => [
        'ltr' => 'LTR',
        'rtl' => 'RTL',
      ],
    ];
    // Slider sizes & styles.
    $form['slider']['style'] = [
      '#type' => 'details',
      '#open' => FALSE,
      '#title' => $this->t('Slider sizes & styles'),
    ];
    $form['slider']['style']['size'] = [
      '#type' => 'select',
      '#title' => $this->t('Slider size'),
      '#default_value' => $slider['style']['size'] ?? 'responsive',
      '#options' => [
        'responsive' => 'responsive',
        'custom' => 'custom',
      ],
    ];
    // @todo add ajax function to change max and step parameters
    $form['slider']['style']['w_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Width'),
      '#default_value' => $slider['style']['w_type'] ?? 'relative',
      '#options' => [
        'relative' => 'relative',
        'fixed' => 'fixed',
      ],
      '#states' => [
        'visible' => [
          'select[name="slider[style][size]"]' => ['value' => 'custom'],
        ],
      ],
    ];
    $form['slider']['style']['w_value'] = [
      '#type' => 'range',
      '#default_value' => $slider['style']['w_value'] ?? NULL,
      '#min' => 0,
      '#states' => [
        'visible' => [
          'select[name="slider[style][size]"]' => ['value' => 'custom'],
        ],
      ],
    ];
    $form['slider']['style']['h_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Height'),
      '#default_value' => $slider['style']['h_type'] ?? 'relative',
      '#options' => [
        'relative' => 'relative',
        'fixed' => 'fixed',
      ],
      '#states' => [
        'visible' => [
          'select[name="slider[style][size]"]' => ['value' => 'custom'],
        ],
      ],
    ];
    $form['slider']['style']['h_value'] = [
      '#type' => 'range',
      '#default_value' => $slider['style']['h_value'] ?? NULL,
      '#min' => 0,
      '#states' => [
        'visible' => [
          'select[name="slider[style][size]"]' => ['value' => 'custom'],
        ],
      ],
    ];
    $form['slider']['style']['overflow'] = [
      '#type' => 'select',
      '#title' => $this->t('Overflow'),
      '#default_value' => $slider['style']['overflow'] ?? 'hidden',
      '#options' => [
        'hidden' => 'hidden',
        'visible' => 'visible',
      ],
    ];
    $form['slider']['style']['p_start'] = [
      '#type' => 'range',
      '#title' => $this->t('Padding start'),
      '#description' => $this->t('Padding top in horizontal direction and padding left in vertical direction'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => $slider['style']['p_start'] ?? 0,
    ];
    $form['slider']['style']['p_end'] = [
      '#type' => 'range',
      '#title' => $this->t('Padding end'),
      '#description' => $this->t('Padding bottom in horizontal direction and padding right in vertical direction'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => $slider['style']['p_end'] ?? 0,
    ];
    // Slides Content & Styles.
    $slides = $this->entity->get('slides');
    $form['slides'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Slides Content & Styles'),
    ];
    // Slides Content.
    $form['slides']['content'] = [
      '#type' => 'details',
      '#open' => FALSE,
      '#title' => $this->t('Slides content'),
    ];
    $form['slides']['content']['images'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Images'),
      '#default_value' => $slides['content']['images'] ?? FALSE,
    ];
    $form['slides']['content']['images_set'] = [
      '#type' => 'select',
      '#title' => $this->t('Images set'),
      '#options' => [
        'nature' => 'nature',
        'models' => 'models',
        'movies' => 'movies',
        'custom' => 'custom',
      ],
      '#default_value' => $slides['content']['images_set'] ?? 'nature',
      '#states' => [
        'visible' => [
          'input[name="slides[content][images]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['slides']['content']['title'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Title'),
      '#default_value' => $slides['content']['title'] ?? TRUE,
    ];
    $form['slides']['content']['text'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Text'),
      '#default_value' => $slides['content']['text'] ?? FALSE,
    ];
    $form['slides']['content']['position'] = [
      '#type' => 'select',
      '#title' => $this->t('Content position'),
      '#options' => [
        'left_top' => 'left top',
        'center_top' => 'center top',
        'right_top' => 'right top',
        'left' => 'left',
        'center' => 'center',
        'right' => 'right',
        'left_bottom' => 'left bottom',
        'center_bottom' => 'center bottom',
        'right_bottom' => 'right bottom',
      ],
      '#default_value' => $slides['content']['position'] ?? 'center',
      '#states' => [
        'visible' => [
          [':input[name="slides[content][title]"]' => ['checked' => TRUE]],
          [':input[name="slides[content][text]"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    // @todo add form item with modal form to custom content.
    // Slides Styles.
    $form['slides']['style'] = [
      '#type' => 'details',
      '#open' => FALSE,
      '#title' => $this->t('Slides styles'),
    ];
    $form['slides']['style']['br_radius'] = [
      '#type' => 'range',
      '#title' => $this->t('Slide border radius'),
      '#min' => 0,
      '#max' => 64,
      '#step' => 2,
      '#default_value' => $slides['style']['br_radius'] ?? 0,
    ];
    $form['slides']['style']['br_width'] = [
      '#type' => 'range',
      '#title' => $this->t('Slide border width'),
      '#min' => 0,
      '#max' => 16,
      '#step' => 1,
      '#default_value' => $slides['style']['br_width'] ?? 0,
    ];
    $form['slides']['style']['br_color'] = [
      '#type' => 'color',
      '#default_value' => $slides['style']['br_color'] ?? '#ff0000',
      '#title' => $this->t('Slide border color'),
    ];
    $form['slides']['style']['vertical_start'] = [
      '#type' => 'range',
      '#title' => $this->t('Content vertical padding'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => $slides['style']['vertical_start'] ?? 48,
    ];
    $form['slides']['style']['horizontal_start'] = [
      '#type' => 'range',
      '#title' => $this->t('Content horizontal padding'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => $slides['style']['horizontal_start'] ?? 48,
    ];
    $form['slides']['style']['background_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Background color'),
      '#description' => $this->t('Slide background color, will be disabled if parallax and images are enabled'),
      '#default_value' => $slides['style']['background_color'] ?? '#333333',
    ];
    $form['slides']['style']['title_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Title color'),
      '#default_value' => $slides['style']['title_color'] ?? '#ffffff',
    ];
    $form['slides']['style']['text_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Text color'),
      '#default_value' => $slides['style']['text_color'] ?? '#ffffff',
    ];
    // Parameters.
    $params = $this->entity->get('parameters');
    $form['parameters'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Parameters'),
    ];
    $form['parameters']['direction'] = [
      '#type' => 'select',
      '#title' => $this->t('Slide direction'),
      '#options' => [
        'horizontal' => 'horizontal',
        'vertical' => 'vertical',
      ],
      '#default_value' => $params['direction'] ?? 'horizontal',
      '#states' => [
        'disabled' => [
          'select[name="effects[effect]"]' => ['value' => 'carousel'],
        ],
      ],
    ];
    $form['parameters']['per_view'] = [
      '#type' => 'select',
      '#title' => $this->t('Slides per view'),
      '#description' => $this->t("Number of slides per view (slides visible at the same time on slider's container)"),
      '#options' => [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'auto' => 'auto',
      ],
      '#default_value' => $params['per_view'] ?? 1,
      '#states' => [
        'disabled' => [
          ['select[name="effects[effect]"]' => ['value' => 'fade']],
          ['select[name="effects[effect]"]' => ['value' => 'cube']],
          ['select[name="effects[effect]"]' => ['value' => 'flip']],
          ['select[name="effects[effect]"]' => ['value' => 'cards']],
          ['select[name="effects[effect]"]' => ['value' => 'shutters']],
          ['select[name="effects[effect]"]' => ['value' => 'slicer']],
          ['select[name="effects[effect]"]' => ['value' => 'gl']],
        ],
      ],
    ];
    $form['parameters']['size_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Slide size'),
      '#default_value' => $params['size_type'] ?? NULL,
      '#options' => [
        'relative' => 'relative',
        'fixed' => 'fixed',
      ],
      '#states' => [
        'visible' => [
          'select[name="parameters[per_view]"]' => ['value' => 'auto'],
        ],
      ],
    ];
    $form['parameters']['size_value'] = [
      '#type' => 'range',
      '#default_value' => $params['size_value'] ?? NULL,
      '#min' => 0,
      '#states' => [
        'visible' => [
          'select[name="parameters[per_view]"]' => ['value' => 'auto'],
        ],
      ],
    ];
    $form['parameters']['per_group'] = [
      '#type' => 'select',
      '#title' => $this->t('Slides per group'),
      '#description' => $this->t('Set numbers of slides to define and enable group sliding. Useful to use with "Slides per view" > 1'),
      '#options' => [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'auto' => 'auto',
      ],
      '#default_value' => $params['per_group'] ?? 1,
      '#states' => [
        'disabled' => [
          ['select[name="effects[effect]"]' => ['value' => 'fade']],
          ['select[name="effects[effect]"]' => ['value' => 'cube']],
          ['select[name="effects[effect]"]' => ['value' => 'flip']],
          ['select[name="effects[effect]"]' => ['value' => 'cards']],
          ['select[name="effects[effect]"]' => ['value' => 'carousel']],
          ['select[name="effects[effect]"]' => ['value' => 'shutters']],
          ['select[name="effects[effect]"]' => ['value' => 'slicer']],
          ['select[name="effects[effect]"]' => ['value' => 'gl']],
        ],
      ],
    ];
    $form['parameters']['rows'] = [
      '#type' => 'select',
      '#title' => $this->t('Slides rows'),
      '#description' => $this->t('Number of slides rows, for multirow layout'),
      '#options' => [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
      ],
      '#default_value' => $params['rows'] ?? 1,
      '#states' => [
        'disabled' => [
          'select[name="parameters[direction]"]' => ['value' => 'vertical'],
        ],
      ],
    ];
    $form['parameters']['centered'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Centered slides'),
      '#description' => $this->t('If enabled, then active slide will be centered, not always on the left side'),
      '#default_value' => $params['centered'] ?? FALSE,
      '#states' => [
        'disabled' => [
          ['select[name="effects[effect]"]' => ['value' => 'fade']],
          ['select[name="effects[effect]"]' => ['value' => 'cube']],
          ['select[name="effects[effect]"]' => ['value' => 'flip']],
          ['select[name="effects[effect]"]' => ['value' => 'cards']],
          ['select[name="effects[effect]"]' => ['value' => 'carousel']],
          ['select[name="effects[effect]"]' => ['value' => 'shutters']],
          ['select[name="effects[effect]"]' => ['value' => 'slicer']],
          ['select[name="effects[effect]"]' => ['value' => 'gl']],
        ],
      ],
    ];
    $form['parameters']['space'] = [
      '#type' => 'range',
      '#title' => $this->t('Space between slides'),
      '#description' => $this->t('Distance between slides'),
      '#min' => 0,
      '#max' => 100,
      '#step' => 1,
      '#default_value' => $params['space'] ?? 0,
    ];
    $form['parameters']['initial_slide'] = [
      '#type' => 'select',
      '#title' => $this->t('Initial slide'),
      '#description' => $this->t('Index number of initial slide (starts from 0)'),
      '#options' => [
        '0' => 0,
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
      ],
      '#default_value' => $params['initial_slide'] ?? 0,
    ];
    $form['parameters']['auto_height'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Auto height'),
      '#description' => $this->t('Enable and slider wrapper will adapt its height to the height of the currently active slide'),
      '#default_value' => $params['auto_height'] ?? FALSE,
    ];
    $form['parameters']['grab_cursor'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Grab cursor'),
      '#description' => $this->t('This option may a little improve desktop usability. If enabled, user will see the "grab" cursor when hover on Swiper'),
      '#default_value' => $params['grab_cursor'] ?? FALSE,
    ];
    $form['parameters']['slide_to_clicked_slide'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Slide to clicked slide'),
      '#description' => $this->t('Enable and click on any slide will produce transition to this slide'),
      '#default_value' => $params['slide_to_clicked_slide'] ?? FALSE,
      '#states' => [
        'disabled' => [
          ['select[name="effects[effect]"]' => ['value' => 'fade']],
          ['select[name="effects[effect]"]' => ['value' => 'cube']],
          ['select[name="effects[effect]"]' => ['value' => 'flip']],
          ['select[name="effects[effect]"]' => ['value' => 'cards']],
          ['select[name="effects[effect]"]' => ['value' => 'panorama']],
          ['select[name="effects[effect]"]' => ['value' => 'carousel']],
          ['select[name="effects[effect]"]' => ['value' => 'shutters']],
          ['select[name="effects[effect]"]' => ['value' => 'slicer']],
          ['select[name="effects[effect]"]' => ['value' => 'gl']],
        ],
      ],
    ];
    $form['parameters']['loop_mode'] = [
      '#type' => 'select',
      '#title' => $this->t('Loop mode'),
      '#description' => $this->t('Enables continuous loop mode'),
      '#options' => [
        'disabled' => 'disabled',
        'loop' => 'loop',
        'rewind' => 'rewind',
      ],
      '#default_value' => $params['loop_mode'] ?? 'disabled',
    ];
    // Effects.
    $effects = $this->entity->get('effects');
    $form['effects'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Effects'),
    ];
    $form['effects']['effect'] = [
      '#type' => 'select',
      '#title' => $this->t('Effect'),
      '#options' => [
        'slide' => 'slide',
        'fade' => 'fade',
        'cube' => 'cube',
        'flip' => 'flip',
        'coverflow' => 'coverflow',
        'cards' => 'cards',
        'panorama' => 'panorama',
        'carousel' => 'carousel',
        'shutters' => 'shutters',
        'slicer' => 'slicer',
        'gl' => 'gl',
      ],
      '#default_value' => $effects['effect'] ?? 'slide',
    ];
    // Fade.
    $form['effects']['fade'] = [
      '#type' => 'container',
    ];
    $form['effects']['fade']['crossfade'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Crossfade'),
      '#description' => $this->t('Enables slides cross fade'),
      '#default_value' => $effects['fade']['crossfade'] ?? FALSE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'fade'],
        ],
      ],
    ];
    // Cube.
    $form['effects']['cube'] = [
      '#type' => 'container',
    ];
    $form['effects']['cube']['slide_shadows'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Slide shadows'),
      '#description' => $this->t('Enables slides shadows'),
      '#default_value' => $effects['cube']['slide_shadows'] ?? TRUE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'cube'],
        ],
      ],
    ];
    $form['effects']['cube']['main_shadow'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Main shadow'),
      '#description' => $this->t('Enables main slider shadow'),
      '#default_value' => $effects['cube']['main_shadow'] ?? TRUE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'cube'],
        ],
      ],
    ];
    $form['effects']['cube']['main_shadow_offset'] = [
      '#type' => 'range',
      '#title' => $this->t('Main shadow offset'),
      '#description' => $this->t('Main shadow offset in px'),
      '#min' => 0,
      '#max' => 100,
      '#step' => 1,
      '#default_value' => $effects['cube']['main_shadow_offset'] ?? 20,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'cube'],
        ],
      ],
    ];
    $form['effects']['cube']['main_shadow_scale'] = [
      '#type' => 'range',
      '#title' => $this->t('Main shadow scale'),
      '#description' => $this->t('Main shadow scale ratio'),
      '#min' => 0,
      '#max' => 2,
      '#step' => 0.01,
      '#default_value' => $effects['cube']['main_shadow_scale'] ?? 0.94,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'cube'],
        ],
      ],
    ];
    // Flip.
    $form['effects']['flip'] = [
      '#type' => 'container',
    ];
    $form['effects']['flip']['slide_shadows'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Slide shadows'),
      '#description' => $this->t('Enables slides shadows'),
      '#default_value' => $effects['flip']['slide_shadows'] ?? TRUE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'flip'],
        ],
      ],
    ];
    $form['effects']['flip']['limit_rotation'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Limit rotation'),
      '#description' => $this->t('Limit edge slides rotation'),
      '#default_value' => $effects['flip']['limit_rotation'] ?? TRUE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'flip'],
        ],
      ],
    ];
    // Coverflow.
    $form['effects']['coverflow'] = [
      '#type' => 'container',
    ];
    $form['effects']['coverflow']['slide_shadows'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Slide shadows'),
      '#description' => $this->t('Enables slides shadows'),
      '#default_value' => $effects['coverflow']['slide_shadows'] ?? TRUE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'coverflow'],
        ],
      ],
    ];
    $form['effects']['coverflow']['depth'] = [
      '#type' => 'range',
      '#title' => $this->t('Depth'),
      '#description' => $this->t('Depth offset in px (slides translate in Z axis)'),
      '#min' => 0,
      '#max' => 1000,
      '#step' => 1,
      '#default_value' => $effects['coverflow']['depth'] ?? 100,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'coverflow'],
        ],
      ],
    ];
    $form['effects']['coverflow']['rotate'] = [
      '#type' => 'range',
      '#title' => $this->t('Rotate'),
      '#description' => $this->t('Slide rotate in degrees'),
      '#min' => 0,
      '#max' => 360,
      '#step' => 1,
      '#default_value' => $effects['coverflow']['rotate'] ?? 50,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'coverflow'],
        ],
      ],
    ];
    $form['effects']['coverflow']['scale'] = [
      '#type' => 'range',
      '#title' => $this->t('Scale'),
      '#description' => $this->t('Slide scale effect'),
      '#min' => 0,
      '#max' => 2,
      '#step' => 0.05,
      '#default_value' => $effects['coverflow']['scale'] ?? 1,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'coverflow'],
        ],
      ],
    ];
    $form['effects']['coverflow']['stretch'] = [
      '#type' => 'range',
      '#title' => $this->t('Stretch'),
      '#description' => $this->t('Stretch space between slides (in px)'),
      '#min' => -100,
      '#max' => 100,
      '#step' => 1,
      '#default_value' => $effects['coverflow']['stretch'] ?? 0,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'coverflow'],
        ],
      ],
    ];
    $form['effects']['coverflow']['multiplier'] = [
      '#type' => 'range',
      '#title' => $this->t('Effect multiplier'),
      '#min' => -0,
      '#max' => 3,
      '#step' => 0.1,
      '#default_value' => $effects['coverflow']['multiplier'] ?? 1,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'coverflow'],
        ],
      ],
    ];
    // Cards.
    $form['effects']['cards'] = [
      '#type' => 'container',
    ];
    $form['effects']['cards']['slide_shadows'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Slide shadows'),
      '#description' => $this->t('Enables slides shadows'),
      '#default_value' => $effects['cards']['slide_shadows'] ?? TRUE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'cards'],
        ],
      ],
    ];
    $form['effects']['cards']['rotate'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Rotate'),
      '#description' => $this->t('Enables cards rotation'),
      '#default_value' => $effects['cards']['rotate'] ?? TRUE,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'cards'],
        ],
      ],
    ];
    // Panorama.
    $form['effects']['panorama'] = [
      '#type' => 'container',
    ];
    $form['effects']['panorama']['depth'] = [
      '#type' => 'range',
      '#title' => $this->t('Depth'),
      '#description' => $this->t('Depth offset in px'),
      '#min' => 0,
      '#max' => 1000,
      '#step' => 10,
      '#default_value' => $effects['panorama']['depth'] ?? 200,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'panorama'],
        ],
      ],
    ];
    $form['effects']['panorama']['rotate'] = [
      '#type' => 'range',
      '#title' => $this->t('Rotate'),
      '#description' => $this->t('Slides "arc" rotate in degrees'),
      '#min' => 0,
      '#max' => 60,
      '#step' => 1,
      '#default_value' => $effects['panorama']['rotate'] ?? 30,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'panorama'],
        ],
      ],
    ];
    // Shutters.
    $form['effects']['shutters'] = [
      '#type' => 'container',
    ];
    $form['effects']['shutters']['split'] = [
      '#type' => 'range',
      '#title' => $this->t('Split'),
      '#description' => $this->t('Split images into panes (shutters)'),
      '#min' => 3,
      '#max' => 10,
      '#step' => 1,
      '#default_value' => $effects['shutters']['split'] ?? 5,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'shutters'],
        ],
      ],
    ];
    // Slicer.
    $form['effects']['slicer'] = [
      '#type' => 'container',
    ];
    $form['effects']['slicer']['split'] = [
      '#type' => 'range',
      '#title' => $this->t('Split'),
      '#description' => $this->t('Split images into slices'),
      '#min' => 2,
      '#max' => 20,
      '#step' => 1,
      '#default_value' => $effects['slicer']['split'] ?? 5,
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'slicer'],
        ],
      ],
    ];
    // Gl.
    $form['effects']['gl'] = [
      '#type' => 'container',
    ];
    $form['effects']['gl']['shader'] = [
      '#type' => 'select',
      '#title' => $this->t('Shader'),
      '#description' => $this->t('Shader used for transition effect. If set to "random" it will randomly pick new shader with every new transition'),
      '#options' => [
        'random' => 'random',
        'dots' => 'dots',
        'flyeye' => 'flyeye',
        'morph_x' => 'morph x',
        'morph_y' => 'morph y',
        'page_curl' => 'page curl',
        'peel_x' => 'peel x',
        'peel_y' => 'peel y',
        'polygons_fall' => 'polygons fall',
        'polygons_morph' => 'polygons morph',
        'polygons_wind' => 'polygons wind',
        'pixelize' => 'pixelize',
        'ripple' => 'ripple',
        'shutters' => 'shutters',
        'slices' => 'slices',
        'squares' => 'squares',
        'stretch' => 'stretch',
        'wave_x' => 'wave x',
        'wind' => 'wind',
      ],
      '#default_value' => $effects['gl']['shader'] ?? 'random',
      '#states' => [
        'visible' => [
          'select[name="effects[effect]"]' => ['value' => 'gl'],
        ],
      ],
    ];
    // Duration for all effects.
    $form['effects']['duration'] = [
      '#type' => 'range',
      '#title' => $this->t('Transition duration'),
      '#description' => $this->t('Duration of transition between slides (in ms)'),
      '#min' => 0,
      '#max' => 10000,
      '#step' => 100,
      '#default_value' => $effects['duration'] ?? 300,
    ];
    // Modules.
    $modules = $this->entity->get('modules');
    $form['modules'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Modules'),
    ];
    // Navigation.
    $form['modules']['navigation'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['navigation']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Navigation'),
      '#description' => $this->t('Enables navigation arrows/buttons'),
      '#default_value' => $modules['navigation']['status'] ?? FALSE,
    ];
    $form['modules']['navigation']['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#description' => $this->t('Navigation buttons color'),
      '#default_value' => $modules['navigation']['color'] ?? '#007afa',
      '#states' => [
        'visible' => [
          ':input[name="modules[navigation][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['navigation']['placement'] = [
      '#type' => 'select',
      '#title' => $this->t('Placement'),
      '#description' => $this->t('Renders navigation buttons inside or outside of Swiper container element'),
      '#options' => [
        'inside' => 'inside',
        'outside' => 'outside',
      ],
      '#default_value' => $modules['navigation']['placement'] ?? 'inside',
      '#states' => [
        'visible' => [
          ':input[name="modules[navigation][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['navigation']['position'] = [
      '#type' => 'select',
      '#title' => $this->t('Position'),
      '#description' => $this->t('Navigation buttons position'),
      '#options' => [
        'top' => 'top',
        'center' => 'center',
        'bottom' => 'bottom',
      ],
      '#default_value' => $modules['navigation']['placement'] ?? 'center',
      '#states' => [
        'visible' => [
          ':input[name="modules[navigation][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['navigation']['hide_on_click'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide on click'),
      '#description' => $this->t("Toggle navigation buttons visibility after click on Slider's container"),
      '#default_value' => $modules['navigation']['hide_on_click'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[navigation][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Pagination.
    $form['modules']['pagination'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['pagination']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Pagination'),
      '#description' => $this->t('Enables pagination'),
      '#default_value' => $modules['pagination']['status'] ?? FALSE,
    ];
    $form['modules']['pagination']['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#description' => $this->t('Pagination color'),
      '#default_value' => $modules['pagination']['color'] ?? '#007afa',
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['pagination']['placement'] = [
      '#type' => 'select',
      '#title' => $this->t('Placement'),
      '#description' => $this->t('Renders pagination inside or outside of Swiper container element'),
      '#options' => [
        'inside' => 'inside',
        'outside' => 'outside',
      ],
      '#default_value' => $modules['pagination']['placement'] ?? 'inside',
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['pagination']['position'] = [
      '#type' => 'select',
      '#title' => $this->t('Position'),
      '#description' => $this->t('Pagination position'),
      '#options' => [
        'start' => 'start',
        'end' => 'end',
      ],
      '#default_value' => $modules['pagination']['position'] ?? 'end',
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['pagination']['hide_on_click'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide on click'),
      '#description' => $this->t("Toggle (hide/show) pagination container visibility after click on Slider's container"),
      '#default_value' => $modules['pagination']['hide_on_click'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['pagination']['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type'),
      '#options' => [
        'bullets' => 'bullets',
        'progressbar' => 'progressbar',
        'fraction' => 'fraction',
      ],
      '#default_value' => $modules['pagination']['type'] ?? 'bullets',
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['pagination']['clickable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Clickable'),
      '#description' => $this->t('If enabled then clicking on pagination button will cause transition to appropriate slide. Only for "bullets" pagination type'),
      '#default_value' => $modules['pagination']['clickable'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
          'select[name="modules[pagination][type]"]' => ['value' => 'bullets'],
        ],
      ],
    ];
    $form['modules']['pagination']['dynamic_bullets'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Dynamic bullets'),
      '#description' => $this->t('Good to enable if you use bullets pagination with a lot of slides. So it will keep only few bullets visible at the same time'),
      '#default_value' => $modules['pagination']['dynamic_bullets'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
          'select[name="modules[pagination][type]"]' => ['value' => 'bullets'],
        ],
      ],
    ];
    $form['modules']['pagination']['dynamic_main_bullets'] = [
      '#type' => 'range',
      '#title' => $this->t('Dynamic main bullets'),
      '#description' => $this->t('The number of main bullets visible when "Dynamic bullets" enabled'),
      '#min' => 1,
      '#max' => 10,
      '#step' => 1,
      '#default_value' => $modules['pagination']['dynamic_main_bullets'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
          'select[name="modules[pagination][type]"]' => ['value' => 'bullets'],
        ],
        'disabled' => [
          ':input[name="modules[pagination][dynamic_bullets]"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['modules']['pagination']['progressbar_opposite'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Progressbar opposite'),
      '#description' => $this->t("Makes pagination progressbar opposite to Swiper's direction parameter, means vertical progressbar for horizontal swiper direction and horizontal progressbar for vertical swiper direction"),
      '#default_value' => $modules['pagination']['progressbar_opposite'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][status]"]' => ['checked' => TRUE],
          'select[name="modules[pagination][type]"]' => ['value' => 'progressbar'],
        ],
      ],
    ];
    // Autoplay.
    $form['modules']['autoplay'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['autoplay']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Autoplay'),
      '#description' => $this->t('Enables autoplay'),
      '#default_value' => $modules['autoplay']['status'] ?? FALSE,
    ];
    $form['modules']['autoplay']['delay'] = [
      '#type' => 'range',
      '#title' => $this->t('Delay'),
      '#description' => $this->t('Delay between transitions (in ms).'),
      '#min' => 0,
      '#max' => 10000,
      '#step' => 100,
      '#default_value' => $modules['autoplay']['delay'] ?? 3000,
      '#states' => [
        'visible' => [
          ':input[name="modules[autoplay][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['autoplay']['pause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Pause on pointer enter'),
      '#description' => $this->t('When enabled autoplay will be paused on mouse enter over Swiper container. If "Disable on interaction" is also enabled, it will stop autoplay instead of pause'),
      '#default_value' => $modules['autoplay']['pause'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[autoplay][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['autoplay']['disable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable on interaction'),
      '#description' => $this->t('Disabled and autoplay will not be disabled after user interactions (swipes), it will be restarted every time after interaction'),
      '#default_value' => $modules['autoplay']['disable'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[autoplay][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['autoplay']['reverse_direction'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Reverse direction'),
      '#description' => $this->t('Enables autoplay in reverse direction'),
      '#default_value' => $modules['autoplay']['reverse_direction'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[autoplay][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['autoplay']['stop_on_last_slide'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Stop on last slide'),
      '#description' => $this->t('When enabled autoplay will be stopped when it reaches last slide (has no effect in loop mode)'),
      '#default_value' => $modules['autoplay']['stop_on_last_slide'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[autoplay][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Scrollbar.
    $form['modules']['scrollbar'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['scrollbar']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Scrollbar'),
      '#description' => $this->t('Enables scrollbar'),
      '#default_value' => $modules['scrollbar']['status'] ?? FALSE,
    ];
    $form['modules']['scrollbar']['track_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Track color'),
      '#description' => $this->t('Scrollbar track color'),
      '#default_value' => $modules['scrollbar']['track_color'] ?? '#000000',
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['scrollbar']['thumb_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Thumb color'),
      '#description' => $this->t('Scrollbar thumb color'),
      '#default_value' => $modules['scrollbar']['thumb_color'] ?? '#3b3b3b',
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['scrollbar']['placement'] = [
      '#type' => 'select',
      '#title' => $this->t('Placement'),
      '#description' => $this->t('Renders scrollbar inside or outside of Swiper container element'),
      '#options' => [
        'inside' => 'inside',
        'outside' => 'outside',
      ],
      '#default_value' => $modules['scrollbar']['placement'] ?? 'inside',
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['scrollbar']['position'] = [
      '#type' => 'select',
      '#title' => $this->t('Position'),
      '#description' => $this->t('Scrollbar position'),
      '#options' => [
        'start' => 'start',
        'end' => 'end',
      ],
      '#default_value' => $modules['scrollbar']['position'] ?? 'end',
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['scrollbar']['draggable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Draggable'),
      '#description' => $this->t('Makes scrollbar draggable that allows you to control slider position'),
      '#default_value' => $modules['scrollbar']['draggable'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['scrollbar']['hide_after_interaction'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide after interaction'),
      '#description' => $this->t('Hide scrollbar automatically after user interaction'),
      '#default_value' => $modules['scrollbar']['hide_after_interaction'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['scrollbar']['snap_on_release'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Snap on release'),
      '#description' => $this->t('Snap slider position to slides when you release scrollbar'),
      '#default_value' => $modules['scrollbar']['snap_on_release'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Free mode.
    $form['modules']['free_mode'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['free_mode']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Free mode'),
      '#description' => $this->t('Enables free mode'),
      '#default_value' => $modules['free_mode']['status'] ?? FALSE,
    ];
    $form['modules']['free_mode']['sticky'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Sticky'),
      '#description' => $this->t('Enables snap to slides positions in free mode'),
      '#default_value' => $modules['free_mode']['sticky'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[free_mode][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['free_mode']['momentum'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Momentum'),
      '#description' => $this->t('If enabled, then slide will keep moving for a while after you release it'),
      '#default_value' => $modules['free_mode']['momentum'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[free_mode][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['free_mode']['momentum_bounce'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Momentum bounce'),
      '#description' => $this->t('Enables momentum bounce in free mode'),
      '#default_value' => $modules['free_mode']['momentum_bounce'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[free_mode][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['free_mode']['momentum_bounce_ratio'] = [
      '#type' => 'range',
      '#title' => $this->t('Momentum bounce ratio'),
      '#description' => $this->t('Higher value produces larger momentum bounce effect'),
      '#min' => 0.1,
      '#max' => 3,
      '#step' => 0.1,
      '#default_value' => $modules['free_mode']['momentum_bounce_ratio'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[free_mode][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['free_mode']['momentum_ratio'] = [
      '#type' => 'range',
      '#title' => $this->t('Momentum ratio'),
      '#description' => $this->t('Higher value produces larger momentum distance after you release slider'),
      '#min' => 0.1,
      '#max' => 3,
      '#step' => 0.1,
      '#default_value' => $modules['free_mode']['momentum_ratio'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[free_mode][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['free_mode']['momentum_velocity_ratio'] = [
      '#type' => 'range',
      '#title' => $this->t('Momentum velocity ratio'),
      '#description' => $this->t('Higher value produces larger momentum velocity after you release slider'),
      '#min' => 0.1,
      '#max' => 3,
      '#step' => 0.1,
      '#default_value' => $modules['free_mode']['momentum_ratio'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[free_mode][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Keyboard control.
    $form['modules']['keyboard'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['keyboard']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Keyboard control'),
      '#description' => $this->t('Enables keyboard control'),
      '#default_value' => $modules['keyboard']['status'] ?? FALSE,
    ];
    $form['modules']['keyboard']['only_in_viewport'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Only in viewport'),
      '#description' => $this->t('When enabled it will control sliders that are currently in viewport'),
      '#default_value' => $modules['keyboard']['only_in_viewport'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[keyboard][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['keyboard']['keys'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Page UP/Down keys'),
      '#description' => $this->t('When enabled it will enable keyboard navigation by Page Up and Page Down keys'),
      '#default_value' => $modules['keyboard']['only_in_viewport'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[keyboard][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Mousewheel control.
    $form['modules']['mousewheel'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['mousewheel']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Mousewheel control'),
      '#description' => $this->t('Enables mousewheel control'),
      '#default_value' => $modules['mousewheel']['status'] ?? FALSE,
    ];
    $form['modules']['mousewheel']['force_to_axis'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Force to axis'),
      '#description' => $this->t('Enable to force mousewheel swipes to axis. So in horizontal mode mousewheel will work only with horizontal mousewheel scrolling, and only with vertical scrolling in vertical mode.'),
      '#default_value' => $modules['mousewheel']['force_to_axis'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[mousewheel][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['mousewheel']['invert_scrolling'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Invert scrolling'),
      '#description' => $this->t('Enable to invert sliding direction'),
      '#default_value' => $modules['mousewheel']['invert_scrolling'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[mousewheel][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['mousewheel']['release_on_edges'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Release on edges'),
      '#description' => $this->t('Enable and swiper will release mousewheel event and allow page scrolling when swiper is on edge positions (in the beginning or in the end)'),
      '#default_value' => $modules['mousewheel']['release_on_edges'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[mousewheel][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['mousewheel']['sensitivity'] = [
      '#type' => 'range',
      '#title' => $this->t('Sensitivity'),
      '#description' => $this->t('Multiplier of mousewheel data, allows to tweak mouse wheel sensitivity'),
      '#min' => 0.1,
      '#max' => 2,
      '#step' => 0.1,
      '#default_value' => $modules['mousewheel']['sensitivity'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[mousewheel][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Parallax.
    $form['modules']['parallax'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['parallax']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Parallax'),
      '#description' => $this->t('Enables parallax transition effects'),
      '#default_value' => $modules['parallax']['status'] ?? FALSE,
    ];
    $form['modules']['parallax']['effect_multiplier'] = [
      '#type' => 'range',
      '#title' => $this->t('Effect multiplier'),
      '#min' => 0.1,
      '#max' => 5,
      '#step' => 0.1,
      '#default_value' => $modules['parallax']['effect_multiplier'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[parallax][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Lazy loading.
    $form['modules']['lazy'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['lazy']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Lazy loading'),
      '#description' => $this->t('Enables images lazy loading. It will also enable slides images'),
      '#default_value' => $modules['lazy']['status'] ?? FALSE,
    ];
    $form['modules']['lazy']['check_in_view'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Check in view'),
      '#description' => $this->t('Enables to check is the Swiper in view before lazy loading images on initial slides'),
      '#default_value' => $modules['lazy']['check_in_view'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[lazy][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['lazy']['load_on_transition_start'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load on transition start'),
      '#description' => $this->t('By default, Swiper will load lazy images after transition to this slide, so you may enable this parameter if you need it to start loading of new image in the beginning of transition'),
      '#default_value' => $modules['lazy']['load_on_transition_start'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[lazy][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['lazy']['load_in_prev_next_slides'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load in prev next slides'),
      '#description' => $this->t('Enables lazy loading for the closest slides images (for previous and next slide images)'),
      '#default_value' => $modules['lazy']['load_in_prev_next_slides'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[lazy][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['lazy']['load_in_prev_next_amount'] = [
      '#type' => 'range',
      '#title' => $this->t('Load in prev next amount'),
      '#description' => $this->t('Amount of next/prev slides to preload lazy images in'),
      '#min' => 1,
      '#max' => 10,
      '#step' => 1,
      '#default_value' => $modules['lazy']['load_in_prev_next_amount'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[lazy][status]"]' => ['checked' => TRUE],
        ],
        'disabled' => [
          ':input[name="modules[lazy][load_in_prev_next_slides]"]' => ['checked' => FALSE],
        ],
      ],
    ];
    // Accessibility.
    $form['modules']['accessibility'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['accessibility']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Accessibility'),
      '#description' => $this->t('Enables accessibility features and attributes for screen readers'),
      '#default_value' => $modules['accessibility']['status'] ?? TRUE,
    ];
    // Zoom.
    $form['modules']['zoom'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['zoom']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Zoom'),
      '#description' => $this->t('Enables images zoom on double tap/click and pinch to zoom'),
      '#default_value' => $modules['zoom']['status'] ?? FALSE,
    ];
    $form['modules']['zoom']['minimal_ratio'] = [
      '#type' => 'range',
      '#title' => $this->t('Minimal ratio'),
      '#description' => $this->t('Minimal image zoom multiplier'),
      '#min' => 1,
      '#max' => 10,
      '#step' => 1,
      '#default_value' => $modules['zoom']['minimal_ratio'] ?? 1,
      '#states' => [
        'visible' => [
          ':input[name="modules[zoom][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['modules']['zoom']['maximum_ratio'] = [
      '#type' => 'range',
      '#title' => $this->t('Maximum ratio'),
      '#description' => $this->t('Maximum image zoom multiplier'),
      '#min' => 1,
      '#max' => 10,
      '#step' => 1,
      '#default_value' => $modules['zoom']['maximum_ratio'] ?? 3,
      '#states' => [
        'visible' => [
          ':input[name="modules[zoom][status]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Pro parameters.
    $pro = $this->entity->get('pro');
    $form['pro'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Pro parameters'),
    ];
    // @todo add 'Custom CSS styles' modal form
    $form['pro']['css_mode'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('CSS mode'),
      '#description' => $this->t("When enabled it will use modern CSS Scroll Snap API. It doesn't support all of Swiper's features, but potentially should bring a much better performance in simple configurations."),
      '#default_value' => $pro['css_mode'] ?? FALSE,
    ];
    $form['pro']['simulate_touch'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Simulate touch'),
      '#description' => $this->t('If enabled, Swiper will accept mouse events like touch events (click and drag to change slides)'),
      '#default_value' => $pro['simulate_touch'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['watch_slides_progress'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Watch slides progress'),
      '#description' => $this->t('Enable this feature to calculate each slides progress and visibility (slides in viewport will have additional visible class)'),
      '#default_value' => $pro['watch_slides_progress'] ?? FALSE,
    ];
    $form['pro']['allow_slide_prev'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow slide prev'),
      '#description' => $this->t('Enables swiping to previous slide direction (to left or top)'),
      '#default_value' => $pro['allow_slide_prev'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['allow_slide_next'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow slide next'),
      '#description' => $this->t('Enables swiping to next slide direction (to right or bottom)'),
      '#default_value' => $pro['allow_slide_next'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['allow_touch_move'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow touch move'),
      '#description' => $this->t('If disabled, then the only way to switch the slide is use of external API functions like slidePrev or slideNext'),
      '#default_value' => $pro['allow_touch_move'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['follow_finger'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Follow finger'),
      '#description' => $this->t('If disabled, then slider will be animated only when you release it, it will not move while you hold your finger on it'),
      '#default_value' => $pro['follow_finger'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['long_swipes'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Long swipes'),
      '#description' => $this->t('Enable long swipes'),
      '#default_value' => $pro['long_swipes'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['short_swipes'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Short swipes'),
      '#description' => $this->t('Enable short swipes'),
      '#default_value' => $pro['short_swipes'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // @todo fix states in observer, observer_parents
    $form['pro']['observer'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Observer'),
      '#description' => $this->t('Enables Mutation Observer on Swiper and its elements. In this case Swiper will be updated (reinitialized) each time if you change its style (like hide/show) or modify its child elements (like adding/removing slides)'),
      '#default_value' => $pro['observer'] ?? FALSE,
      '#states' => [
        'checked' => [
          ':input[name="pro[observer_parents]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['observer_parents'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Observe parents'),
      '#description' => $this->t('Enable if you also need to wa tch Mutations for Swiper parent elements'),
      '#default_value' => $pro['observer_parents'] ?? FALSE,
      '#states' => [
        'unchecked' => [
          ':input[name="pro[observer]"]' => ['unchecked' => TRUE],
        ],
      ],
    ];
    $form['pro']['resistance'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Resistance'),
      '#description' => $this->t('Enables resistant bounds'),
      '#default_value' => $pro['resistance'] ?? TRUE,
      '#states' => [
        'disabled' => [
          ':input[name="pro[css_mode]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['resistance_ratio'] = [
      '#type' => 'range',
      '#title' => $this->t('Resistance ratio'),
      '#description' => $this->t('This option allows you to control resistance ratio'),
      '#min' => 0,
      '#max' => 1,
      '#step' => 0.05,
      '#default_value' => $pro['resistance_ratio'] ?? 0.85,
      '#states' => [
        'disabled' => [
          [':input[name="pro[css_mode]"]' => ['checked' => TRUE]],
          [':input[name="pro[resistance]"]' => ['checked' => FALSE]],
        ],
      ],
    ];
    $form['pro']['resize_observer'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Resize observer'),
      '#description' => $this->t('When enabled it will use ResizeObserver (if supported by browser) on swiper container to detect container resize (instead of watching for window resize)'),
      '#default_value' => $pro['resize_observer'] ?? TRUE,
    ];
    $form['pro']['touch_threshold'] = [
      '#type' => 'range',
      '#title' => $this->t('Touch threshold'),
      '#description' => $this->t('Threshold value in px. If "touch distance" will be lower than this value then swiper will not move'),
      '#min' => 0,
      '#max' => 100,
      '#step' => 1,
      '#default_value' => $pro['touch_threshold'] ?? 0,
      '#states' => [
        'disabled' => [
          ':input[name="css_mode"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['pro']['touch_radio'] = [
      '#type' => 'range',
      '#title' => $this->t('Touch ratio'),
      '#min' => 0,
      '#max' => 10,
      '#step' => 0.25,
      '#default_value' => $pro['touch_radio'] ?? 1,
      '#states' => [
        'disabled' => [
          ':input[name="css_mode"]' => ['checked' => TRUE],
        ],
      ],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Core\Entity\EntityMalformedException
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $values = $form_state->getValues();
    $this->entity
      ->set('label', $values['main']['label'])
      ->set('id', $values['main']['id'])
      ->set('status', $values['main']['status'])
      ->set('description', $values['main']['description']);
    $result = parent::save($form, $form_state);
    $message_args = ['%label' => $this->entity->label()];
    $message = $result == SAVED_NEW
      ? $this->t('Created new slider %label.', $message_args)
      : $this->t('Updated slider %label.', $message_args);
    $this->messenger()->addStatus($message);
    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
    return $result;
  }

}
