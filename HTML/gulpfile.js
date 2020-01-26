/*
* npm init
* npm install --save-dev gulp gulp-sass gulp-sourcemaps gulp-autoprefixer gulp-concat gulp-clean-css gulp-if browser-sync
* gulp
* gulp-sass
* gulp-sourcemaps
* gulp-autoprefixer
* gulp-concat
* gulp-clean-css
* gulp-if
* browser-sync
*/

var gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var cleanCss = require('gulp-clean-css');
var gulpIf = require('gulp-if');
var browserSync = require('browser-sync').create();

var config = {
    paths: {
        scss: './scss/**/*.scss',
        html: './public/single.html'
    },
    output: {
        cssName: 'style.min.css',
        path: './public/css',
        html:'./public'
    },
    isDevelop: true
};
//Для разработки т.е. clean-css не работает, после сменить на FALSE, тогда css подчистит style.scc

gulp.task('scss', function () {
    return gulp.src(config.paths.scss)
        .pipe(gulpIf(config.isDevelop, sourcemaps.init()))
        .pipe(sass())
        .pipe(concat(config.output.cssName))
        .pipe(autoprefixer())
        .pipe(gulpIf(!config.isDevelop, cleanCss()))
        .pipe(gulpIf(config.isDevelop, sourcemaps.write()))
        .pipe(gulp.dest(config.output.path))
        .pipe(browserSync.stream());
});

gulp.task('serve', function () {
    browserSync.init({
        server: {
            baseDir: config.output.html
        }
    });

    gulp.watch(config.paths.scss, ['scss']);
    gulp.watch(config.paths.html).on('change', browserSync.reload);
});

gulp.task('default', ['scss', 'serve']);
