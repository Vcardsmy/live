const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').
    postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);


mix.copy('node_modules/datatables/media/images', 'public/assets/images')
mix.copyDirectory([
    'resources/assets/img',
    'node_modules/intl-tel-input/build/img',
], 'public/assets/img');
mix.copyDirectory('public/web/plugins/global/fonts', 'public/assets/css/fonts')
mix.copyDirectory('public/backend/webfonts', 'public/assets/webfonts')

mix.sass('resources/assets/scss/vcard1.scss', 'public/assets/css/vcard1.css').
    sass('resources/assets/scss/vcard2.scss', 'public/assets/css/vcard2.css').
    sass('resources/assets/scss/vcard3.scss', 'public/assets/css/vcard3.css').
    sass('resources/assets/scss/vcard4.scss', 'public/assets/css/vcard4.css').
    sass('resources/assets/scss/vcard5.scss', 'public/assets/css/vcard5.css').
    sass('resources/assets/scss/vcard6.scss', 'public/assets/css/vcard6.css').
    sass('resources/assets/scss/vcard7.scss', 'public/assets/css/vcard7.css').
    sass('resources/assets/scss/vcard8.scss', 'public/assets/css/vcard8.css').
    sass('resources/assets/scss/vcard9.scss', 'public/assets/css/vcard9.css').
    sass('resources/assets/scss/vcard10.scss', 'public/assets/css/vcard10.css').
    version()


mix.js('resources/assets/js/vcards/vcard-view.js',
    'public/assets/js/vcards/vcard-view.js').version();


// third-party js
mix.scripts([
    'public/backend/js/jquery.min.js',
    'node_modules/datatables/media/js/jquery.dataTables.min.js',
    'node_modules/izitoast/dist/js/iziToast.min.js',
    'public/backend/js/vendor.js',
    'public/assets/js/messages.js',
    'public/backend/js/3rd-party-custom.js',
    'node_modules/daterangepicker/moment.min.js',
    'node_modules/moment/min/moment.min.js',
    'node_modules/chart.js/dist/chart.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/daterangepicker/daterangepicker.js'
], 'public/assets/js/third-party.js').version();

mix.scripts('node_modules/intl-tel-input/build/js/utils.js', 'public/assets/js/inttel/js/utils.min.js')

// pages js
mix.js([
    'resources/assets/js/custom/turbo.js',
    'resources/assets/js/custom/helpers.js',
    'resources/assets/js/custom/custom.js',
    'resources/assets/js/features/features.js',
    'resources/assets/js/roles/create-edit.js',
    'resources/assets/js/email_sub/email-sub.js',
    'resources/assets/js/settings/settings.js',
    'resources/assets/js/dashboard/dashboard.js',
    'resources/assets/js/users/users.js',
    'resources/assets/js/users/userVcard.js',
    'resources/assets/js/users/create-edit.js',
    'resources/assets/js/vcards/vcards.js',
    'resources/assets/js/vcards/template.js',
    'resources/assets/js/vcards/create-edit.js',
    'resources/assets/js/vcards/services/services.js',
    'resources/assets/js/vcards/gallery/gallery.js',
    'resources/assets/js/vcards/products/products.js',
    'resources/assets/js/vcards/analytics/analytics.js',
    'resources/assets/js/vcards/testimonials/testimonials.js',
    'resources/assets/js/subscription/subscription.js',
    'resources/assets/js/subscription/upgrade.js',
    'resources/assets/js/sadmin/vcards/vcards.js',
    'resources/assets/js/sadmin/plans/plans.js',
    'resources/assets/js/sadmin/plans/create-edit.js',
    'resources/assets/js/sadmin/currencies/currencies.js',
    'resources/assets/js/enquiry/enquiry.js',
    'resources/assets/js/appointment/appointment.js',
    'resources/assets/js/home/contact.js',
    'resources/assets/js/sadmin/countries/countries.js',
    'resources/assets/js/sadmin/testimonial/frontTestimonial.js',
    'resources/assets/js/sadmin/states/states.js',
    'resources/assets/js/sadmin/cities/cities.js',
    'resources/assets/js/custom/phone-number-country-code.js',
    'resources/assets/js/users/user-profile.js',
    'resources/assets/js/sidebar_menu_search/sidebar_menu_search.js',
], 'public/assets/js/pages.js').version();


// third-party css
mix.styles([
    'node_modules/datatables/media/css/jquery.dataTables.css',
    'node_modules/izitoast/dist/css/iziToast.min.css',
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/daterangepicker/daterangepicker.css',
    'public/backend/css/vendor.css',
    'public/backend/css/fonts.css',
    'public/backend/css/3rd-party.css',
    'public/backend/css/3rd-party-custom.css',
], 'public/assets/css/third-party.css')

// page css
mix.sass('resources/assets/css/main.scss', 'public/assets/css/page.css').version()

// page dark-css
mix.sass('resources/assets/css/main-dark-mode.scss','public/assets/css/page-dark.css').version()

// third-party dark css
mix.styles([
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/daterangepicker/daterangepicker.css',
    'public/backend/css/vendor.css',
    'public/backend/css/fonts.css',
    'public/backend/css/3rd-party.css',
    'public/backend/css/3rd-party-custom.css',
    'public/backend/css/style.dark.bundle.css',
], 'public/assets/css/third-party-dark.css')


mix.copy('node_modules/slick-slider/slick/slick-theme.css',
    'public/assets/css/slider/css/slick-theme.min.css')
mix.copy('node_modules/slick-slider/slick/ajax-loader.gif',
    'public/assets/css/slider/css/ajax-loader.gif')
mix.copy('node_modules/slick-slider/slick/slick.css',
    'public/assets/css/slider/css/slick.css')
mix.copy('node_modules/slick-slider/slick/slick.min.js',
    'public/assets/js/slider/js/slick.min.js')



mix.js( 'resources/assets/js/custom/helpers.js', 'public/assets/js/custom/helpers.js')
    .js('resources/assets/js/home/contact.js', 'public/assets/js/home/contact.js')
    .js('resources/assets/js/custom/custom.js', 'public/assets/js/custom/custom.js')
    .js('resources/assets/js/home_page/home_page.js', 'public/assets/js/home_page/home_page.js').version()


mix.sass('resources/assets/css/custom.scss', 'public/assets/css/custom.css').version()


