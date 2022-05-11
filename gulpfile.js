var gulp = require('gulp')
var $ = require ('gulp-load-plugins')();

gulp.task('svg', function () {
	return gulp.src('./public/img/svg/svg-header-nav/*.svg')
	.pipe($.plumber())
	.pipe($.svgSprite({
		mode: {	
		symbol: {
			dest: './public/img/svg/svg-header-nav',
			sprite: 'sprite.svg'
}}}))
.pipe(gulp.dest('./'));
})		
