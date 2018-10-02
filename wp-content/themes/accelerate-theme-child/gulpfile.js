// include gulp
var gulp = require('gulp'); 

// include plug-ins
var jshint = require('gulp-jshint'),
browserSync = require('browser-sync'),
imagemin = require('gulp-imagemin'),
postcss = require('gulp-postcss'),
cssnano = require('gulp-cssnano'),
autoprefixer = require('gulp-autoprefixer'),
csslint = require('gulp-csslint');

// JS hint task
gulp.task('scripts', function() {
  gulp.src('./js/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

// Image compression
gulp.task('images', function() {
    var imgSrc = 'img/source/*';
    var imgDest = 'img';

  return gulp.src(imgSrc)
    .pipe(imagemin())
    .pipe(gulp.dest(imgDest))
  });
  
  // Browser Sync
  var browserSync = require('browser-sync');
  // var reload      = browserSync.reload;

  // browser-sync task for starting the server.
  gulp.task('browser-sync', function() {
      // watch files
      var files = [
      './style.css',
      './css/*.css',
      './*.php',
      './template_files/*.php',
      './inc/*.php',
      './js/*.js'
      ];

      // initialize browsersync
      browserSync.init(files, {
        // browsersync with a php server
        proxy: "localhost:8888/accelerate/",
        notify: false
      })
      gulp.watch(files, function(){
        browserSync.reload();
      })
    });
    
    gulp.task('styles', function(){
    /* the 'return' is necessary to respect the asynchronous nature of postcss*/
    gulp.src('./style.css')
    // .pipe(csslint())
    // .pipe(csslint.formatter())
    .pipe(autoprefixer({
      browsers: ['last 3 versions'],
      cascade: false
    }))
     //.pipe(gulp.dest('./css/'))
  });

  // gulp.task('minifyStyles', function(){
  //     gulp.src('./css/style.css')
  //     .pipe(cssnano({
  //       zindex: false
  //     }))
  //     .pipe(gulp.dest('./css/min/'))
  //   })
  
  // do ALL THE THINGS
gulp.task('default', ['scripts', 'styles', 'browser-sync'], function() {

  // watch for JS changes
  gulp.watch('./js/*.js', ['scripts']);
  
  // watch for CSS changes
  gulp.watch('./style.css', ['styles']);
    
});
  
  // Minifying images here and putting them in img folder - should add autoprefixer here
  gulp.task('build', ['images']);
