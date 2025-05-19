# About UMD Terp Theme

UMD Terp is the base theme for all UMD drupal 8 projects. It combines UMD approved elements and functionality, into a modified bootstrap theme. It is best used alongside the [UMD Terp Base Module](https://github.com/umdsais/umd_terp_base), which provides a suite of modules, and configuration to make this theme work as designed. It is also designed to integrate the [UMD Schoolwide Header](https://github.com/umdsais/umd_schoolwide_header).

This theme can be used on its own, or as a base theme for further customizations via a custom sub-theme.

- [UMD Terp Theme](https://github.com/umdsais/umd_terp)
- [UMD Terp Base Module](https://github.com/umdsais/umd_terp_base)
- [UMD Schoolwide Header](https://github.com/umdsais/umd_schoolwide_header)

## Requirements

- [Twig Tweak Module](https://www.drupal.org/project/twig_tweak)
- [UMD Terp Base Module](https://github.com/umdsais/umd_terp_base)

## Installation

- Ensure [Twig Tweak Module](https://www.drupal.org/project/twig_tweak) is enabled.
- Ensure [Twig Field Value Module](https://www.drupal.org/project/twig_field_value) is enabled.
- Install as you normally would any drupal 8 theme.

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

#### UMD Terp Footer Settings

- Address: The address of the department/institution/etc.
- Phone number: The phone number of the department/institution/etc.
- Email: The email address of the department/institution/etc.

#### UMD Terp Social Media Accounts

- Twitter(x) link: The twitter link of the department/institution/etc.
- Facebook(meta) link: The facebook link of the department/institution/etc.
- Youtube link: The youtube link of the department/institution/etc.
- Instagram link: The instagram link of the department/institution/etc.
- LinkedIn link: The linkedin link of the department/institution/etc.

#### UMD Terp Admin Settings

- Assets path: Dev use only. The assets path for any static images/etc in the theme, to be used in twig theme.

## Development

### Versioning

Semantic tagging must take place in github for the updates to be able to be pulled via composer. When ready to deploy, create a tag in github up one version from previous, with the starting version being 8.1.0:

- Minor versions (non breaking changes): 8.1.1, 8.1.2, etc.
- Major versions (breaking changes): 8.2.0, 8.3.0, etc.
- Core versions (based on if modules updated for specific drupal core): 9.0.0, 10.0.0, etc.

### Core (base) theme issues, patches, etc

All edits, requests, etc should be submitted to the github repo for the [UMD Terp Theme](https://github.com/umdsais/umd_terp). Please add issues to the [issues queue](https://github.com/umdsais/umd_terp/issues). Patches will be reviewed on a merit and resources available basis.

### Frontend

All CSS, JS, etc are based in the static folder. This project provides a development experience that mirrors the idfive Component Library but instead uses Bootstrap 4 as the underlying frontend library.

The UMD component library includes [Fractal](http://fractal.build) for component based development. Your own components can be added to the `src/components` folder. Static assets such as JavaScript, CSS and images will be served out of the `build` folder, but can also be configured to your specific needs by editing the [fractal.js file](fractal.js). For more information, read the [fractal guide](http://fractal.build/guide).

See /static/README.md for more information on the frontend configuration.

### Customization

THIS THEME SHOULD NEVER BE MODIFIED DIRECTLY. Instead, create a sub-theme so that you may still benefit from future releases of this base theme. Once you've done that, you can override CSS, templates, and theme processing from within that sub-theme. See [Sub-themes](https://www.drupal.org/docs/8/theming-drupal-8/creating-a-drupal-8-sub-theme-or-sub-theme-of-sub-theme) for more information.

Notes on customization:

- Several widgets include "dark mode". You should account for that if restyling kitchen sink widgets.
- Don't forget to account for the [UMD Schoolwide Header](https://github.com/umdsais/umd_schoolwide_header).

## Troubleshooting

- Ensure [Twig Tweak Module](https://www.drupal.org/project/twig_tweak) is present, and enabled.
