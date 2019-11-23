<?php

namespace Drupal\lighting_display\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\lighting_display\Entity\LightingDisplay;

/**
 * Class LightingDisplayRequestForm.
 */
class LightingDisplayRequestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'lighting_display_request_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {


    $form['#attached']['library'][] = 'lighting_display/display_request';

    $config = \Drupal::config('lighting_display.color_palettes');
    $palettes = $config->get('palettes');
    $form['#attached']['drupalSettings']['color_palettes'] = [$palettes];
    $standard = $palettes['standard'];

    $options = [];
    foreach ($standard as $color) {
      $options[$color['name'] . '|' . $color['hex']] = $color['name'];
    }

    $form['selected_slot'] = [
      '#type' => 'hidden',
      '#title' => $this->t('Slot ID'),
      '#attributes' => [
        'id' => ['slot-id'],
      ],
    ];
    $form['step_1'] = [
      '#type' => 'container',
      '#weight' => '-20',
      '#open' => TRUE,
    ];
    $form['step_1']['summary'] = [
      '#type' => 'item',
      '#markup' => '<h4>Step 1: Select Desired Date</h4>',
      '#weight' => '-10',
    ];
    $form['step_1']['requested_date'] = [
      '#type' => 'textfield',
      '#placeholder' => $this->t('MM/DD/YYYY'),
      '#title' => $this->t('Requested Date'),
      '#description' => $this->t('Note: all dates available. Some colors not available during periods of bird migration.'),
      '#weight' => '0',
      '#required' => TRUE,
    ];

    $form['step_2'] = [
      '#type' => 'container',
      '#weight' => '-10',
      '#open' => TRUE,
    ];

    $form['step_2']['summary'] = [
      '#type' => 'item',
      '#markup' => '<h4>Step 2: Select Colors</h4>',
      '#weight' => '-10',
    ];

    $form['step_2']['towers_color'] = [
      '#type' => 'select',
      '#title' => $this->t('Tower Color:'),
      '#options' => $options,
      '#empty_option' => $this->t('Select Color'),
      '#weight' => '-5',
      '#required' => TRUE,
    ];
    $form['step_2']['pier1_color'] = [
      '#type' => 'select',
      '#title' => $this->t('Pier Color 1:'),
      '#options' => $options,
      '#empty_option' => $this->t('Select Color'),
      '#weight' => '0',
      '#required' => TRUE,
    ];
    $form['step_2']['pier2_color'] = [
      '#type' => 'select',
      '#title' => $this->t('Pier Color 2:'),
      '#options' => $options,
      '#empty_option' => $this->t('Select Color'),
      '#weight' => '5',
      '#required' => TRUE,
    ];

    $markup = '<div id="lighting-simulation">
        <img class="lighting-base" src="/modules/custom/lighting_display/images/base.jpg" alt="Cuomo Bridge lit all in white. Following images overlay to add color" />
        <img class="lighting-overlay towers towers-pink" src="/modules/custom/lighting_display/images/towers-pink.png" alt="Pink tower color" />
        <img class="lighting-overlay towers towers-purple" src="/modules/custom/lighting_display/images/towers-purple.png" alt="Purple tower color" />
        <img class="lighting-overlay towers towers-blue" src="/modules/custom/lighting_display/images/towers-blue.png" alt="Blue tower color" />
        <img class="lighting-overlay towers towers-blue-green" src="/modules/custom/lighting_display/images/towers-blue-green.png" alt="Blue-Green tower color" />
        <img class="lighting-overlay towers towers-mint-green" src="/modules/custom/lighting_display/images/towers-mint-green.png" alt="Mint Green tower color" />
        <img class="lighting-overlay towers towers-dark-green" src="/modules/custom/lighting_display/images/towers-dark-green.png" alt="Dark Green tower color" />
        <img class="lighting-overlay towers towers-green" src="/modules/custom/lighting_display/images/towers-green.png" alt="Green tower color" />
        <img class="lighting-overlay towers towers-yellow" src="/modules/custom/lighting_display/images/towers-yellow.png" alt="Yellow tower color" />
        <img class="lighting-overlay towers towers-orange" src="/modules/custom/lighting_display/images/towers-orange.png" alt="Orange tower color" />
        <img class="lighting-overlay towers towers-dark-orange" src="/modules/custom/lighting_display/images/towers-dark-orange.png" alt="Dark Orange tower color" />
        <img class="lighting-overlay towers towers-red-orange" src="/modules/custom/lighting_display/images/towers-red-orange.png" alt="Red-Orange tower color" />
        <img class="lighting-overlay towers towers-red" src="/modules/custom/lighting_display/images/towers-red.png" alt="Red tower color" />
        
        <img class="lighting-overlay pier1 pier1-pink" src="/modules/custom/lighting_display/images/pier1-pink.png" alt="Pink pier1 color" />
        <img class="lighting-overlay pier1 pier1-purple" src="/modules/custom/lighting_display/images/pier1-purple.png" alt="Purple pier1 color" />
        <img class="lighting-overlay pier1 pier1-blue" src="/modules/custom/lighting_display/images/pier1-blue.png" alt="Blue tower color" />
        <img class="lighting-overlay pier1 pier1-blue-green" src="/modules/custom/lighting_display/images/pier1-blue-green.png" alt="Blue-Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-mint-green" src="/modules/custom/lighting_display/images/pier1-mint-green.png" alt="Mint Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-dark-green" src="/modules/custom/lighting_display/images/pier1-dark-green.png" alt="Dark Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-green" src="/modules/custom/lighting_display/images/pier1-green.png" alt="Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-yellow" src="/modules/custom/lighting_display/images/pier1-yellow.png" alt="Yellow pier1 color" />
        <img class="lighting-overlay pier1 pier1-orange" src="/modules/custom/lighting_display/images/pier1-orange.png" alt="Orange pier1 color" />
        <img class="lighting-overlay pier1 pier1-dark-orange" src="/modules/custom/lighting_display/images/pier1-dark-orange.png" alt="Dark Orange pier1 color" />
        <img class="lighting-overlay pier1 pier1-red-orange" src="/modules/custom/lighting_display/images/pier1-red-orange.png" alt="Red-Orange pier1 color" />
        <img class="lighting-overlay pier1 pier1-red" src="/modules/custom/lighting_display/images/pier1-red.png" alt="Red pier1 color" />
        
        <img class="lighting-overlay pier2 pier2-pink" src="/modules/custom/lighting_display/images/pier2-pink.png" alt="Pink pier2 color" />
        <img class="lighting-overlay pier2 pier2-purple" src="/modules/custom/lighting_display/images/pier2-purple.png" alt="Purple pier2 color" />
        <img class="lighting-overlay pier2 pier2-blue" src="/modules/custom/lighting_display/images/pier2-blue.png" alt="Blue tower color" />
        <img class="lighting-overlay pier2 pier2-blue-green" src="/modules/custom/lighting_display/images/pier2-blue-green.png" alt="Blue-Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-mint-green" src="/modules/custom/lighting_display/images/pier2-mint-green.png" alt="Mint Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-dark-green" src="/modules/custom/lighting_display/images/pier2-dark-green.png" alt="Dark Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-green" src="/modules/custom/lighting_display/images/pier2-green.png" alt="Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-yellow" src="/modules/custom/lighting_display/images/pier2-yellow.png" alt="Yellow pier2 color" />
        <img class="lighting-overlay pier2 pier2-orange" src="/modules/custom/lighting_display/images/pier2-orange.png" alt="Orange pier2 color" />
        <img class="lighting-overlay pier2 pier2-dark-orange" src="/modules/custom/lighting_display/images/pier2-dark-orange.png" alt="Dark Orange pier2 color" />
        <img class="lighting-overlay pier2 pier2-red-orange" src="/modules/custom/lighting_display/images/pier2-red-orange.png" alt="Red-Orange pier2 color" />
        <img class="lighting-overlay pier2 pier2-red" src="/modules/custom/lighting_display/images/pier2-red.png" alt="Red pier2 color" />
        
