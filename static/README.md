# Fractal Bootstrap

This project provides a development experience that mirrors the idfive Component Library but instead uses Bootstrap 4 as the underlying frontend library. Used to be fractal, but now a skeleton for use with UMD Digital Design system.

## Installation

Dependencies need to be installed with [node/npm](https://docs.npmjs.com/getting-started/installing-node).

`npm install`

## Development

### Watch mode

If you want to watch for changes without launching a development server, you can run the watch command:

`npm run watch`

### Webpack server

If you do not wish to use Fractal in development, you can use the webpack development server:

`npm run serve`

## Building for production

To build your code for production, run the following:

`npm run build`

This will generate `build` and `fractal` folders at the root of your project. The `build` folder contains all of your compiled assets (CSS, JavaScript etc.), while the `fractal` folder contains a static generated version of your Fractal component library, which can be used for previews and an online reference to your component library. See the [Clearleft Fractal Library](http://fractal.clearleft.com) as an example.

### Passing paramters to your npm scrips

It is possible to pass parameters to your build scripts, which will then be exposed in JS via `process.env`. Example:

`npm run build --apiBase=http://prod.com`

In your JS file:

`const apiBase = process.env.apiBase || 'http://localapi.com';`

## Overriding Bootstrap styles

Bootstrap 4 provides Sass variables out of the box to allow customization of component styles while writing very little code. To override these variables use `src/scss/_core/_variables.scss`. For a few components, custom variables have been provided and can also be overridden in that stylesheet.
