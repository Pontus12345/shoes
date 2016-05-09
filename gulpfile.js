var gulp = require('gulp');

/**
* @Desc: Requires the gulp plugins Compiling sass, js
*/

var concat = require('gulp-concat');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

gulp.task('sass', function(){
  return gulp.src('./resources/assets/sass/**/*.scss')
    .pipe(sass()) // Using gulp-sass
    .pipe(gulp.dest('./public/css'));
});

gulp.task('watch', function(){
	gulp.watch('./resources/assets/sass/**/*.scss', ['sass']);
	gulp.watch('./resources/assets/js/**/*.js', ['scripts']);
});

gulp.task('scripts', function () {
    gulp.src('./resources/assets/js/**/*.js')
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});
