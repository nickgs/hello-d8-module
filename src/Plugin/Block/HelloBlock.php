<?php

/**
 * @file
 * Contains \Drupal\hello\Plugin\Block\HelloBlock
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 * )
 */
class HelloBlock extends BlockBase {
  public function defaultConfiguration() {
    return ['count' => 1];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['hello_count'] = array(
      '#type' => 'number',
      '#title' => t('Hello Count'),
      '#size' => 10,
      '#description' => t('The number of times the block say hi.'),
      '#default_value' => $this->configuration['count'],
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['hello_count']
      = $form_state->getValue('hello_count');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $count = $this->configuration['hello_count'];
    return array(
      '#markup' => $this->t("Hello {$count} times!"),
    );
  }
}

