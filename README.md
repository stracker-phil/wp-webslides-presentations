# Gutenberg Block Plugin

## Requirements

* PHP 5.4 or higher (namespaces, short array notation)
* `npm` version 6 or higher
* WordPress 5.0 or higher

## Setup

1. Rename the folder and `plugin.php`
2. Edit the plugin name in `package.json`
3. Edit the plugin header, rename namespaces
4. Rename the `wpblock` textdomain in all .php and .js files
5. Run `npm install` in the plugin folder
6. Build the assets: `npm run dev`

### Re-build the Gutenberg blocks

* `npm run dev` .. One time compilation in development mode.
* `npm run watch` .. Live-compilation in development mode.
* `npm run build` .. Build the production assets.

## API documentation

https://wordpress.org/gutenberg/handbook/

## Theme for testing

https://github.com/WordPress/gutenberg-starter-theme
