var gulp = require('gulp'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    rename = require('gulp-rename'),

    inputSass = './scss/style.scss',
    allSassModules = ['./scss/**/*', inputSass],
    outputSass = './css/';

    sassOptions = {
        errLogToConsole: true,
        outputStyle: 'compressed'
    },

//************** GULP TASKS **************//
gulp.task('scss', function() {
    return gulp
        .src(inputSass)
        .pipe(sourcemaps.init())
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(outputSass));
});

//************** GULP WATCH **************//
gulp.task('default',function() {
    gulp.watch(allSassModules,['scss']);
});
