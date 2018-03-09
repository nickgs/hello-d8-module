<?php

/**
 * @file
 * Contains \Drupal\hello\Form\HelloConfigForm.
 */

namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloConfigForm extends ConfigFormBase {
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'hello_config';
  }

  /**
   * Declare what settings this config form will be changing.
   */
  protected function getEditableConfigNames() {
    return ['hello.settings'];
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('hello.settings');

    $form['default_count'] = array(
      '#type' => 'number',
      '#title' => $this->t('How many times do we say hi?'),
      '#default_value' => $config->get('default_count'),
    );

    $form['phrase'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('How do you want to say hi?'),
      '#default_value' => $config->get('phrase'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      parent::submitForm($form, $form_state);

      //lets load and set our configuration.
      $config = $this->config('hello.settings');
      $config->set('default_count', $form_state->getValue('default_count'));
      $config->set('phrase', $form_state->getValue('phrase'));
      //save the config.
      $config->save();
  }
}