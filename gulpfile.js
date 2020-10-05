var config = {
  styleSRC: './assets/scss/**/*.scss',
  styleDestination: './assets/css/',
  outputStyle: 'compact',
  errLogToConsole: true,
  precision: 10,

  watchStyles: './assets/scss/**/*.scss'
};

const gulp = require( 'gulp' ); // Gulp of-course.

// CSS related plugins.
const sass = require( 'gulp-sass' ); // Gulp plugin for Sass compilation.
const minifycss = require( 'gulp-uglifycss' ); // Minifies CSS files.
const autoprefixer = require( 'gulp-autoprefixer' ); // Autoprefixing magic.
const mmq = require( 'gulp-merge-media-queries' ); // Combine matching media queries into one.
const rtlcss = require( 'gulp-rtlcss' ); // Generates RTL stylesheet.

// Utility related plugins.
const rename = require( 'gulp-rename' ); // Renames files E.g. style.css -> style.min.css.
const lineec = require( 'gulp-line-ending-corrector' ); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings).
const filter = require( 'gulp-filter' ); // Enables you to work on a subset of the original files by filtering them using a glob.
const sourcemaps = require( 'gulp-sourcemaps' ); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css).
const notify = require( 'gulp-notify' ); // Sends message notification to you.
const browserSync = require( 'browser-sync' ).create(); // Reloads browser and injects CSS. Time-saving synchronized browser testing.
const wpPot = require( 'gulp-wp-pot' ); // For generating the .pot file.
const sort = require( 'gulp-sort' ); // Recommended to prevent unnecessary changes in pot-file.
const cache = require( 'gulp-cache' ); // Cache files in stream for later use.
const remember = require( 'gulp-remember' ); //  Adds all the files it has ever seen back into the stream.
const plumber = require( 'gulp-plumber' ); // Prevent pipe breaking caused by errors from gulp plugins.
const beep = require( 'beepbeep' );
/**
 * Custom Error Handler.
 *
 * @param Mixed err
 */
const errorHandler = r => {
  notify.onError( '\n\n❌  ===> ERROR: <%= error.message %>\n' )( r );
  beep();

  // this.emit('end');
};

/**
 * Task: `browser-sync`.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 * @link http://www.browsersync.io/docs/options/
 *
 * @param {Mixed} done Done.
 */
const browsersync = done => {
  browserSync.init({
    proxy: 'http://mu.bipu.me',
    open: true,
    injectChanges: true,
    watchEvents: [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ]
  });
  done();
};

// Helper function to allow browser reload with Gulp 4.
const reload = done => {
  browserSync.reload();
  done();
};

gulp.task( 'styles', () => {
  return gulp
    .src( config.styleSRC, { allowEmpty: true })
    .pipe( plumber( errorHandler ) )
    .pipe( sourcemaps.init() )
    .pipe(
      sass({
        errLogToConsole: config.errLogToConsole,
        outputStyle: config.outputStyle,
        precision: config.precision
      })
    )
    .on( 'error', sass.logError )
    .pipe( sourcemaps.write({ includeContent: false }) )
    .pipe( sourcemaps.init({ loadMaps: true }) )
    .pipe( autoprefixer( config.BROWSERS_LIST ) )
    .pipe( sourcemaps.write( './' ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( config.styleDestination ) )
    .pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
    .pipe( mmq({ log: true }) ) // Merge Media Queries only for .min.css version.
    .pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
    .pipe( rename({ suffix: '.min' }) )
    .pipe( minifycss({ maxLineLen: 10 }) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( config.styleDestination ) )
    .pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
    .pipe( browserSync.stream() ) // Reloads style.min.css if that is enqueued.
    .pipe( notify({ message: '\n\n✅  ===> STYLES — completed!\n', onLast: true }) );
});

gulp.task(
  'default',
  gulp.parallel( 'styles', browsersync, () => {
    // gulp.watch( config.watchPhp, reload ); // Reload on PHP file changes.
    gulp.watch( config.watchStyles, gulp.parallel( 'styles' ) ); // Reload on SCSS file changes.
  })
);