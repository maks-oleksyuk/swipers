<?php

namespace Drupal\swipers\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\swipers\SwiperSliderInterface;

/**
 * Defines the Swiper Slider configuration entity.
 *
 * @ConfigEntityType(
 *   id = "slider",
 *   label = @Translation("Swiper Slider"),
 *   label_collection = @Translation("slider"),
 *   handlers = {
 *     "list_builder" = "Drupal\swipers\SwiperSliderListBuilder",
 *     "form" = {
 *       "add" = "Drupal\swipers\Form\SwiperSliderForm",
 *       "edit" = "Drupal\swipers\Form\SwiperSliderForm",
 *       "delete" = "Drupal\swipers\Form\SwiperSliderDeleteForm"
 *     }
 *   },
 *   config_prefix = "slider",
 *   admin_permission = "administer swiper-slider",
 *   links = {
 *     "collection" = "/admin/config/media/swiper-studio",
 *     "add-form" = "/admin/config/media/swiper-studio/add",
 *     "edit-form" = "/admin/config/media/swiper-studio/{slider}",
 *     "delete-form" = "/admin/config/media/swiper-studio/{slider}/delete",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "slider",
 *     "content"
 *   }
 * )
 */
class SwiperSlider extends ConfigEntityBase implements SwiperSliderInterface {

  /**
   * The slider ID.
   *
   * @var string
   */
  protected string $id;

  /**
   * The slider label.
   *
   * @var string
   */
  protected $label;

  /**
   * The slider status.
   *
   * @var bool
   */
  protected $status;

  /**
   * The slider description.
   *
   * @var string
   */
  protected $description;

  /**
   * The slider settings.
   *
   * @var array
   */
  protected $slider = [];

  /**
   * The content settings.
   *
   * @var array
   */
  protected $content = [];

}
