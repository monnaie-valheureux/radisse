let mix = require('laravel-mix');

mix
    // Compile the main Sass files.
    .sass('resources/assets/sass/main.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css')

    // Publish assets for front-end dependencies.
    .copy('node_modules/leaflet/dist', 'public/vendor/leaflet')
    .copy(
        'node_modules/leaflet.markercluster/dist',
        'public/vendor/leaflet.markercluster'
    )
    .copy(
        'node_modules/leaflet.featuregroup.subgroup/dist',
        'public/vendor/leaflet.featuregroup.subgroup'
    )

    .options({
        // Prevent Webpack to do incredibly stupid things by trying to
        // be clever and thinking he can process our external assets.
        processCssUrls: false
    })

    // Mix, please do shut up and stop bothering people every three seconds.
    .disableNotifications();


if (mix.inProduction()) {
    // Enable pseudo-file versioning to avoid any caching issue.
    mix.version();

} else {
    // Partly fix the generation of source maps, which has apparently
    // been broken by Jeffrey…
    // See https://github.com/JeffreyWay/laravel-mix/issues/879
    mix.webpackConfig({ devtool: "inline-source-map" });

    // Enable source maps for easier debugging.
    mix.sourceMaps();
}
