let mix = require('laravel-mix');

mix.scripts([
    'resources/assets/theme/vendors/js/jquery-2.1.3.min.js',
    'resources/assets/theme/vendors/js/bootstrap-3.3.7.min.js',
    'resources/assets/theme/vendors/js/dataTables-1.10.16.min.js',
    'resources/assets/theme/vendors/js/dataTables-1.10.16.bootstrap.min.js',
    'resources/assets/theme/vendors/js/chosen.jquery.min.js',
    'resources/assets/theme/vendors/js/bootstrap-datepicker.min.js',
], 'public/js/vendors.js')

mix.styles([
    'resources/assets/theme/vendors/css/bootstrap.min.css',
    'resources/assets/theme/vendors/css/dataTables-1.10.16.bootstrap.min.css',
    'resources/assets/theme/vendors/css/chosen.bootstrap.min.css',
    'resources/assets/theme/vendors/css/bootstrap-datepicker.min.css',
    'resources/assets/theme/vendors/css/flatly.bootstrap-3.3.7.min.css',
], 'public/css/vendors.css')

mix.scripts([
    'resources/assets/theme/application/js/initializer.js',
], 'public/js/application.js')

mix.styles([
    'resources/assets/theme/application/css/app-layout.css',
], 'public/css/application.css')

mix.styles([
    'resources/assets/theme/application/css/loader.css',
], 'public/css/loader.css')
