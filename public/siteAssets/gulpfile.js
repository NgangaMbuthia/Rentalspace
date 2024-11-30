var gulp = require('gulp'),
	 sass = require('gulp-sass'),
	 uglify = require('gulp-uglify'),
	 concat = require('gulp-concat'),
	 concatCss= require('gulp-concat-css'),
	 rename = require('gulp-rename'),
	 autoprefixer = require('gulp-autoprefixer'),
	 minify = require('gulp-minify-css');

var autoprefixerOptions = {
  browsers: ['last 2 version', 'safari 5', 'ie6', 'ie7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
};
var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'expanded'
};

function swallowError (error) {

  // If you want details of the error in the console
  console.log(error.toString())

  this.emit('end')
}


gulp.task('sass',function(){
	return gulp.src('./components/sass/*.scss')
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(minify())
    .pipe(concat('base.min.css'))
    .pipe(rename('base.min.css'))
    .pipe(gulp.dest('./css'))

})


gulp.task('uglify',function(){
	gulp.src('./components/js/*.js')
	.pipe(concat('base.min.js'))
	.on('error',swallowError)
	.pipe(uglify())
	.pipe(gulp.dest('./js'))
   
    .on('error',swallowError)
    .pipe(rename('base.min.js'))
	.pipe(gulp.dest('./js'))
})



gulp.task('watch',function(){
	gulp.watch('./components/sass/*.scss',['sass'])

	gulp.watch('./components/js/*.js',['uglify'])
	
})
gulp.task('default',['sass','uglify','watch']);