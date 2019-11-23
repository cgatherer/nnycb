<?php

/**
 * @file
 * Contains Drupal\nnycb_helpers\Form\BridgeStatusForm.
 */
namespace Drupal\nnycb_helpers\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class BridgeStatusForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nnycb_helpers.status',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bridge_status_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('nnycb_helpers.status');

    $form['path_is_closed'] = [
      '#type' => 'checkbox',
      '#default_value' => $config->get('path_is_closed'),
      '#title' => $this->t('Bridge path is closed'),
      '#return_value' => 1,
      '#description' => $this->t('When checked, the website will display 
      "Bridge path is CLOSED and not calculate based on time of day.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('nnycb_helpers.status')
      ->set('path_is_closed', $form_state->getValue('path_is_closed'))
      ->save();
  }

}