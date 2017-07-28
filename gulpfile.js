var gulp         = require('gulp');
var sass         = require('gulp-sass');
var autoprefixer = require('autoprefixer');
var plumber      = require('gulp-plumber');
var sourcemaps   = require('gulp-sourcemaps');
var watch	     = require('gulp-watch');

var sass_task = function() {
  return gulp
	.src('assets/sass/*.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass.sync({
        outputStyle: 'expanded',
            precision: 10,
            includePaths: ['.']
        }).on('error', sass.logError))
        .pipe(gulp.dest('assets/css'));
};

var watch_task = function(){
	return watch('assets/sass/**/*.scss', sass_task);
};

gulp.task('watch', watch_task );
gulp.task('sass', sass_task );
gulp.task('build', sass_task );
gulp.task('default', ['sass', 'watch']);
