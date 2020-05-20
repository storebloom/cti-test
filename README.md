CTI Test theme.

For local development:

You need the following:
`Docker`
`Docker Compose`

#Get local env running
1. run `docker-compose up -d` at root of working tree.
2. run `composer install` to get plugins.
2. install your fresh WP instance.
3. Activate CTI Custom theme.

#Compiling theme SCSS/JS (and do this first time)
1. cd to theme `wordpress/wp-content/themes/cti-custom`
2. run `npm install` to get gulp and front end dependencies
3. compile SCSS by running `gulp sass`
4. compile JS by running `gulp js`