</div>';

    $form['step_2']['display'] = [
      '#markup' => $markup,
      '#weight' => '10',
    ];
    $form['step_2']['info_share'] = [
      '#markup' => $this->t('<p><strong>Not ready to submit your design? Share with a friend!</strong></p><p class="lighting-note">Note: Sharing at this stage will not officially submit
        your lighting combination for review by the New York State Thruway. 
        Please submit through the form below if you would like your design
        to be considered for bridge lighting.</p>'),
      '#weight' => '15',
    ];

    $form['step_2']['share'] = [
      '#markup' => $this->t('<div class="button-link share-button-wrapper">
        <a class="button-arrow-blue share-button" target="_blank" href="/share-lighting-design">Share</a>
      </div>'),
      '#weight' => '20',
    ];
    $form['step_3'] = [
      '#type' => 'container',
      '#weight' => '0',
      '#open' => TRUE,
    ];

    $form['step_3']['summary'] = [
      '#type' => 'item',
      '#markup' => '<h4>Step 3: Submit and Share</h4>',
      '#weight' => '-10',
    ];

    $form['step_3']['applicant_name'] = [
      '#type' => 'textfield',
      '#placeholder' => $this->t('Applicant\'s Name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
      '#required' => TRUE,
    ];
    $form['step_3']['org'] = [
      '#type' => 'textfield',
      '#placeholder' => $this->t('Affiliated Organization'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '2',
      '#required' => TRUE,
    ];
    $form['step_3']['zip'] = [
      '#type' => 'textfield',
      '#placeholder' => $this->t('Applicant\'s ZIP Code'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '4',
      '#required' => TRUE,
    ];
    $form['step_3']['email'] = [
      '#type' => 'email',
      '#placeholder' => $this->t('Email'),
      '#weight' => '6',
      '#required' => TRUE,
    ];
    $form['step_3']['display_name'] = [
      '#type' => 'textfield',
      '#placeholder' => $this->t('Name Your Lighting Display'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '8',
      '#required' => TRUE,
    ];
    $form['step_3']['desc'] = [
      '#type' => 'textarea',
      '#placeholder' => $this->t('Description (Optional)'),
      '#weight' => '10',
    ];
    $form['step_3']['permission'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I provide permission for New York State Thruway Authority to share my bridge design on social media and the website'),
      '#weight' => '12',
    ];
    $form['step_3']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#weight' => '14',
      '#attributes' => ['class' => ['button-arrow-blue']]
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    return;
    foreach ($form_state->getValues() as $key => $value) {

    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // retrieve the e-mail address entered.
    $email = $form_state->getValue('email');

    // check to see if the e-mail address was provided.
    if (!empty($email)) {
      // if so, then check to see if the e-mail address provided is valid.
      if (\Drupal::service('email.validator')->isValid($email)) {
        $applicant_name = $form_state->getValue('applicant_name');
        $org = $form_state->getValue('org');
        $zip = $form_state->getValue('zip');
        $lighting_title = $form_state->getValue('display_name');
        $permission = $form_state->getValue('permission');
        $desc = $form_state->getValue('desc');
        $tower = $form_state->getValue('towers_color');
        $pier1 = $form_state->getValue('pier1_color');
        $pier2 = $form_state->getValue('pier2_color');
        $selected_slot = $form_state->getValue('selected_slot');

        $display_request = LightingDisplay::create();
        $display_request->setSlotId($selected_slot);
        $display_request->setName($lighting_title);
        $display_request->setApplicantName($applicant_name);
        $display_request->setApplicantOrg($org);
        $display_request->setApplicantZip($zip);
        $display_request->setPermission((bool) $permission);
        $display_request->setDescription($desc);
        $display_request->setTowerColor($tower);
        $display_request->setPierColor1($pier1);
        $display_request->setPierColor2($pier2);
        $display_request->save();
        $slot = $display_request->getSlot();
        $slot->addDisplayRequest($display_request);
        $slot->save();

        // now redirect to the display request and set query string for thank you message

        $form_state->setRedirectUrl(Url::fromRoute('entity.lighting_display.canonical', ['lighting_display' => $display_request->id()], [
          'query' => [
            'thanks' => 1
          ]
        ]));

      } else {
        // else, display an error message that the email address provided is invalid.
        drupal_set_message(t('Invalid Email Address! Please provide a different email address.'), 'error');
      }
    } else {
      // else, display an error message that the e-mail address is required.
      drupal_set_message(t('The Email Address is required'), 'error');
    }
  }

}
