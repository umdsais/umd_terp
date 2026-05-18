# About UMD Terp Theme

UMD Terp is the base theme for all UMD Drupal 11 projects. It integrates the [UMD Design System web components library](https://playground.designsystem.umd.edu/) into a Drupal theme. It is best used alongside the [UMD Terp Base Module](https://github.com/umdsais/umd_terp_base), which provides a suite of modules and configuration to make this theme work as designed. It is also designed to integrate the [UMD Schoolwide Header](https://github.com/umdsais/umd_schoolwide_header).

This theme can be used on its own, or as a base theme for further customizations via a custom sub-theme.

- [UMD Terp Theme](https://github.com/umdsais/umd_terp)
- [UMD Terp Base Module](https://github.com/umdsais/umd_terp_base)
- [UMD Schoolwide Header](https://github.com/umdsais/umd_schoolwide_header)

## Requirements

- [Twig Tweak Module](https://www.drupal.org/project/twig_tweak)
- [Twig Field Value Module](https://www.drupal.org/project/twig_field_value)
- [UMD Terp Base Module](https://github.com/umdsais/umd_terp_base)

## Installation

- Ensure [Twig Tweak Module](https://www.drupal.org/project/twig_tweak) is enabled.
- Ensure [Twig Field Value Module](https://www.drupal.org/project/twig_field_value) is enabled.
- Install as you normally would any Drupal theme.

### Via Composer

- `composer require umd_digital/umd_terp --prefer-dist`
- `drush en umd_terp` or enable via admin UI

### Manually

- Download this repo into /themes/contrib/umd_terp
- `drush en umd_terp` or enable via admin UI

## Configuration

- Ensure the [UMD Terp Base Module](https://github.com/umdsais/umd_terp_base) is installed, and submodules enabled.

### Theme options

#### Logo Image

- Logo: The logo of the department/institution/etc.

#### UMD Terp Hero Settings

- Interior Hero type: Controls the hero displayed on individual events and articles.
  - **Default Hero:** Uses the `<umd-element-hero>` component. Standard graphical design with a larger footprint.
  - **Minimal Hero:** Uses the `<umd-element-hero-minimal>` component. A lighter display with a smaller title and no background image.

#### UMD Terp Footer Settings

- Footer type: Controls which footer layout is used.
  - **Simple Footer:** Compact footer with site name, address, contact links, and social media icons.
  - **Mega Footer:** Expanded footer with contact/social info plus three columns of navigational links drawn from the *Footer Mega Menu Column One/Two/Three* menus.
- Mega Footer: Column One/Two/Three Heading: Configurable headings for each link column (visible only when Mega Footer is selected). Links are managed at Structure > Menus.
- Address: The address of the department/institution/etc.
- Phone number: The phone number of the department/institution/etc.
- Email: The email address of the department/institution/etc.

#### UMD Terp Social Media Accounts

- Twitter(x) link: The twitter link of the department/institution/etc.
- Facebook(meta) link: The facebook link of the department/institution/etc.
- Youtube link: The youtube link of the department/institution/etc.
- Instagram link: The instagram link of the department/institution/etc.
- LinkedIn link: The linkedin link of the department/institution/etc.
- Threads link: The Threads link of the department/institution/etc.

#### UMD Terp Admin Settings

- Assets path: Dev use only. The assets path for any static images/etc in the theme, to be used in twig theme.

## Development

### Versioning

Semantic tagging must take place in github for the updates to be able to be pulled via composer. When ready to deploy, create a tag in github up one version from previous:

- Minor versions (non breaking changes): 11.0.1, 11.0.2, etc.
- Major versions (breaking changes): 11.1.0, 11.2.0, etc.
- Core versions (based on Drupal core compatibility): 12.0.0, etc.

### Core (base) theme issues, patches, etc

All edits, requests, etc should be submitted to the github repo for the [UMD Terp Theme](https://github.com/umdsais/umd_terp). Please add issues to the [issues queue](https://github.com/umdsais/umd_terp/issues). Patches will be reviewed on a merit and resources available basis.

### Frontend

CSS and JS are compiled from the `static/` folder using [Vite](https://vitejs.dev/). The theme integrates the [UMD Design System web components library](https://playground.designsystem.umd.edu/) for UMD-branded components.

See `static/README.md` for more information on the frontend configuration.

### Customization

THIS THEME SHOULD NEVER BE MODIFIED DIRECTLY. Instead, create a sub-theme so that you may still benefit from future releases of this base theme. Once you've done that, you can override CSS, templates, and theme processing from within that sub-theme. See [Sub-themes](https://www.drupal.org/docs/theming-drupal/creating-a-drupal-sub-theme) for more information.

Notes on customization:

- Several widgets include "dark mode". You should account for that if restyling kitchen sink widgets.
- Don't forget to account for the [UMD Schoolwide Header](https://github.com/umdsais/umd_schoolwide_header).

## Troubleshooting

- Ensure [Twig Tweak Module](https://www.drupal.org/project/twig_tweak) is present, and enabled.
