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
      '#min' => 0,
      '#max' => 120,
      '#step' => 4,
      '#default_value' => 0,
    ];
    $form['slider']['style']['padding_end'] = [
      '#type' => 'range',
      '#title' => $this->t('Padding end'),
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
    ];
    $form['parameters']['style']['space'] = [
      '#type' => 'range',
      '#title' => $this->t('Space between slides'),
      '#min' => 0,
      '#max' => 100,
      '#step' => 1,
      '#default_value' => 0,
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
