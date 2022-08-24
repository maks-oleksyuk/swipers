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

    $form['main'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Main Settings'),
    ];
    $form['main']['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Label for the slider.'),
      '#required' => TRUE,
    ];
    $form['main']['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\swipers\Entity\SwiperSlider::load',
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
      '#default_value' => $this->entity->get('description'),
      '#description' => $this->t('Description of the slider.'),
    ];

    $form['slider'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Slider'),
    ];
    $form['slider']['direction'] = [
      '#type' => 'select',
      '#title' => $this->t('Language direction'),
      '#default_value' => $this->entity->get('direction'),
      '#options' => [
        'ltr' => 'ltr',
        'rtl' => 'rtl',
      ],
    ];

    $form['slider']['style'] = [
      '#type' => 'details',
      '#open' => FALSE,
      '#title' => $this->t('Slider sizes & styles'),
    ];
    $form['slider']['style']['size'] = [
      '#type' => 'select',
      '#title' => $this->t('Slider size'),
      '#options' => [
        'responsive' => 'responsive',
        'custom' => 'custom',
      ],
    ];
    $form['slider']['style']['overflow'] = [
      '#type' => 'select',
      '#title' => $this->t('Overflow'),
      '#options' => [
        'hidden' => 'hidden',
        'visible' => 'visible',
      ],
    ];
    $form['slider']['style']['padding_start'] = [
      '#type' => 'range',
      '#title' => $this->t('Padding start'),
      '#description' => $this->t('Padding top in horizontal direction and padding left in vertical direction'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => 0,
    ];
    $form['slider']['style']['padding_end'] = [
      '#type' => 'range',
      '#title' => $this->t('Padding end'),
      '#description' => $this->t('Padding bottom in horizontal direction and padding right in vertical direction'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => 0,
    ];

    $form['content'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Slides Content & Styles'),
    ];
    $form['content']['images'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Images'),
      '#default_value' => FALSE,
    ];
    $form['content']['images_set'] = [
      '#type' => 'select',
      '#title' => $this->t('Images set'),
      '#options' => [
        'nature' => 'nature',
        'models' => 'models',
        'movies' => 'movies',
        'custom' => 'custom',
      ],
      '#states' => [
        'visible' => [
          'input[name="images"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['content']['title'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Title'),
      '#default_value' => TRUE,
    ];
    $form['content']['text'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Text'),
      '#default_value' => FALSE,
    ];
    $form['content']['position'] = [
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
      '#states' => [
        'visible' => [
          [':input[name="text"]' => ['checked' => TRUE]],
          [':input[name="title"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    // @todo add form item with modal form to custom content.
    $form['content']['style'] = [
      '#type' => 'details',
      '#open' => FALSE,
      '#title' => $this->t('Slides styles'),
    ];
    $form['content']['style']['border_radius'] = [
      '#type' => 'range',
      '#title' => $this->t('Slide border radius'),
      '#min' => 0,
      '#max' => 56,
      '#step' => 2,
      '#default_value' => 0,
    ];
    $form['content']['style']['border_width'] = [
      '#type' => 'range',
      '#title' => $this->t('Slide border width'),
      '#min' => 0,
      '#max' => 16,
      '#step' => 1,
      '#default_value' => 0,
    ];
    $form['content']['style']['border_color'] = [
      '#type' => 'color',
      '#default_value' => '#ff0000',
      '#title' => $this->t('Slide border color'),
    ];
    $form['content']['style']['vertical_start'] = [
      '#type' => 'range',
      '#title' => $this->t('Content vertical padding'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => 48,
    ];
    $form['content']['style']['horizontal_start'] = [
      '#type' => 'range',
      '#title' => $this->t('Content horizontal padding'),
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => 48,
    ];
    $form['content']['style']['background_color'] = [
      '#type' => 'color',
      '#default_value' => '#333333',
      '#title' => $this->t('Background color'),
    ];
    $form['content']['style']['title_color'] = [
      '#type' => 'color',
      '#default_value' => '#ffffff',
      '#title' => $this->t('Title color'),
    ];
    $form['content']['style']['text_color'] = [
      '#type' => 'color',
      '#default_value' => '#ffffff',
      '#title' => $this->t('Text color'),
    ];

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
    ];
    $form['parameters']['per_view'] = [
      '#type' => 'select',
      '#title' => $this->t('Slides per view'),
      '#description' => $this->t("Number of slides per view (slides visible at the same time on slider's container)"),
      '#options' => [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
        'auto' => 'auto',
      ],
    ];
    $form['parameters']['per_group'] = [
      '#type' => 'select',
      '#title' => $this->t('Slides per group'),
      '#description' => $this->t('Set numbers of slides to define and enable group sliding. Useful to use with "Slides per view" > 1'),
      '#options' => [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
        'auto' => 'auto',
      ],
    ];
    $form['parameters']['rows'] = [
      '#type' => 'select',
      '#title' => $this->t('Slides rows'),
      '#description' => $this->t('Number of slides rows, for multirow layout'),
      '#options' => [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
      ],
    ];
    $form['parameters']['centered'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Centered slides'),
      '#description' => $this->t('If enabled, then active slide will be centered, not always on the left side'),
    ];
    $form['parameters']['style']['space'] = [
      '#type' => 'range',
      '#title' => $this->t('Space between slides'),
      '#description' => $this->t('Distance between slides'),
      '#min' => 0,
      '#max' => 100,
      '#step' => 1,
      '#default_value' => 0,
    ];
    $form['parameters']['initial_slide'] = [
      '#type' => 'select',
      '#title' => $this->t('Initial slide'),
      '#description' => $this->t('Index number of initial slide (starts from 0)'),
      '#options' => [
        '0' => '0',
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
      ],
    ];
    $form['parameters']['auto_height'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Auto height'),
      '#description' => $this->t('Enable and slider wrapper will adapt its height to the height of the currently active slide'),
    ];
    $form['parameters']['grab_cursor'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Grab cursor'),
      '#description' => $this->t('This option may a little improve desktop usability. If enabled, user will see the "grab" cursor when hover on Swiper'),
    ];
    $form['parameters']['slide_to_clicked_slide'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Slide to clicked slide'),
      '#description' => $this->t('Enable and click on any slide will produce transition to this slide'),
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
    ];

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
    ];
    $form['effects']['duration'] = [
      '#type' => 'range',
      '#title' => $this->t('Transition duration'),
      '#description' => $this->t('Duration of transition between slides (in ms)'),
      '#min' => 0,
      '#max' => 10000,
      '#step' => 100,
      '#default_value' => 300,
    ];

    $form['modules'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Modules'),
    ];

    $form['modules']['navigation'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Navigation'),
    ];
    $form['modules']['navigation']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Navigation'),
      '#description' => $this->t('Enables navigation arrows/buttons'),
      '#attributes' => [
        'name' => 'navigation_status',
      ],
    ];
    $form['modules']['navigation']['color'] = [
      '#type' => 'color',
      '#default_value' => '#007afa',
      '#title' => $this->t('Color'),
      '#description' => $this->t('Navigation buttons color'),
      '#states' => [
        'visible' => [
          [':input[name="navigation_status"]' => ['checked' => TRUE]],
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
      '#states' => [
        'visible' => [
          [':input[name="navigation_status"]' => ['checked' => TRUE]],
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
      '#states' => [
        'visible' => [
          [':input[name="navigation_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['navigation']['hide_on_click'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide on click'),
      '#description' => $this->t("Toggle navigation buttons visibility after click on Slider's container"),
      '#states' => [
        'visible' => [
          [':input[name="navigation_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];

    $form['modules']['pagination'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Pagination'),
    ];
    $form['modules']['pagination']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Pagination'),
      '#description' => $this->t('Enables pagination'),
      '#attributes' => [
        'name' => 'pagination_status',
      ],
    ];
    $form['modules']['pagination']['color'] = [
      '#type' => 'color',
      '#default_value' => '#007afa',
      '#title' => $this->t('Color'),
      '#description' => $this->t('Pagination color'),
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
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
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
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
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['pagination']['hide_on_click'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide on click'),
      '#description' => $this->t("Toggle (hide/show) pagination container visibility after click on Slider's container"),
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
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
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['pagination']['clickable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Clickable'),
      '#description' => $this->t('If enabled then clicking on pagination button will cause transition to appropriate slide. Only for "bullets" pagination type'),
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['pagination']['dynamic_bullets'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Dynamic bullets'),
      '#description' => $this->t('Good to enable if you use bullets pagination with a lot of slides. So it will keep only few bullets visible at the same time'),
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
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
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="pagination_status"]' => ['checked' => TRUE]],
        ],
        'disabled' => [
          [':input[name="dynamic_bullets"]' => ['checked' => FALSE]],
        ],
      ],
    ];

    $form['modules']['autoplay'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Autoplay'),
    ];
    $form['modules']['autoplay']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Autoplay'),
      '#description' => $this->t('Enables autoplay'),
      '#attributes' => [
        'name' => 'autoplay_status',
      ],
    ];
    $form['modules']['autoplay']['delay'] = [
      '#type' => 'range',
      '#title' => $this->t('Delay'),
      '#description' => $this->t('Delay between transitions (in ms).'),
      '#min' => 0,
      '#max' => 10000,
      '#step' => 100,
      '#default_value' => 3000,
      '#states' => [
        'visible' => [
          [':input[name="autoplay_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['autoplay']['pause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Pause on pointer enter'),
      '#description' => $this->t('When enabled autoplay will be paused on mouse enter over Swiper container. If "Disable on interaction" is also enabled, it will stop autoplay instead of pause'),
      '#states' => [
        'visible' => [
          [':input[name="autoplay_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['autoplay']['disable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable on interaction'),
      '#description' => $this->t('Disabled and autoplay will not be disabled after user interactions (swipes), it will be restarted every time after interaction'),
      '#default_value' => TRUE,
      '#states' => [
        'visible' => [
          [':input[name="autoplay_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['autoplay']['reverse_direction'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Reverse direction'),
      '#description' => $this->t('Enables autoplay in reverse direction'),
      '#states' => [
        'visible' => [
          [':input[name="autoplay_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['autoplay']['stop_on_last_slide'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Stop on last slide'),
      '#description' => $this->t('When enabled autoplay will be stopped when it reaches last slide (has no effect in loop mode)'),
      '#states' => [
        'visible' => [
          [':input[name="autoplay_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];

    $form['modules']['scrollbar'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Scrollbar'),
    ];
    $form['modules']['scrollbar']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Scrollbar'),
      '#description' => $this->t('Enables scrollbar'),
      '#attributes' => [
        'name' => 'scrollbar_status',
      ],
    ];
    $form['modules']['scrollbar']['track_color'] = [
      '#type' => 'color',
      '#default_value' => '#0000001a',
      '#title' => $this->t('Track color'),
      '#description' => $this->t('Scrollbar track color'),
      '#states' => [
        'visible' => [
          [':input[name="scrollbar_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['scrollbar']['thumb_color'] = [
      '#type' => 'color',
      '#default_value' => '#00000080',
      '#title' => $this->t('Thumb color'),
      '#description' => $this->t('Scrollbar thumb color'),
      '#states' => [
        'visible' => [
          [':input[name="scrollbar_status"]' => ['checked' => TRUE]],
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
      '#states' => [
        'visible' => [
          [':input[name="scrollbar_status"]' => ['checked' => TRUE]],
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
      '#states' => [
        'visible' => [
          [':input[name="scrollbar_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['scrollbar']['draggable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Draggable'),
      '#description' => $this->t('Makes scrollbar draggable that allows you to control slider position'),
      '#states' => [
        'visible' => [
          [':input[name="scrollbar_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['scrollbar']['hide_after_interaction'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide after interaction'),
      '#description' => $this->t('Hide scrollbar automatically after user interaction'),
      '#default_value' => TRUE,
      '#states' => [
        'visible' => [
          [':input[name="scrollbar_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['scrollbar']['snap_on_release'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Snap on release'),
      '#description' => $this->t('Snap slider position to slides when you release scrollbar'),
      '#states' => [
        'visible' => [
          [':input[name="scrollbar_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];

    $form['modules']['free_mode'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Free mode'),
    ];
    $form['modules']['free_mode']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Free mode'),
      '#description' => $this->t('Enables free mode'),
      '#attributes' => [
        'name' => 'free_mode_status',
      ],
    ];
    $form['modules']['free_mode']['sticky'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Sticky'),
      '#description' => $this->t('Enables snap to slides positions in free mode'),
      '#states' => [
        'visible' => [
          [':input[name="free_mode_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['free_mode']['momentum'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Momentum'),
      '#description' => $this->t('If enabled, then slide will keep moving for a while after you release it'),
      '#states' => [
        'visible' => [
          [':input[name="free_mode_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['free_mode']['momentum_bounce'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Momentum bounce'),
      '#description' => $this->t('Enables momentum bounce in free mode'),
      '#default_value' => TRUE,
      '#states' => [
        'visible' => [
          [':input[name="free_mode_status"]' => ['checked' => TRUE]],
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
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="free_mode_status"]' => ['checked' => TRUE]],
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
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="free_mode_status"]' => ['checked' => TRUE]],
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
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="free_mode_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];

    $form['modules']['keyboard_control'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Keyboard control'),
    ];
    $form['modules']['keyboard_control']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Keyboard control'),
      '#description' => $this->t('Enables keyboard control'),
      '#attributes' => [
        'name' => 'keyboard_control_status',
      ],
    ];
    $form['modules']['keyboard_control']['only_in_viewport'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Only in viewport'),
      '#description' => $this->t('When enabled it will control sliders that are currently in viewport'),
      '#default_value' => TRUE,
      '#states' => [
        'visible' => [
          [':input[name="keyboard_control_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['keyboard_control']['keys'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Page UP/Down keys'),
      '#description' => $this->t('When enabled it will enable keyboard navigation by Page Up and Page Down keys'),
      '#default_value' => TRUE,
      '#states' => [
        'visible' => [
          [':input[name="keyboard_control_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];

    $form['modules']['mousewheel_control'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Mousewheel control'),
    ];
    $form['modules']['mousewheel_control']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Mousewheel control'),
      '#description' => $this->t('Enables mousewheel control'),
      '#attributes' => [
        'name' => 'mousewheel_control_status',
      ],
    ];
    $form['modules']['mousewheel_control']['force_to_axis'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Force to axis'),
      '#description' => $this->t('Enable to force mousewheel swipes to axis. So in horizontal mode mousewheel will work only with horizontal mousewheel scrolling, and only with vertical scrolling in vertical mode.'),
      '#states' => [
        'visible' => [
          [':input[name="mousewheel_control_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['mousewheel_control']['invert_scrolling'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Invert scrolling'),
      '#description' => $this->t('Enable to invert sliding direction'),
      '#states' => [
        'visible' => [
          [':input[name="mousewheel_control_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['mousewheel_control']['release_on_edges'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Release on edges'),
      '#description' => $this->t('Enable and swiper will release mousewheel event and allow page scrolling when swiper is on edge positions (in the beginning or in the end)'),
      '#states' => [
        'visible' => [
          [':input[name="mousewheel_control_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['mousewheel_control']['sensitivity'] = [
      '#type' => 'range',
      '#title' => $this->t('Sensitivity'),
      '#description' => $this->t('Multiplier of mousewheel data, allows to tweak mouse wheel sensitivity'),
      '#min' => 0.1,
      '#max' => 2,
      '#step' => 0.1,
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="mousewheel_control_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];

    $form['modules']['parallax'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Parallax'),
    ];
    $form['modules']['parallax']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Parallax'),
      '#description' => $this->t('Enables parallax transition effects'),
      '#attributes' => [
        'name' => 'parallax_status',
      ],
    ];
    $form['modules']['parallax']['effect_multiplier'] = [
      '#type' => 'range',
      '#title' => $this->t('Effect multiplier'),
      '#min' => 0.1,
      '#max' => 5,
      '#step' => 0.1,
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="parallax_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];

    $form['modules']['lazy_loading'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Lazy loading'),
    ];
    $form['modules']['lazy_loading']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Lazy loading'),
      '#description' => $this->t('Enables images lazy loading. It will also enable slides images'),
      '#attributes' => [
        'name' => 'lazy_loading_status',
      ],
    ];
    $form['modules']['lazy_loading']['check_in_view'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Check in view'),
      '#description' => $this->t('Enables to check is the Swiper in view before lazy loading images on initial slides'),
      '#states' => [
        'visible' => [
          [':input[name="lazy_loading_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['lazy_loading']['load_on_transition_start'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load on transition start'),
      '#description' => $this->t('By default, Swiper will load lazy images after transition to this slide, so you may enable this parameter if you need it to start loading of new image in the beginning of transition'),
      '#states' => [
        'visible' => [
          [':input[name="lazy_loading_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['lazy_loading']['load_in_prev_next_slides'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load in prev next slides'),
      '#description' => $this->t('Enables lazy loading for the closest slides images (for previous and next slide images)'),
      '#states' => [
        'visible' => [
          [':input[name="lazy_loading_status"]' => ['checked' => TRUE]],
        ],
      ],
    ];
    $form['modules']['lazy_loading']['load_in_prev_next_amount'] = [
      '#type' => 'range',
      '#title' => $this->t('Load in prev next amount'),
      '#description' => $this->t('Amount of next/prev slides to preload lazy images in'),
      '#min' => 1,
      '#max' => 10,
      '#step' => 1,
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="lazy_loading_status"]' => ['checked' => TRUE]],
        ],
        'disabled' => [
          [':input[name="load_in_prev_next_slides"]' => ['checked' => FALSE]],
        ],
      ],
    ];

    $form['modules']['accessibility'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Accessibility'),
    ];
    $form['modules']['accessibility']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Accessibility'),
      '#description' => $this->t('Enables accessibility features and attributes for screen readers'),
      '#default_value' => TRUE,
      '#attributes' => [
        'name' => 'accessibility_status',
      ],
    ];

    $form['modules']['zoom'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Zoom'),
    ];
    $form['modules']['zoom']['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Zoom'),
      '#description' => $this->t('Enables images zoom on double tap/click and pinch to zoom'),
      '#attributes' => [
        'name' => 'zoom_status',
      ],
    ];
    $form['modules']['zoom']['minimal_ratio'] = [
      '#type' => 'range',
      '#title' => $this->t('Minimal ratio'),
      '#description' => $this->t('Minimal image zoom multiplier'),
      '#min' => 1,
      '#max' => 10,
      '#step' => 1,
      '#default_value' => 1,
      '#states' => [
        'visible' => [
          [':input[name="zoom_status"]' => ['checked' => TRUE]],
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
      '#default_value' => 3,
      '#states' => [
        'visible' => [
          [':input[name="zoom_status"]' => ['checked' => TRUE]],
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
