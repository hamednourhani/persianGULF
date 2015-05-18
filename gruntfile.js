module.exports = function(grunt) {
	
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-curl');
    grunt.loadNpmTasks('grunt-phpdocumentor');
    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
			

		makepot: {
	        target: {
	            options: {
	                cwd: '',
	                domainPath: '/languages',
	                mainFile: 'index.php',
	                potFilename: 'persianGULF.pot',
	                processPot: function( pot, options ) {
	                    pot.headers['report-msgid-bugs-to'] = 'http://itstar.ir/contact-us';
	                    pot.headers['language-team'] = 'iTstar <info@itstar.ir>';
	                    return pot;
	                },
	                type: 'wp-theme'
	            }
	        }
	    },//makepot


		jshint: {
		    files: [
		        'assets/js/components/*.js'
		        
		    ],//files
		    options: {
		        expr: true,
		        globals: {
		            jQuery: true,
		            console: true,
		            module: true,
		            document: true
		        }
		    }//options
		},//jshint

		uglify: {
		    dist: {
		        options: {
		            banner: '/*! <%= pkg.name %> <%= pkg.version %> scripts.min.js <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
		            report: 'gzip'
		        },//options
		        files: {
		            'assets/js/apps.min.js' : [
		                'assets/js/components/*.js'
		             ]
		        }//files
		    },//dist
		    dev: {
		        options: {
		            banner: '/*! <%= pkg.name %> <%= pkg.version %> scripts.js <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
		            beautify: true,
		            compress: false,
		            mangle: false
		        },//options
		        files: {
		            'assets/js/apps.js' : [
		                'assets/js/components/*.js'
		            ]
		        }//files
		    }//dev
		},//uglify
		
		compass: {
		   dist: {
		        options: {
		            //banner: '/*! <%= pkg.name %> <%= pkg.version %> style.min.css <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
		          	environment: 'production',
		           config : 'config.rb'
		              	
		        }
		        
		    },//dist
		    dev: {
		        options: {
		           //banner: '/*! <%= pkg.name %> <%= pkg.version %> style.css <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
		           config : 'config.rb'
		          
		        }
		    }//dev
		},//compass

		copy: {
		     
	      css: {
	        files: [
	          {
	            expand: true, 
	            cwd: 'assets/css/temp/', 
	            src: ['*.css'], 
	            dest: 'assets/css', 
	            rename: function(dest, src) {
	              return dest +'/'+ src.substring(0, src.indexOf('.')) + '.min.css';
	            }
	          }]
	      },
		   readme: {
		        src: 'readme.txt',
		        dest: 'README.md'
		    }//dist
		},//copy

		
		clean: {
		  build: {
		    src: ["assets/css/temp/**/*.css"]
		  }
		},//clean

		curl: {
		    'google-fonts-source': {
		        src: 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBSO5nOEdE6OwYNtLBVDdVO1jsy9Or5wHQ',
		        dest: 'assets/fonts/vendor/google-fonts-source.json'
		    }
		},//cUrl
		
		
	    phpdocumentor: {
	        dist: {
	            options: {
	                ignore: ['node_modules'],
	                directory : 'dist',
	                target : 'docs'
	            }
	        }
	    },//phpdocumentor


		img: {
         
	        // recursive extension filter with output path 
	        task1: {
	            src: ['assets/images/**/*.png','images/**/*.jpg'],
	            dest: 'assets/images/opt'
	        }//task1
	 
	    },//img


		watch: {
			options : { livereload : true },
      		scripts :{
      			files: ['assets/js/components/*.js'],
      			tasks: ['jshint','uglify:dev','uglify:dist']
    		},//scripts
    		html : {
    			files : ['*.html'],
    			options: {
			        // Start a live reload server on the default port 35729
			        livereload: true,
			      },
    		},//html
    		sass : {
    			files : ['assets/css/sass/**/*.scss'],
    			tasks : ['compass:dev','compass:dist','copy:css','clean']
    		},
    		php : {
    			files : ['**/*.php'],
    			tasks : ['makepot']
    		},
    		readme: {
    			files : ['readme.txt'],
    			tasks : ['copy:readme']
    		}
    	}//watch
  
		
	});
	
	grunt.registerTask('default', 'watch');
}