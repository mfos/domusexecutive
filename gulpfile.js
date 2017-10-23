var 
	config = {
		url: 'brandricksearch.local.mfos.co.uk',
		themeName: 'brandricksearch',
		autoprefixer: ['last 2 versions', 'IE 9']
	},


    browserSync     	= require('browser-sync'),
    gulp 		    	= require('gulp'),
    del             	= require('del'),
    combineMq 			= require('gulp-combine-mq'),
    plugins         	= require('gulp-load-plugins')(),
    mainBowerFiles  	= require('main-bower-files'),
    gulpMainBowerFiles  = require('gulp-main-bower-files'),
    composer 			= require('gulp-composer'),
    runSequence 		= require('run-sequence'),
    bower 				= require('gulp-bower'),
    imagemin 			= require('gulp-imagemin'),
    pngquant 			= require('imagemin-pngquant'),
    browserSync 		= require('browser-sync'),
	gutil 				= require('gulp-util'),
    reload 				= browserSync.reload,
    buildVersion = 'v2',

    base = '',
     
	core = 'public_html/core',
	
    themeRoot = 'public_html/app/themes/' + config.themeName,  
    
    themeDevelopment = 'public_html/app/themes/' + config.themeName + '/development',

	

    paths = {  
	    	dev: {
		    	dir: themeDevelopment,
		    },   
            styles: {
                src: themeDevelopment + '/sass/**/*.scss',
                dest: themeRoot + '/css',
            },
            scripts: {
                root: themeDevelopment + '/js',
                src: themeDevelopment + '/js/*.js',
                srccombined: themeDevelopment + '/js/combined/**/*.js',
                dest: themeRoot + '/js',
            },
            svgIcons: {
    			src: themeDevelopment + '/images/svg-icon-sprite/icons/*',
    			dest:themeRoot + '/images',
    		},
            images: {
                src: themeDevelopment + '/images',
                dest: themeRoot + '/images',
                icon: themeDevelopment + '/meta/mfos-meta-icon.png',
            }    
    };



// Lets clean up first, just theme build files
gulp.task('clean', function(cb) {
	return del([
			paths.styles.dest, 
			paths.scripts.dest,
			paths.images.dest,
			themeDevelopment + '/sass/_sprite.scss'
			]).then(paths => {
				console.log('## Deleted files and folders: ##\n', paths.join('\n'));
			});
});

/*
* Image optimisation
*/
gulp.task('images', function () {
    return gulp.src(paths.images.src + '/imgs/*.{jpg,png,svg}')
    	.pipe(plugins.changed(paths.images.dest))
		.pipe(
			imagemin( {
				progressive: true,
				interlaced: true,
				optimizationLevel: 7,
				use: [pngquant({ quality: '65-80'})]
			})
        )
        .pipe(gulp.dest(paths.images.dest));
});


/*
* Styles
*/

gulp.task('styles', function() {
	return gulp
		.src(paths.styles.src)
		.pipe(plugins.changed(paths.styles.dest))
		.pipe(plugins.sourcemaps.init())
		.pipe(
			plugins.sass({
				errLogToConsole: true,
				outputStyle: 'nested'
			})
				.on('error', plugins.notify.onError({
					title: 'Sass Error',
					subtitle: '<%= error.relativePath %>:<%= error.line %>',
					message: '<%= error.messageOriginal %>',
					open: 'file://<%= error.file %>',
					onLast: true,
					icon: paths.images.icon
				}))
		)
		.pipe(plugins.cleanCss({ restructuring: false }))
		.pipe(plugins.autoprefixer({ browsers: config.autoprefixer, cascade: false }))
		.pipe(plugins.rename('style.min.css'))
		.pipe(plugins.sourcemaps.write('.'))
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(reload({ stream: true }));
});




/*
* Scripts
*/
gulp.task('scripts.single', function() {
	return gulp
		.src(paths.scripts.src)
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.changed(paths.scripts.dest))
		.pipe(plugins.uglify())
		.pipe(plugins.rename({
			suffix: ".min" 
			}))
		.pipe(plugins.sourcemaps.write('.'))
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(reload({ stream: true }));
});


/*
* Scripts
*/
gulp.task('scripts.all', function() {
	return gulp
		.src([
    		paths.scripts.dircombined + '/ScrollMagic.js',
    		paths.scripts.dircombined + '/animation.gsap.js',
			paths.scripts.dircombined + '/jquery.easing.1.3.js',
			paths.scripts.dircombined + '/jquery.easing.compatibility.js',
			paths.scripts.dircombined + '/global.js'
			
		])
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.concat('scripts.js'))
		.pipe(plugins.changed(paths.scripts.dest))
		.pipe(plugins.uglify())
		.pipe(plugins.rename('scripts.min.js'))
		.pipe(plugins.sourcemaps.write('.'))
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(reload({ stream: true }));
});


gulp.task('scripts', ['scripts.all'], function() {
	gulp.start('scripts.all', 'scripts.single');
});

/*
* SVG Sprites
*/

gulp.task('svg-icon-sprite', function () {

     gulp
        .src(paths.svgIcons.src)
        .pipe(plugins.svgSprite({
            mode: {
                css: {
                    spacing: {
                        padding: 5
                    },
                    dest: themeRoot + '/css',
                    layout: 'diagonal',
                    bust: false,
                    sprite: '../images/sprite.svg',
                    render: {
                        scss: {
                            dest:  '../development/sass/_sprite.scss'
                        }
                        
                    }
                }
            },
            svg: {
				xmlDeclaration: false,
				doctypeDeclaration: false
			}
        }))
        .pipe(gulp.dest(base));
 
});

// Composer install
gulp.task("composer", function () {
    composer();
});
// Composer update
gulp.task("composerupdate", function () {
    composer("update");
});

// Bower install
gulp.task("bower", function () {
    bower();
});


//Moves files from bower.json to project
/*
gulp.task('bowerfiles', function() {
   return gulp.src(mainBowerFiles({
		    paths: {
		        bowerDirectory: 'bower_components',
		        bowerJson: 'bower.json'
		   		}
		   	})
		)
       .pipe(gulp.dest(paths.dev.dir + '/vendor'));
});
*/

/*
* Initial setup task, installs bower and composer
*/
gulp.task('setup', function() {
    runSequence('composer', 'bower');    
});
/*
* Theme build task
*/
gulp.task('themebuild', function(done) {
    runSequence('svg-icon-sprite', 'styles', 'scripts', 'images', function() {
        done();
    });
 
});


// SERVE
// browser-sync task for starting the server.
gulp.task('serve', ['watch'], function () {
  // watch files
  var files = [
		paths.styles.src,
		paths.scripts.srcroot + '/**/*.js',
		paths.images.dest,
		themeRoot + '/*.php'
  ]

  // initialize browsersync
  browserSync.init(
  files, {
    // browsersync with a php server
    proxy: config.url,
	//port: 5757,
    notify: false
    
  })
})


/*
* This task will watch our SCSS, JS and Image files and compile
*/
gulp.task('watch', ['themebuild'],  function() {
	
	gutil.log(gutil.colors.black.bgGreen(' READY! -- Watching files -- '))
	gulp.watch(paths.images.src + '/imgs/*', ['images']);
	gulp.watch(paths.styles.src, ['styles']);
	gulp.watch(paths.scripts.src, ['scripts']);
	gulp.watch(paths.scripts.srccombined, ['scripts.all']);
	gulp.watch(paths.svgIcons.src, ['svg-icon-sprite']);        
});

/*
* Default task, will simply output the tasks that are available
*/
gulp.task('default', ['serve']);