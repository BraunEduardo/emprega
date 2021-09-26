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
    .sass('resources/sass/app.scss', 'public/css', {
        use: [
            require('@webgarden/postcss-high-contrast')({
                aggressiveHC: true,
                aggressiveHCDefaultSelectorList: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'li', 'th', 'td'],
                aggressiveHCCustomSelectorList: ['div', 'span'],

                colorProps: ['color', 'fill'],

                backgroundColor: '#000',
                altBgColor: '#fff',

                textColor: '#fff',

                buttonSelector: ['button'],
                buttonColor: '#000',
                buttonBackgroundColor: '#fcff3c',
                buttonBorderColor: 'none',

                linkSelectors: ['a'],
                linkColor: '#fcff3c',
                linkHoverColor: '#fcff3c',

                borderColor: '#fff',
                disableShadow: true,

                customSelectors: ['input'],
                customSelectorColor: '#fff',
                customSelectorBackgroundColor: '#000',
                customSelectorBorderdColor: '#fff',

                selectorsBlackList: ['textfield'],

                imageFilter: 'invert(100%)',
                imageSelectors: ['img'],

                CSSPropsWhiteList: ['background', 'background-color', 'color', 'border', 'border-top', 'border-bottom',
                'border-left', 'border-right', 'border-color', 'border-top-color', 'border-right-color',
                'border-bottom-color', 'border-left-color', 'box-shadow', 'filter', 'text-shadow', 'fill'],
                HTMLHighContrastClass: 'hc',
                removeAnimations: false,
                append: true
            })

        ]
    });



// mix.postCss('resources/sass/app.scss', 'public/css', [
//     require('postcss-high-contrast')
// ]);
