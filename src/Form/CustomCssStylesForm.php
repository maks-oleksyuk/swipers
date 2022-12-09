<?php

namespace Drupal\swipers\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TempStore\PrivateTempStoreFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form to configure custom css styles.
 */
class CustomCssStylesForm extends FormBase {

  /**
   * The temp store factory.
   */
  protected PrivateTempStoreFactory $tempStoreFactory;

  /**
   * Constructs a new form to custom css.
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
  public static function create(ContainerInterface $container): CustomCssStylesForm|static {
    return new static(
      $container->get('tempstore.private'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'custom_css_styles';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $css = $this->tempStoreFactory->get('swipers')->get('css');
    $form['css'] = [
      '#type' => 'textarea',
      '#resizable' => 'none',
      '#rows' => 18,
      '#default_value' => $css ?? NULL,
    ];
    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Save'),
        '#button_type' => 'primary',
        '#ajax' => [
          'event' => 'click',
          'callback' => [$this, 'ajaxSubmitCallback'],
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
  public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state): AjaxResponse {
    return (new AjaxResponse())->addCommand(new CloseModalDialogCommand());
  }

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Core\TempStore\TempStoreException
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $css = $form_state->getValue('css');
    $this->tempStoreFactory->get('swipers')->set('css', $css);
  }

}
