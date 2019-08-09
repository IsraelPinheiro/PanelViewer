"use strict";

// Load plugins
const autoprefixer = require("gulp-autoprefixer");
const browsersync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const del = require("del");
const gulp = require("gulp");
const header = require("gulp-header");
const merge = require("merge-stream");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");

// Load package.json for banner
const pkg = require('./package.json');

// Set the banner content
const banner = ['/*!\n',
  ' * Start Bootstrap - <%= pkg.title %> v<%= pkg.version %> (<%= pkg.homepage %>)\n',
  ' * Copyright 2019-' + (new Date()).getFullYear(), ' <%= pkg.author %>\n',
  ' * Licensed under <%= pkg.license %> (https://github.com/BlackrockDigital/<%= pkg.name %>/blob/master/LICENSE)\n',
  ' */\n',
  '\n'
].join('');

// BrowserSync
function browserSync(done){
    browsersync.init({
        server: {
            baseDir: "./"
        },
        port: 8000
    });
    done();
}
// BrowserSync reload
function browserSyncReload(done){
    browsersync.reload();
    done();
}

// Clean bin
function clean(){
    return del(["./bin/"]);
}

// Bring third party dependencies from node_modules into bin directory
function modules(){
    //Bootstrap JS
    var bootstrapJS = gulp.src('./node_modules/bootstrap/dist/js/*')
        .pipe(gulp.dest('./bin/bootstrap/js'));
    //Popper.js
    var popperJS = gulp.src('./node_modules/popper.js/dist/umd/*')
        .pipe(gulp.dest('./bin/popper.js'));
    //jQuery Mask Plugin
    var jQueryMaskPlugin = gulp.src('./node_modules/jquery-mask-plugin/src/*')
        .pipe(gulp.dest('./bin/jquery-mask-plugin'));
    //Font Awesome CSS
    var fontAwesomeCSS = gulp.src('./node_modules/@fortawesome/fontawesome-free/css/**/*')
        .pipe(gulp.dest('./bin/fontawesome-free/css'));
    //Font Awesome Webfonts
    var fontAwesomeWebfonts = gulp.src('./node_modules/@fortawesome/fontawesome-free/webfonts/**/*')
        .pipe(gulp.dest('./bin/fontawesome-free/webfonts'));
    //jQuery
    var jquery = gulp.src([
        './node_modules/jquery/dist/*',
        '!./node_modules/jquery/dist/core.js'
    ]).pipe(gulp.dest('./bin/jquery'));
    return merge(bootstrapJS, jQueryMaskPlugin, fontAwesomeCSS, fontAwesomeWebfonts,popperJS, jquery);
}

// CSS task
function css() {
  return gulp
    .src("./scss/**/*.scss")
    .pipe(plumber())
    .pipe(sass({
      outputStyle: "expanded",
      includePaths: "./node_modules",
    }))
    .on("error", sass.logError)
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(header(banner, {
      pkg: pkg
    }))
    .pipe(gulp.dest("./css"))
    .pipe(rename({
      suffix: ".min"
    }))
    .pipe(cleanCSS())
    .pipe(gulp.dest("./css"))
    .pipe(browsersync.stream());
}

// JS task
function js() {
    return gulp
    .src([
        './js/*.js',
        '!./js/*.min.js'
    ])
    .pipe(uglify())
    .pipe(header(banner, {
        pkg: pkg
    }))
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest('./js'))
    .pipe(browsersync.stream());
}

// Watch files
function watchFiles() {
    gulp.watch("./scss/**/*", css);
    gulp.watch(["./js/**/*", "!./js/**/*.min.js"], js);
    gulp.watch("./**/*.html", browserSyncReload);
}

// Define complex tasks
const bin = gulp.series(clean, modules);
const build = gulp.series(bin, gulp.parallel(css, js));
const watch = gulp.series(build, gulp.parallel(watchFiles, browserSync));

// Export tasks
exports.css = css;
exports.js = js;
exports.clean = clean;
exports.bin = bin;
exports.build = build;
exports.watch = watch;
exports.default = build;
