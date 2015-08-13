var gulp = require('gulp'),
	concat = require('gulp-concat'),
	jshint = require('gulp-jshint'),
	stylish = require('jshint-stylish'),
	uglify = require('gulp-uglify'); 

var PATHS = {
	JS:{
		SRC:'./src/*.js',
		DIST:'./dist/js/'
	}
};

gulp.task('jshint',function(){
	return gulp.src(PATHS.JS.DIST)
		.pipe(jshint())
		.pipe(jshint.reporter(stylish));
});

gulp.task('compile',['jshint'],function() {
    return gulp.src(PATHS.JS.SRC)
    		   .pipe(concat('lights.js'))
    		   .pipe(gulp.dest(PATHS.JS.DIST))
    		   .pipe(concat('lights.min.js'))    		   
    		   .pipe(uglify())
    		   .pipe(gulp.dest(PATHS.JS.DIST)); 
});

gulp.task('watch',['compile'],function(){
	gulp.watch(PATHS.JS.SRC, ['compile']);
});

gulp.task('default',['watch'],function(){
	
});