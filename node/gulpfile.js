var gulp = require('gulp');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var ngAnnotate = require('gulp-ng-annotate');
var uglify = require('gulp-uglify');
var buffer = require('vinyl-buffer');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('default', function(){
    return browserify({
        entries: './public/js/app.js',
        debug: true
    }).bundle()
        .pipe(source('bundle.js'))
        .pipe(ngAnnotate())
        .pipe(buffer())
        .pipe(sourcemaps.init())
            .pipe(uglify())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('public/js'));
});

gulp.task('watch', function(){
    gulp.watch(['public/js/**/*.js', '!public/js/bundle*'], ['default']);
});