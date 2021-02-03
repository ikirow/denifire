let gulp = require("gulp"),
	sass = require("gulp-sass"),
	postcss = require("gulp-postcss"),
	autoprefixer = require("autoprefixer"),
	sourcemaps = require("gulp-sourcemaps"),
	notify = require( "gulp-notify" ),
	browserSync = require("browser-sync").create();
const { series } = require('gulp');


let path = {
	SCSS_SRC: 'assets/sass/site.scss',
	SCSS_RTL_SRC: 'assets/sass/rtl.scss',
	SCSS_WOO_SRC: 'assets/sass/woocommerce.scss',
	SCSS_ADMIN_SRC: 'assets/sass/site-admin.scss',
	SCSS_WATCH: 'assets/sass/**/*.scss',
	SCSS_DST: 'assets/css',

	SCSS_BLOCK_SRC: 'template-parts/blocks/scss/*.scss',
	SCSS_BLOCK_DST: 'template-parts/blocks/css',
	SCSS_BLOCK_WATCH: 'template-parts/blocks/scss/*.scss',

	JS_SRC: 'assets/js/app.js',
	JS_WATCH: 'assets/js/*.js',
	JS_DST: 'assets/js/'

};

// Compilation of main SCSS files
function scss() {
	return (
		gulp
			.src([
				path.SCSS_SRC,
				//path.SCSS_RTL_SRC, // Enable for RTL Support
				path.SCSS_WOO_SRC, // Enable for Woo Support
				path.SCSS_ADMIN_SRC])
			.pipe(sourcemaps.init())
			.pipe(sass())
			.on("error", sass.logError)
			.pipe(postcss([autoprefixer()]))
			.pipe(sourcemaps.write())
			.pipe(gulp.dest(path.SCSS_DST))
			// Add browsersync stream pipe after compilation
			.pipe(browserSync.stream())
			.pipe( notify( "SASS compiled successfully" ) )
	);
}
exports.scss = scss;


// Compilation of ACF Guten Blocks SCSS files
function blockScss() {
	return (
		gulp
			.src(path.SCSS_BLOCK_SRC)
			.pipe(sourcemaps.init())
			.pipe(sass())
			.on("error", sass.logError)
			.pipe(postcss([autoprefixer()]))
			.pipe(sourcemaps.write())
			.pipe(gulp.dest(path.SCSS_BLOCK_DST))
			// Add browsersync stream pipe after compilation
			.pipe(browserSync.stream())
			.pipe( notify( "SASS compiled successfully" ) )
	);
}
exports.blockScss = blockScss;


//Browser Sync
function reload() {
	browserSync.reload();
}
function watch() {
	browserSync.init({
		proxy: 'http://denifire.test/',
	});
	gulp.watch(path.SCSS_WATCH, scss);
	gulp.watch(path.SCSS_BLOCK_WATCH, blockScss);

	gulp.watch('**/*.php').on('change', reload);
}
exports.watch = watch;



exports.build = series(scss, blockScss);