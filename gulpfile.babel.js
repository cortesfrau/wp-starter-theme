//---------------//
//--- Imports ---//
//---------------//
import {src, dest, watch, series, parallel} from 'gulp';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import named from 'vinyl-named';
import webpack from 'webpack-stream';
import del from 'del';
import yargs from 'yargs';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const gulpSquoosh = require("gulp-squoosh");
const gulpHashFilename = require('gulp-hash-filename');
const sass = gulpSass(dartSass);
const PRODUCTION = yargs.argv.prod;


//-------------//
//--- Tasks ---//
//-------------//

// Styles Task
export const styles = () => {
  return src(['src/scss/bundle.scss'])
    .pipe(gulpif(PRODUCTION, gulpHashFilename({format: '{name}.{hash}{ext}'})))
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest('dist/css'));
}

// Admin Styles Task
export const adminStyles = () => {
  return src(['src/scss/admin.scss'])
    .pipe(gulpif(PRODUCTION, gulpHashFilename({format: '{name}.{hash}{ext}'})))
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest('dist/css'));
}

// Images Task
export const img = () => {
  return src('src/img/**/*.{jpg,jpeg,png}')
    .pipe(gulpif(PRODUCTION, gulpSquoosh({
      encodeOptions: {
        mozjpeg: {
          quality: 50
        },
        oxipng: {}
      }
    })))
    .pipe(dest('dist/img'));
}

// SVG Task
export const svg = () => {
  return src('src/img/**/*.svg')
    .pipe(dest('dist/img'));
}

// GIF Task
export const gif = () => {
  return src('src/img/**/*.gif')
    .pipe(dest('dist/img'));
}

// Copy Task
export const copy = () => {
  return src(['src/**/*','!src/{img,js,scss}','!src/{img,js,scss}/**/*'])
    .pipe(dest('dist'));
}

// Fonts Task
export const fonts = () => {
  return src('src/fonts/*')
    .pipe(dest('dist/fonts'))
}

// FontAwesome
export const fontAwesome = () => {
  return src('node_modules/@fortawesome/fontawesome-free/webfonts/*')
    .pipe(dest('dist/fonts/fontawesome'))
}

// Clean Task
export const clean = () => del(['dist']);

// Scripts Task
export const scripts = () => {
  return src(['src/js/bundle.js'])
    .pipe(named())
    .pipe(webpack({
      module: {
        rules: [
          {
            test: /\.js$/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: []
              }
            }
          }
        ]
      },
      mode: PRODUCTION ? 'production' : 'development',
      devtool: !PRODUCTION ? 'inline-source-map' : false,
      output: {
        filename: PRODUCTION ? '[name].[contenthash].js' : '[name].js',
      },
      externals: {
        jquery: 'jQuery'
      },
    }))
    .pipe(dest('dist/js'));
}

// Watch Task
export const watchForChanges = () => {
  watch('src/scss/**/*.scss', styles);
  watch('src/scss/admin.scss', adminStyles);
  watch('src/img/**/*.{jpg,jpeg,png,gif}', img);
  watch('src/img/**/*.{svg}', svg);
  watch(['src/**/*','!src/{img,js,scss}','!src/{img,js,scss}/**/*'], copy);
  watch('src/js/**/*.js', scripts);
  watch('src/docs/**/*', copy);
}

// Dev & Build Tasks
export const dev = series(clean, img, parallel(styles, adminStyles, fontAwesome, fonts, svg, gif, copy, scripts), watchForChanges);
export const build = series(clean, img, parallel(styles, adminStyles, fontAwesome, fonts, svg, gif, copy, scripts));
