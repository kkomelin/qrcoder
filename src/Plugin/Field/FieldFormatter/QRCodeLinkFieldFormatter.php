<?php

namespace Drupal\qrcoder\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'qrcode_link_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "qrcode_link_field_formatter",
 *   label = @Translation("QR Code"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class QRCodeLinkFieldFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      // Implement default settings.
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return array(
      // Implement settings form.
    ) + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      // Get a URL from the field and make it absolute.
      $url = $item->getUrl()->setAbsolute(TRUE)->toString();
      // Just in case, sanitize entered URL.
      $url =  UrlHelper::filterBadProtocol($url);
      // Use image theme function to render a QR code image for the URL.
      $elements[$delta] = [
        '#theme' => 'image',
        '#uri' => 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . $url,
      ];
    }

    return $elements;
  }

}
