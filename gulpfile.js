var { gulp, src, dest, watch, series } = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var prefix = require('gulp-autoprefixer');
var minify = require('gulp-clean-css');
var cwebp = require('gulp-cwebp');

function compilescss() {
  return src('scss/*.scss')
    .pipe(sass())
    .pipe(prefix('last 2 versions'))
    .pipe(dest('css'))
};

function convertimg() {
  return src('images/*.{jpg,png}')
    .pipe(cwebp())
    .pipe(dest('images'));
}

function watchTask() {
  watch('scss/**/*.scss', compilescss);
  watch('images/*{.jpg,png}', convertimg);
};

exports.default = series(
  compilescss,
  convertimg,
  watchTask
);