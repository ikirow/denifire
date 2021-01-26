Denifire WordPress Theme
=============================



Getting Started
---------------

1. Replace the text domain `denifire` with your own.
2. Replace the string `Denifire` with your own.
3. Update Style.css Theme info
4. Run `yarn` or `npm install`.
5. Change the Dev domain in gulpfile.js Proxy setting
6. Run `gulp watch`.
7. Optionally you can use:
8. `gulp build` to compile the SCSS

Folder structure
----------------

* `/acf-json` - it fills automatically from ACF fields
* `/assets` - sass, js, icons, images, css
* `/inc` - core theme functions, classes, external plugins & libraries
* `/template-parts` - all content parts
* `/template-parts/blocks` - use for Gutenberg blocks


File structure
--------------

* `/inc/register-blocks` - register all Gutenberg blocks here
* `/inc/register-scripts` - register all styles and scripts
* `/inc/register-plugins` - register all MU third party libraries and plugins
* `/inc/register-shortcodes` - register all shortcodes here
* `/inc/register-widgets` - register all widgets here

SASS & CSS styling
------------------

Basic flexbox grid is used based on [flexbox grid sass](http://hugeinc.github.io/flexboxgrid-sass/). Three main .scss endpoints:
* `site.scss` - main sass file which includes everything in the folders
* `site-admin.scss` - admin-related css
*  `rtl.scss` - css for rtl sites only


Helper Classes & Functions
-----------------


