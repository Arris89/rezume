const gulp = require('gulp');
const babel = require('gulp-babel');
const sass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const autoprefixer = require('gulp-autoprefixer');

const paths = {
    scssProd: '../css'
};

gulp.task('js', () =>
    gulp.src('_source/js/**/*.js')
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(gulp.dest('dist/js'))
);

gulp.task('sass', function () {
    return gulp.src('_source/css/*.scss')
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(gulp.dest(paths.scssProd))
});

gulp.task('watch', function () {
    gulp.watch('_source/css/**/*.scss', gulp.series("sass"));
});
