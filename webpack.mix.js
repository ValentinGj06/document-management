const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/dropzone/dist/dropzone.css', 'public/css')
    .copy('node_modules/dropzone/dist/dropzone.js', 'public/js')
    .copy('node_modules/datatables.net-dt/css/jquery.dataTables.css', 'public/css')
    .copy('node_modules/datatables.net-dt/js/dataTables.dataTables.js', 'public/js')
    .copy('node_modules/datatables.net-buttons-dt/css/buttons.dataTables.css', 'public/css')
    .copy('node_modules/datatables.net-buttons/js/dataTables.buttons.js', 'public/js')
    .copy('node_modules/datatables.net-buttons/js/buttons.colVis.js', 'public/js')
    .copy('node_modules/datatables.net-select-dt/css/select.dataTables.css', 'public/css')
    .copy('node_modules/datatables.net-select/js/dataTables.select.js', 'public/js')
    .copy('node_modules/datatables.net/js/jquery.dataTables.js', 'public/js')
    .copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'public/css')
    .copy('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js', 'public/js')
    .copy('node_modules/select2/dist/css/select2.css', 'public/css')
    .copy('node_modules/select2/dist/js/select2.js', 'public/js')
    .copy('node_modules/@coreui/coreui/dist/css/coreui.css', 'public/css')
    .copy('node_modules/@coreui/coreui/dist/js/coreui.js', 'public/js')
    .copy('node_modules/moment/moment.js', 'public/js')
    .copy('node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css', 'public/css')
    .copy('node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/js')
    .copy('node_modules/popper.js/dist/popper.js', 'public/js');
