module.exports = function(grunt) {

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		wiredep: {
			task: {
				ignorePath: '../../../assets/',
				src: ['application/views/mypanel/includes/header.php']
			}
		},
		bower_concat: {
			all: {
				mainFiles: {
					'bootstrap': ["dist/css/bootstrap.css", "dist/js/bootstrap.js"],
					'bootstrap-table': [ "src/bootstrap-table.js", "src/bootstrap-table.css", "dist/extensions/export/bootstrap-table-export.js", "dist/extensions/mobile/bootstrap-table-mobile.js"],
					'font-awesome': ["css/font-awesome.css"],
					"jquery-slimscroll": ["jquery.slimscroll.js"]
				},
				dest: {
					'js': 'tmp/digyna-cms_bower.js',
					'css': 'tmp/digyna-cms_bower.css'
				}
			}
		},
		bowercopy: {
			options: {
				report: false
			},
			targetionic_icons: {
				options: {
					srcPrefix: 'bower_components/Ionicons',
					destPrefix: 'assets/mypanel'
				},
				files: {
					'fonts': 'fonts'
				}
			},
			targetfont_awesome: {
				options: {
					srcPrefix: 'bower_components/font-awesome',
					destPrefix: 'assets/mypanel'
				},
				files: {
					'fonts': 'fonts'
				}
			}
		},
		cssmin: {
			target: {
				files: {
					'assets/mypanel/css/<%= pkg.name %>.min.css': ['tmp/digyna-cms_bower.css', 'public/css/*.css', '!public/css/login.css', '!public/css/invoice_email.css', '!public/css/barcode_font.css', '!public/css/style.css']
				}
			}
		},
		concat: {
			js: {
				options: {
					separator: ';'
				},
				files: {
					'tmp/<%= pkg.name %>.js': ['tmp/digyna-cms_bower.js', 'assets/mypanel/js/app.js','assets/mypanel/js/manage_tables.js']
				}
			},
			sql: {
				options: {
					banner: '-- >> Este archivo se genera automáticamente desde tables.sql y constraints.sql. No modifique directamente << --'
				},
				files: {
					'database/database.sql': ['database/tables.sql', 'database/constraints.sql']
				}
			}
		},
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
			},
			dist: {
				files: {
					'assets/mypanel/js/<%= pkg.name %>.min.js': ['tmp/<%= pkg.name %>.js']
				}
			}
		},
		jshint: {
			files: ['Gruntfile.js', 'public/js/*.js'],
			options: {
				// options here to override JSHint defaults
				globals: {
					jQuery: true,
					console: true,
					module: true,
					document: true
				}
			}
		},
		tags: {
			mincss_header: {
				options: {
					scriptTemplate: '<rel type="text/css" src="{{ path }}"></rel>',
					openTag: '<!-- start mincss template tags -->',
					closeTag: '<!-- end mincss template tags -->',
					ignorePath: '../../../../'
				},
				src: ['assets/mypanel/css/*.min.css'],
				dest: 'application/views/mypanel/includes/header.php',
			},
			css_header: {
				options: {
					scriptTemplate: '<rel type="text/css" src="{{ path }}"></rel>',
					openTag: '<!-- start css template tags -->',
					closeTag: '<!-- end css template tags -->',
					ignorePath: '../../../../'
				},
				src: ['assets/mypanel/css/main.css'],
				dest: 'application/views/mypanel/includes/header.php',
			},
			css_login: {
				options: {
					scriptTemplate: '<rel type="text/css" src="{{ path }}"></rel>',
					openTag: '<!-- start css template tags -->',
					closeTag: '<!-- end css template tags -->',
                    ignorePath: '../../../'
				},
				src: ['assets/mypanel/css/login.css'],
				dest: 'application/views/mypanel/login.php'
			},
			minjs: {
				options: {
					scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
					openTag: '<!-- start minjs template tags -->',
					closeTag: '<!-- end minjs template tags -->',
                    ignorePath: '../../../../'
				},
				src: ['assets/mypanel/js/*min.js'],
				dest: 'application/views/mypanel/includes/footer_js.php'
			}
		},
		mochaWebdriver: {
			options: {
				timeout: 1000 * 60 * 3
			},
			test : {
				options: {
					usePhantom: true,
					usePromises: true
				},
				src: ['test/**/*.js']
			}
		},
		watch: {
			files: ['<%= jshint.files %>'],
			tasks: ['jshint']
		},
		cachebreaker: {
			dev: {
				options: {
					match: [ {
						'digyna-cms.min.js': 'assets/mypanel/js/digyna-cms.min.js',
						'digyna-cms.min.css': 'assets/mypanel/css/digyna-cms.min.css'
					} ],
					replacement: 'md5'
				},
				files: {
					src: ['application/views/mypanel/includes/header.php', 'application/views/mypanel/includes/footer_js.php']
				}
			}
		}
    });

    require('load-grunt-tasks')(grunt);
    grunt.loadNpmTasks('grunt-mocha-webdriver');
	grunt.loadNpmTasks('grunt-composer');

    grunt.registerTask('default', ['wiredep', 'bower_concat', 'concat', 'uglify', 'cssmin', 'tags', 'cachebreaker']);
    grunt.registerTask('packages', ['composer:update']);

};
