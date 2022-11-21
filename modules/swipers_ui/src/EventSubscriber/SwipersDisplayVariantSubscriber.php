<?php

namespace Drupal\swipers_ui\EventSubscriber;

use Drupal\Core\Render\PageDisplayVariantSelectionEvent;
use Drupal\Core\Render\RenderEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Selects the custom page display variant.
 */
class SwipersDisplayVariantSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    $events[RenderEvents::SELECT_PAGE_DISPLAY_VARIANT][] = ['onSelectPageDisplayVariant'];
    return $events;
  }

  /**
   * Selects the swiper studio display variant.
   *
   * @param \Drupal\Core\Render\PageDisplayVariantSelectionEvent $event
   *   The event to process.
   */
  public function onSelectPageDisplayVariant(PageDisplayVariantSelectionEvent $event) {
    $route_match = $event->getRouteMatch();

    // Only applicable for form config pages.
    if (!in_array($route_match->getRouteName(), [
      'entity.slider.edit_form',
      'entity.slider.add_form',
    ])) {
      return;
    }

    $event->setPluginId('swiper_studio_markup');
  }

}
