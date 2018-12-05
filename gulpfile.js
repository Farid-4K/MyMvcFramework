const gulp = require('gulp-param')(require('gulp'), process.argv);
const stylus = require('gulp-stylus');
const reload = require('browser-sync').create();
const concat = require('gulp-concat');
const minifyCSS = require('gulp-csso');
const sourcemaps = require('gulp-sourcemaps');
const image = require('gulp-image');

const config = {
  dir: {
    source: 'app/assets'
  }
};

gulp.task('css', function() {
  return gulp.src(config.dir.source + '/styles/*.styl').
      pipe(stylus()).
      pipe(minifyCSS()).
      pipe(gulp.dest('public/css')).
      pipe(reload.stream());
});

gulp.task('image', function() {
  return gulp.src(config.dir.source + '/images/*').
      pipe(image()).
      pipe(gulp.dest('public/images'));
});

gulp.task('js', function() {
  return gulp.src(config.dir.source + '/scripts/*.js').
      pipe(sourcemaps.init()).
      pipe(concat('app.min.js')).
      pipe(sourcemaps.write()).
      pipe(gulp.dest('public/js')).
      pipe(reload.stream());
});

gulp.task('serve', function() {
  reload.init({
    server: {
      baseDir: './public',
    },
  });
  gulp.watch(config.dir.source + '/styles/**/*.styl', ['css']);
  gulp.watch(config.dir.source + '/javascript/**/*.js', ['js']);
  gulp.watch(config.dir.source + '/images/*', ['image']);
});

gulp.task('default', ['css', 'js', 'image']);
