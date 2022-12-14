<?php

namespace Drupal\swipers_ui\Form;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\swipers\Form\SwiperSliderForm;

/**
 * Swiper Studio form class.
 *
 * @property \Drupal\swipers\SwiperSliderInterface $entity
 */
class SwiperStudioForm extends SwiperSliderForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state): array {
    $form = parent::form($form, $form_state);
    // Main config settings.
    $form['main']['label']['#theme_wrappers'][]       = 'swiper_studio_form_element';
    $form['main']['id']['#theme_wrappers'][]          = 'swiper_studio_form_element';
    $form['main']['status']['#type']                  = 'swiper_studio_switch';
    $form['main']['description']['#theme_wrappers'][] = 'swiper_studio_form_element';
    // Slider.
    $form['slider']['direction']['#icon']             = 'language-direction.svg';
    $form['slider']['direction']['#title_display']    = 'inline';
    $form['slider']['direction']['#theme_wrappers'][] = 'swiper_studio_form_element';
    // Slider sizes & styles.
    $form['slider']['style']['#icon']                         = 'slider-size.svg';
    $form['slider']['style']['#theme_wrappers'][]             = 'swiper_studio_details';
    $form['slider']['style']['size']['#icon']                 = 'slider-size.svg';
    $form['slider']['style']['size']['#title_display']        = 'inline';
    $form['slider']['style']['size']['#theme_wrappers'][]     = 'swiper_studio_form_element';
    $form['slider']['style']['w_type']['#icon']               = 'width.svg';
    $form['slider']['style']['w_type']['#title_display']      = 'inline';
    $form['slider']['style']['w_type']['#theme_wrappers'][]   = 'swiper_studio_form_element';
    $form['slider']['style']['w_value']['#theme_wrappers'][]  = 'swiper_studio_form_element';
    $form['slider']['style']['h_type']['#icon']               = 'height.svg';
    $form['slider']['style']['h_type']['#title_display']      = 'inline';
    $form['slider']['style']['h_type']['#theme_wrappers'][]   = 'swiper_studio_form_element';
    $form['slider']['style']['h_value']['#theme_wrappers'][]  = 'swiper_studio_form_element';
    $form['slider']['style']['overflow']['#icon']             = 'overflow.svg';
    $form['slider']['style']['overflow']['#title_display']    = 'inline';
    $form['slider']['style']['overflow']['#theme_wrappers'][] = 'swiper_studio_form_element';
    $form['slider']['style']['ps']['#icon']                   = 'p-start.svg';
    $form['slider']['style']['ps']['#theme_wrappers'][]       = 'swiper_studio_form_element';
    $form['slider']['style']['pe']['#icon']                   = 'p-end.svg';
    $form['slider']['style']['pe']['#theme_wrappers'][]       = 'swiper_studio_form_element';
    // Slides Content & Styles.
    // Slides Content.
    $form['slides']['content']['#icon']                           = 'slider-content.svg';
    $form['slides']['content']['#theme_wrappers'][]               = 'swiper_studio_details';
    $form['slides']['content']['images']['#icon']                 = 'images.svg';
    $form['slides']['content']['images']['#type']                 = 'swiper_studio_switch';
    $form['slides']['content']['images_set']['#icon']             = 'slider-content.svg';
    $form['slides']['content']['images_set']['#title_display']    = 'inline';
    $form['slides']['content']['images_set']['#theme_wrappers'][] = 'swiper_studio_form_element';
    $form['slides']['content']['title']['#icon']                  = 'title.svg';
    $form['slides']['content']['title']['#type']                  = 'swiper_studio_switch';
    $form['slides']['content']['text']['#icon']                   = 'text.svg';
    $form['slides']['content']['text']['#type']                   = 'swiper_studio_switch';
    $form['slides']['content']['position']['#icon']               = 'content-position.svg';
    $form['slides']['content']['position']['#title_display']      = 'inline';
    $form['slides']['content']['position']['#theme_wrappers'][]   = 'swiper_studio_form_element';
    $form['slides']['content']['custom']['#icon']                 = 'custom-content.svg';
    $form['slides']['content']['custom']['#theme_wrappers'][]     = 'swiper_studio_form_element__link';
    // Slides Styles.
    $form['slides']['style']['#icon']                            = 'slides-styles.svg';
    $form['slides']['style']['#theme_wrappers'][]                = 'swiper_studio_details';
    $form['slides']['style']['br_radius']['#icon']               = 'br-radius.svg';
    $form['slides']['style']['br_radius']['#theme_wrappers'][]   = 'swiper_studio_form_element';
    $form['slides']['style']['br_width']['#icon']                = 'br-width.svg';
    $form['slides']['style']['br_width']['#theme_wrappers'][]    = 'swiper_studio_form_element';
    $form['slides']['style']['br_color']['#icon']                = 'br-color.svg';
    $form['slides']['style']['br_color']['#title_display']       = 'inline';
    $form['slides']['style']['br_color']['#theme_wrappers'][]    = 'swiper_studio_form_element';
    $form['slides']['style']['cvp']['#icon']                     = 'cvp.svg';
    $form['slides']['style']['cvp']['#theme_wrappers'][]         = 'swiper_studio_form_element';
    $form['slides']['style']['chp']['#icon']                     = 'chp.svg';
    $form['slides']['style']['chp']['#theme_wrappers'][]         = 'swiper_studio_form_element';
    $form['slides']['style']['bg_color']['#icon']                = 'bg-color.svg';
    $form['slides']['style']['bg_color']['#title_display']       = 'inline';
    $form['slides']['style']['bg_color']['#theme_wrappers'][]    = 'swiper_studio_form_element';
    $form['slides']['style']['title_color']['#icon']             = 'title.svg';
    $form['slides']['style']['title_color']['#title_display']    = 'inline';
    $form['slides']['style']['title_color']['#theme_wrappers'][] = 'swiper_studio_form_element';
    $form['slides']['style']['text_color']['#icon']              = 'text.svg';
    $form['slides']['style']['text_color']['#title_display']     = 'inline';
    $form['slides']['style']['text_color']['#theme_wrappers'][]  = 'swiper_studio_form_element';
    // Parameters.
    $form['parameters']['direction']['#icon']                 = 'slide-direction.svg';
    $form['parameters']['direction']['#title_display']        = 'inline';
    $form['parameters']['direction']['#theme_wrappers'][]     = 'swiper_studio_form_element';
    $form['parameters']['per_view']['#icon']                  = 'per-view.svg';
    $form['parameters']['per_view']['#title_display']         = 'inline';
    $form['parameters']['per_view']['#theme_wrappers'][]      = 'swiper_studio_form_element';
    $form['parameters']['size_type']['#icon']                 = 'slider-size.svg';
    $form['parameters']['size_type']['#title_display']        = 'inline';
    $form['parameters']['size_type']['#theme_wrappers'][]     = 'swiper_studio_form_element';
    $form['parameters']['size_value']['#theme_wrappers'][]    = 'swiper_studio_form_element';
    $form['parameters']['per_group']['#icon']                 = 'per-group.svg';
    $form['parameters']['per_group']['#title_display']        = 'inline';
    $form['parameters']['per_group']['#theme_wrappers'][]     = 'swiper_studio_form_element';
    $form['parameters']['rows']['#icon']                      = 'rows.svg';
    $form['parameters']['rows']['#title_display']             = 'inline';
    $form['parameters']['rows']['#theme_wrappers'][]          = 'swiper_studio_form_element';
    $form['parameters']['centered']['#icon']                  = 'centered.svg';
    $form['parameters']['centered']['#type']                  = 'swiper_studio_switch';
    $form['parameters']['space']['#icon']                     = 'space.svg';
    $form['parameters']['space']['#theme_wrappers'][]         = 'swiper_studio_form_element';
    $form['parameters']['initial_slide']['#icon']             = 'initial-slide.svg';
    $form['parameters']['initial_slide']['#title_display']    = 'inline';
    $form['parameters']['initial_slide']['#theme_wrappers'][] = 'swiper_studio_form_element';
    $form['parameters']['auto_height']['#icon']               = 'height.svg';
    $form['parameters']['auto_height']['#type']               = 'swiper_studio_switch';
    $form['parameters']['grab_cursor']['#icon']               = 'grab-cursor.svg';
    $form['parameters']['grab_cursor']['#type']               = 'swiper_studio_switch';
    $form['parameters']['slide_to_clicked_slide']['#icon']    = 'slide-to-clicked-slide.svg';
    $form['parameters']['slide_to_clicked_slide']['#type']    = 'swiper_studio_switch';
    $form['parameters']['loop_mode']['#icon']                 = 'loop-mode.svg';
    $form['parameters']['loop_mode']['#title_display']        = 'inline';
    $form['parameters']['loop_mode']['#theme_wrappers'][]     = 'swiper_studio_form_element';
    // Effects.
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
    $form['modules']['navigation']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Navigation'),
      '#description' => $this->t('Enables navigation arrows/buttons'),
      '#default_value' => $modules['navigation']['enabled'] ?? FALSE,
    ];
    $form['modules']['navigation']['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#description' => $this->t('Navigation buttons color'),
      '#default_value' => $modules['navigation']['color'] ?? '#007afa',
      '#states' => [
        'visible' => [
          ':input[name="modules[navigation][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[navigation][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[navigation][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[navigation][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Pagination.
    $form['modules']['pagination'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['pagination']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Pagination'),
      '#description' => $this->t('Enables pagination'),
      '#default_value' => $modules['pagination']['enabled'] ?? FALSE,
    ];
    $form['modules']['pagination']['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#description' => $this->t('Pagination color'),
      '#default_value' => $modules['pagination']['color'] ?? '#007afa',
      '#states' => [
        'visible' => [
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[pagination][enabled]"]' => ['checked' => TRUE],
          'select[name="modules[pagination][type]"]' => ['value' => 'progressbar'],
        ],
      ],
    ];
    // Autoplay.
    $form['modules']['autoplay'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['autoplay']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Autoplay'),
      '#description' => $this->t('Enables autoplay'),
      '#default_value' => $modules['autoplay']['enabled'] ?? FALSE,
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
          ':input[name="modules[autoplay][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[autoplay][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[autoplay][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[autoplay][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[autoplay][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Scrollbar.
    $form['modules']['scrollbar'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['scrollbar']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Scrollbar'),
      '#description' => $this->t('Enables scrollbar'),
      '#default_value' => $modules['scrollbar']['enabled'] ?? FALSE,
    ];
    $form['modules']['scrollbar']['track_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Track color'),
      '#description' => $this->t('Scrollbar track color'),
      '#default_value' => $modules['scrollbar']['track_color'] ?? '#000000',
      '#states' => [
        'visible' => [
          ':input[name="modules[scrollbar][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[scrollbar][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[scrollbar][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[scrollbar][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[scrollbar][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[scrollbar][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[scrollbar][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Free mode.
    $form['modules']['free_mode'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['free_mode']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Free mode'),
      '#description' => $this->t('Enables free mode'),
      '#default_value' => $modules['free_mode']['enabled'] ?? FALSE,
    ];
    $form['modules']['free_mode']['sticky'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Sticky'),
      '#description' => $this->t('Enables snap to slides positions in free mode'),
      '#default_value' => $modules['free_mode']['sticky'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[free_mode][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[free_mode][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[free_mode][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[free_mode][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[free_mode][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[free_mode][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Keyboard control.
    $form['modules']['keyboard'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['keyboard']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Keyboard control'),
      '#description' => $this->t('Enables keyboard control'),
      '#default_value' => $modules['keyboard']['enabled'] ?? FALSE,
    ];
    $form['modules']['keyboard']['only_in_viewport'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Only in viewport'),
      '#description' => $this->t('When enabled it will control sliders that are currently in viewport'),
      '#default_value' => $modules['keyboard']['only_in_viewport'] ?? TRUE,
      '#states' => [
        'visible' => [
          ':input[name="modules[keyboard][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[keyboard][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Mousewheel control.
    $form['modules']['mousewheel'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['mousewheel']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Mousewheel control'),
      '#description' => $this->t('Enables mousewheel control'),
      '#default_value' => $modules['mousewheel']['enabled'] ?? FALSE,
    ];
    $form['modules']['mousewheel']['force_to_axis'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Force to axis'),
      '#description' => $this->t('Enable to force mousewheel swipes to axis. So in horizontal mode mousewheel will work only with horizontal mousewheel scrolling, and only with vertical scrolling in vertical mode.'),
      '#default_value' => $modules['mousewheel']['force_to_axis'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[mousewheel][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[mousewheel][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[mousewheel][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[mousewheel][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Parallax.
    $form['modules']['parallax'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['parallax']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Parallax'),
      '#description' => $this->t('Enables parallax transition effects'),
      '#default_value' => $modules['parallax']['enabled'] ?? FALSE,
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
          ':input[name="modules[parallax][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Lazy loading.
    $form['modules']['lazy'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['lazy']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Lazy loading'),
      '#description' => $this->t('Enables images lazy loading. It will also enable slides images'),
      '#default_value' => $modules['lazy']['enabled'] ?? FALSE,
    ];
    $form['modules']['lazy']['check_in_view'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Check in view'),
      '#description' => $this->t('Enables to check is the Swiper in view before lazy loading images on initial slides'),
      '#default_value' => $modules['lazy']['check_in_view'] ?? FALSE,
      '#states' => [
        'visible' => [
          ':input[name="modules[lazy][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[lazy][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[lazy][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[lazy][enabled]"]' => ['checked' => TRUE],
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
    $form['modules']['accessibility']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Accessibility'),
      '#description' => $this->t('Enables accessibility features and attributes for screen readers'),
      '#default_value' => $modules['accessibility']['enabled'] ?? TRUE,
    ];
    // Zoom.
    $form['modules']['zoom'] = [
      '#type' => 'fieldset',
    ];
    $form['modules']['zoom']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Zoom'),
      '#description' => $this->t('Enables images zoom on double tap/click and pinch to zoom'),
      '#default_value' => $modules['zoom']['enabled'] ?? FALSE,
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
          ':input[name="modules[zoom][enabled]"]' => ['checked' => TRUE],
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
          ':input[name="modules[zoom][enabled]"]' => ['checked' => TRUE],
        ],
      ],
    ];
    // Pro parameters.
    $pro = $this->entity->get('pro');
    $form['pro'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Pro parameters'),
    ];
    // Clear temp storage when created new item, or set exist value on edit.
    if ($this->entity->isNew()) {
      $css = $pro['css'] ?? ($this->tempStoreFactory->get('swipers')
        ->get('css') ?? NULL);
      $this->tempStoreFactory->get('swipers')->set('css', $css);
    }
    else {
      $this->tempStoreFactory->get('swipers')->delete('css');
    }
    $form['pro']['css'] = [
      '#type' => 'link',
      '#title' => $this->t('Custom CSS styles'),
      '#url' => Url::fromRoute('entity.slider.custom_css_styles_form'),
      '#attributes' => [
        'class' => ['use-ajax', 'button', 'button--small'],
        'data-dialog-type' => 'modal',
        'data-dialog-options' => Json::encode([
          'width' => 'auto',
        ]),
      ],
    ];
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
    $form['pro']['observer'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Observer'),
      '#description' => $this->t('Enables Mutation Observer on Swiper and its elements. In this case Swiper will be updated (reinitialized) each time if you change its style (like hide/show) or modify its child elements (like adding/removing slides)'),
      '#default_value' => $pro['observer'] ?? FALSE,
    ];
    $form['pro']['observer_parents'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Observe parents'),
      '#description' => $this->t('Enable if you also need to wa tch Mutations for Swiper parent elements'),
      '#default_value' => $pro['observer_parents'] ?? FALSE,
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

}
