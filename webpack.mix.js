let mix = require('laravel-mix');

mix
    // Compile the main Sass file.
    .sass('resources/assets/sass/main.scss', 'public/css')

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
    // Enable source maps for easier debugging.
    mix.sourceMaps();
}
