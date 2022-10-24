<?php

namespace Drupal\swipers;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Config\Entity\ConfigEntityListBuilder;

/**
 * Provides a listing of Swiper Slider option sets.
 */
class SwiperSliderListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    return [
      'label' => [
        'data' => $this->t('Label'),
        'class' => ['views-align-center'],
      ],
      'id' => [
        'data' => $this->t('Machine name'),
        'class' => ['views-align-center', RESPONSIVE_PRIORITY_LOW],
      ],
      'description' => [
        'data' => $this->t('Description'),
        'class' => ['views-align-left', RESPONSIVE_PRIORITY_LOW],
      ],
      'status' => [
        'data' => $this->t('Status'),
        'class' => ['views-align-center', RESPONSIVE_PRIORITY_MEDIUM],
      ],
      'operations' => [
        'data' => $this->t('Operations'),
        'class' => ['views-align-center'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\swipers\SwiperSliderInterface $entity */
    return [
      'label' => [
        'data' => $entity->label(),
        'class' => ['views-align-center'],
      ],
      'id' => [
        'data' => $entity->id(),
        'class' => ['views-align-center'],
      ],
      'description' => $entity->get('description'),
      'status' => [
        'data' => $entity->status() ? $this->t('✅ Enabled') : $this->t('❌ Disabled'),
        'class' => ['views-align-center'],
      ],
      'operations' => [
        'data' => $this->buildOperations($entity),
        'class' => ['views-align-center'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $build = parent::render();
    $build['table']['#attached']['library'][] = 'views/views.module';
    return $build;
  }

}
