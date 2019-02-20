var gulp = require("gulp");
var sass = require("gulp-sass");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var cssnano = require("cssnano");
var browserSync = require("browser-sync").create();
var plumber = require("gulp-plumber");


function syncBrowser() {
    browserSync.init({
        injectChanges: true,
        proxy: 'localhost/home',
        port: 81,
        open: false
    });
}
exports.syncBrowser;

function reload() {
    browserSync.reload();
}
exports.reload = reload;

function style() {
    return (
        gulp
            .src("public/scss/**/*.scss")
            .pipe(sass())
            .pipe(plumber())
            .pipe(postcss([autoprefixer(), cssnano()]))
            .pipe(gulp.dest("css"))
            .pipe(browserSync.stream())
    );
}


exports.style = style;

function watch() {
    gulp.watch("public/scss/**/*.scss", style);
    gulp.watch("template/**/*.phtml", reload);
}

exports.watch = watch;

gulp.task('default', gulp.parallel(watch, syncBrowser, style));
