var gulp = require('gulp')
var $ = require ('gulp-load-plugins')();

gulp.task('svg', function () {
	return gulp.src('./public/img/svg/*.svg')
	.pipe($.plumber())
	.pipe($.svgSprite({
		mode: {	
		symbol: {
			dest: './public/img/svg/',
			sprite: 'sprite.svg'
}}}))
.pipe(gulp.dest('./'));
})		
