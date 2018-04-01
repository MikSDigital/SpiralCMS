var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addEntry('app', './assets/toroide/js/app.js')
    .enableSassLoader()
    .autoProvidejQuery()
    .enableBuildNotifications();

module.exports = Encore.getWebpackConfig();