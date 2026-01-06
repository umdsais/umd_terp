<?php

/**
 * @file
 * UMD Terp (umd_terp), add custom theme settings options here.
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function umd_terp_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {

  // Footer.
  $form['umd_terp_footer_settings'] = [
    '#type' => 'details',
    '#title' => t('UMD Terp Footer Settings'),
  ];


  $form['umd_terp_footer_settings']['umd_terp_address'] = [
    '#type' => 'textfield',
    '#title' => t('Address'),
    '#default_value' => theme_get_setting('umd_terp_address'),
    '#description' => t('Please add the address you wish to display.'),
  ];
  $form['umd_terp_footer_settings']['umd_terp_phone'] = [
    '#type' => 'textfield',
    '#title' => t('Phone number'),
    '#default_value' => theme_get_setting('umd_terp_phone'),
    '#description' => t('Please add the phone number you wish to display.'),
  ];
  $form['umd_terp_footer_settings']['umd_terp_email'] = [
    '#type' => 'textfield',
    '#title' => t('Email'),
    '#default_value' => theme_get_setting('umd_terp_email'),
    '#description' => t('Please add the email address you wish to display.'),
  ];

  // Social media.
  $form['umd_terp_social_settings'] = [
    '#type' => 'details',
    '#title' => t('UMD Terp Social Media Accounts'),
  ];
  $form['umd_terp_social_settings']['umd_terp_twitter_link'] = [
    '#type' => 'textfield',
    '#title' => t('Twitter(x) link'),
    '#default_value' => theme_get_setting('umd_terp_twitter_link'),
    '#description' => t('Add the URL to your twitter profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_facebook_link'] = [
    '#type' => 'textfield',
    '#title' => t('Facebook(meta) link'),
    '#default_value' => theme_get_setting('umd_terp_facebook_link'),
    '#description' => t('Add the URL to your facebook profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_youtube_link'] = [
    '#type' => 'textfield',
    '#title' => t('Youtube link'),
    '#default_value' => theme_get_setting('umd_terp_youtube_link'),
    '#description' => t('Add the URL to your youtube profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_instagram_link'] = [
    '#type' => 'textfield',
    '#title' => t('Instagram link'),
    '#default_value' => theme_get_setting('umd_terp_instagram_link'),
    '#description' => t('Add the URL to your instagram profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_linkedin_link'] = [
    '#type' => 'textfield',
    '#title' => t('LinkedIn link'),
    '#default_value' => theme_get_setting('umd_terp_linkedin_link'),
    '#description' => t('Add the URL to your linkedin profile.'),
  ];

  // Other.
  $form['other'] = [
    '#type' => 'details',
    '#title' => t('UMD Terp Admin Settings'),
    '#collapsible' => TRUE,
  ];

  $form['other']['umd_terp_assets_path'] = [
    '#type' => 'textfield',
    '#title' => t('Assets path'),
    '#description' => t('Provides a site wide {{ assets_path }} variable for the builds assets path relative to the theme root. Usable in twig templates. Ex: /static/build'),
    '#default_value' => theme_get_setting('umd_terp_assets_path'),
  ];

  $form['#submit'][] = 'umd_terp_form_system_theme_settings_submit';
}

/**
 * Custom file upload validator.
 */
function umd_terp_form_system_theme_settings_validate_test($form, FormStateInterface &$form_state) {
  // Handle file uploads.
  $validators = [
    'file_validate_is_image' => [],
  ];
  // Check for a new uploaded logo.
  $file = file_save_upload('umd_terp_footer_logo_upload', $validators, FALSE, 0);
  if (isset($file)) {
    if ($file) {
      $form_state->setValue('umd_terp_footer_logo_upload', $file);
    }
    else {
      $form_state->setErrorByName('umd_terp_footer_logo_upload', t('The footer logo could not be uploaded.'));
    }
  }
}

/**
 * Custom submit handler, to process custom footer logo.
 */
function umd_terp_form_system_theme_settings_submit(&$form, FormStateInterface $form_state) {
  $values = $form_state->getValues();
  $filename = '';
  if (!empty($values['umd_terp_footer_logo_upload'])) {
    $file = File::load($values['umd_terp_footer_logo_upload'][0]);
    if (!empty($file)) {
      $file->setPermanent();
      $file->save();
      $file_usage = \Drupal::service('file.usage');
      $file_usage->add($file, 'umd_terp', 'user', \Drupal::currentUser()->id());
      $filename = $file->getFileUri();
    }
    $values['umd_terp_footer_logo_path'] = $filename;
    $form_state->setValue(['umd_terp_footer_logo_path'], $filename);
    $form_state->unsetValue('umd_terp_footer_logo_upload');
  }
}