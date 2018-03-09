<?php

/**
 * @file
 * Contains \Drupal\hello\Form\HelloRequestForm.
 */

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloRequestForm extends FormBase {
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'hello_request';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['phone_number'] = array(
      '#type' => 'tel',
      '#title' => $this->t('Your phone number')
    );
    
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Give me a call'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    //$phone = $form_state->getValue(array('parent','child','grandchild'))
    
    if (strlen($form_state->getValue('phone_number')) < 3) {
      $form_state->setErrorByName('phone_number', $this->t('The phone number is too short. Please enter a full phone number.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('Your phone number is @number', array('@number' => $form_state->getValue('phone_number'))));
  }
}