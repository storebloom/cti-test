CTI Test theme.

For local development:

#Get local env running
1. run `docker-compose up -d` at root of working tree.
2. run `composer install` to get plugins.
2. install your fresh WP instance.
3. Activate CTI Custom theme.

#Compiling theme SCSS/JS
1. cd to theme `wordpress/wp-content/themes/cti-custom`
2. run `yarn install`
3. compile SCSS by running `gulp sass`
4. compile JS by running `gulp js`
