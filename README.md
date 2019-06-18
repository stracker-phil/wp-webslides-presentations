# Webslides Editor Development guidelines

## Requirements

* PHP 5.4 or higher (namespaces, short array notation)
* `npm` version 6 or higher
* WordPress 5.0 or higher

## Setup

1. Simply run `npm install` in the plugin folder
2. Now you can use one of the two `npm run` commands below to compile the JS/CSS

### Re-build the Gutenberg blocks

* `npm run dev` .. Live-compilation in development mode.
* `npm run build` .. Build the production assets.

### Folder structure

The block-sources are inside the folder `/src/blocks/` and `/src/plugin/`.
This "src" folder is not used by the plugin, but only compiled by npm into final JS/CSS files.
The copiled JS/CSS files are stored in the folder `assets/js/` and `assets/css/`.

## API documentation

https://wordpress.org/gutenberg/handbook/

## Theme for testing

https://github.com/WordPress/gutenberg-starter-theme
