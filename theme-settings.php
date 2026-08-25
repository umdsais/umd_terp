<?php

/**
 * @file
 * UMD Terp (umd_terp), add custom theme settings options here.
 */

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function umd_terp_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {
  $theme_settings_provider = \Drupal::service(\Drupal\Core\Extension\ThemeSettingsProvider::class);

  // Hero.
  $form['umd_terp_hero_settings'] = [
    '#type' => 'details',
    '#title' => t('UMD Terp Hero Settings'),
  ];

  $form['umd_terp_hero_settings']['umd_terp_hero_type'] = [
    '#type' => 'select',
    '#title' => t('Interior Hero type'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_hero_type') ?: 'default',
    '#options' => [
      'default' => t('Default Hero'),
      'minimal' => t('Minimal Hero'),
    ],
    '#description' => t('Choose what type of Hero should display on individual events, and articles.<ul><li><strong>Default Hero:</strong> Uses the <code>&lt;umd-element-hero&gt;</code> component. Has a standard graphical design and a larger footprint.</li><li><strong>Minimal Hero:</strong> Uses the <code>&lt;umd-element-hero-minimal&gt;</code> component. A lighter, more minimal display with a smaller title and no background image.</li></ul>'),
  ];

  // Footer.
  $form['umd_terp_footer_settings'] = [
    '#type' => 'details',
    '#title' => t('UMD Terp Footer Settings'),
  ];

  $form['umd_terp_footer_settings']['umd_terp_footer_type'] = [
    '#type' => 'select',
    '#title' => t('Footer type'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_footer_type') ?: 'simple',
    '#options' => [
      'simple' => t('Simple Footer'),
      'mega' => t('Mega Footer'),
    ],
    '#description' => t('<strong>Simple Footer:</strong> Displays a compact footer with site name, address, contact links, and social media icons. Suitable for most sites.<br><strong>Mega Footer:</strong> Displays an expanded footer with the same contact and social information plus three columns of navigational links drawn from the <em>Footer Mega Menu Column One/Two/Three</em> menus. Column headings are configurable below and the menus are managed at <a href="/admin/structure/menu">Structure &gt; Menus</a>.'),
  ];


  // Mega footer column headings — only visible when Mega Footer is selected.
  $form['umd_terp_footer_settings']['umd_terp_mega_footer_column_one_heading'] = [
    '#type' => 'textfield',
    '#title' => t('Mega Footer: Column One Heading'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_mega_footer_column_one_heading') ?: t('Important Links'),
    '#description' => t('Heading displayed above the first link column. Add links to this column at <a href="/admin/structure/menu/manage/footer-mega-menu-column-one">Footer Mega Menu Column One</a>.'),
    '#states' => [
      'visible' => [':input[name="umd_terp_footer_type"]' => ['value' => 'mega']],
    ],
  ];
  $form['umd_terp_footer_settings']['umd_terp_mega_footer_column_two_heading'] = [
    '#type' => 'textfield',
    '#title' => t('Mega Footer: Column Two Heading'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_mega_footer_column_two_heading') ?: t('Information for'),
    '#description' => t('Heading displayed above the second link column. Add links to this column at <a href="/admin/structure/menu/manage/footer-mega-menu-column-two">Footer Mega Menu Column Two</a>.'),
    '#states' => [
      'visible' => [':input[name="umd_terp_footer_type"]' => ['value' => 'mega']],
    ],
  ];
  $form['umd_terp_footer_settings']['umd_terp_mega_footer_column_three_heading'] = [
    '#type' => 'textfield',
    '#title' => t('Mega Footer: Column Three Heading'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_mega_footer_column_three_heading') ?: t('Academics'),
    '#description' => t('Heading displayed above the third link column. Add links to this column at <a href="/admin/structure/menu/manage/footer-mega-menu-column-three">Footer Mega Menu Column Three</a>.'),
    '#states' => [
      'visible' => [':input[name="umd_terp_footer_type"]' => ['value' => 'mega']],
    ],
  ];

  $form['umd_terp_footer_settings']['umd_terp_address'] = [
    '#type' => 'textfield',
    '#title' => t('Address'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_address'),
    '#description' => t('Please add the address you wish to display.'),
  ];
  $form['umd_terp_footer_settings']['umd_terp_phone'] = [
    '#type' => 'textfield',
    '#title' => t('Phone number'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_phone'),
    '#description' => t('Please add the phone number you wish to display.'),
  ];
  $form['umd_terp_footer_settings']['umd_terp_email'] = [
    '#type' => 'textfield',
    '#title' => t('Email'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_email'),
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
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_twitter_link'),
    '#description' => t('Add the URL to your twitter profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_facebook_link'] = [
    '#type' => 'textfield',
    '#title' => t('Facebook(meta) link'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_facebook_link'),
    '#description' => t('Add the URL to your facebook profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_youtube_link'] = [
    '#type' => 'textfield',
    '#title' => t('Youtube link'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_youtube_link'),
    '#description' => t('Add the URL to your youtube profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_instagram_link'] = [
    '#type' => 'textfield',
    '#title' => t('Instagram link'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_instagram_link'),
    '#description' => t('Add the URL to your instagram profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_linkedin_link'] = [
    '#type' => 'textfield',
    '#title' => t('LinkedIn link'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_linkedin_link'),
    '#description' => t('Add the URL to your linkedin profile.'),
  ];
  $form['umd_terp_social_settings']['umd_terp_threads_link'] = [
    '#type' => 'textfield',
    '#title' => t('Threads link'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_threads_link'),
    '#description' => t('Add the URL to your Threads profile.'),
  ];

  // Content paths.
  $form['umd_terp_content_settings'] = [
    '#type' => 'details',
    '#title' => t('UMD Terp Content Settings'),
  ];

  $form['umd_terp_content_settings']['umd_terp_articles_path'] = [
    '#type' => 'textfield',
    '#title' => t('Articles listing path'),
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_articles_path') ?: '/articles',
    '#description' => t('The path to the articles/news listing page. Category links on article nodes will point here. Example: <code>/news</code> or <code>/articles</code>.'),
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
    '#default_value' => $theme_settings_provider->getSetting('umd_terp_assets_path'),
  ];

}