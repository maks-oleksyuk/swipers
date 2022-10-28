<?php

namespace Drupal\swipers\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form to configure custom content on demo swipers.
 */
class CustomContentForm extends FormBase {

  /**
   * The temp store factory.
   *
   * @var \Drupal\Core\TempStore\PrivateTempStoreFactory
   */
  protected $tempStoreFactory;

  /**
   * Constructs a new form to custom content slider.
   *
   * @param \Drupal\Core\TempStore\PrivateTempStoreFactory $temp_store_factory
   *   The temp store factory.
   */
  public function __construct(PrivateTempStoreFactory $temp_store_factory) {
    $this->tempStoreFactory = $temp_store_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('tempstore.private'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_swipers_content';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $texts = [
      'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores nemo saepe vero aliquid assumenda! Ipsa maxime sit reiciendis velit odit aliquam,',
      'Repellat porro animi ad autem mollitia dolorum unde facere zlaboriosam nostrum, non fuga sapiente incidunt explicabo voluptates voluptas, dolor quisquam corrupti ea ab.',
      'Consequatur, amet quibusdam vitae alias, autem asperiores magnam doloribus qui molestiae vel voluptate sit ex, assumenda aperiam esse saepe distinctio doloremque repellendus veniam maiores!',
      'Ipsum accusamus officiis nesciunt adipisci nam? Vero sapiente ab et esse veniam laudantium reiciendis accusantium, odio similique fuga praesentium dignissimos facilis.',
      'Aliquam, quae hic ducimus a sed et repellat ullam reprehenderit fuga quo vitae excepturi quos quis, non odit magnam laborum consequatur maiores at!',
      'Quis veniam ab reiciendis magni error. Fugit excepturi velit veniam ea, fugiat voluptas minus incidunt minima consequatur nam sit neque molestias error.',
      'Ea consectetur iste quae repudiandae quas unde ducimus provident earum quasi blanditiis placeat tempore animi possimus, inventore laudantium?',
      'Minima, qui. Harum, magnam non. Cupiditate quaerat pariatur voluptatibus veniam! Debitis velit, quos corrupti accusantium in ea odit.',
      'Distinctio sit veritatis accusantium magni unde culpa consequuntur placeat a? Distinctio ad alias qui dicta aliquid deleniti illum voluptatem aperiam.',
      'Quia quos suscipit error, soluta alias minus hic accusamus repellat, sint rem dolore numquam ab a minima? Adipisci odit perspiciatis ea doloribus.',
    ];
    $custom_values = $this->tempStoreFactory->get('swipers')->get('custom');
    $form['#tree'] = TRUE;
    for ($i = 1; $i <= 10; $i++) {
      $form['custom']["slide_$i"] = [
        '#type' => 'fieldset',
        '#title' => $this->t('Slide @i', ['@i' => $i]),
      ];
      $form['custom']["slide_$i"]['image_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Image URL'),
        '#description' => $this->t('Will be used in case of "custom" images set'),
        '#default_value' => $custom_values["slide_$i"]['image_url'] ?? NULL,
      ];
      $form['custom']["slide_$i"]['title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#default_value' => $custom_values["slide_$i"]['title'] ?? $this->t('Slide @i', ['@i' => $i]),
      ];
      $form['custom']["slide_$i"]['text'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Text'),
        '#default_value' => $custom_values["slide_$i"]['text'] ?? $texts[$i - 1],
        '#resizable' => 'none',
        '#rows' => 3,
      ];
    }
    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Save'),
        '#button_type' => 'primary',
        '#ajax' => [
          'event' => 'click',
          'callback' => '::ajaxSubmitCallback',
        ],
      ],
    ];
    return $form;
  }

  /**
   * Ajax Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   An AJAX response that display validation error messages or represents a
   *   successful submission.
   */
  public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $response->addCommand(new CloseModalDialogCommand());
    return $response;
  }

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Core\TempStore\TempStoreException
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $custom_values = $form_state->getValue('custom');
    $this->tempStoreFactory->get('swipers')->set('custom', $custom_values);
  }

}
