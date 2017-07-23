module.exports = function(grunt) {

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		wiredep: {
			task: {
				ignorePath: '../../../',
				src: ['application/views/mypanel/includes/header.php','application/views/mypanel/includes/footer_js.php']
			}

		},
		bower_concat: {
			all: {
				mainFiles: {
					'bootstrap': ["dist/css/bootstrap.css", "dist/js/bootstrap.js"],
					'bootstrap-table': [ "src/bootstrap-table.js", "src/bootstrap-table.css", "dist/extensions/export/bootstrap-table-export.js", "dist/extensions/mobile/bootstrap-table-mobile.js"],
					'font-awesome': ["css/font-awesome.css"],
					"jquery-slimscroll": ["jquery.slimscroll.js"],
					"formvalidation.io": ["dist/css/formValidation.min.css", "dist/js/formValidation.min.js", "dist/js/framework/bootstrap.min.js"]
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
			targetbootstrap: {
				options: {
					srcPrefix: 'bower_components/bootstrap',
					destPrefix: 'assets/mypanel'
				},
				files: {
					'fonts': 'fonts'
				}
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
		concat: {
			js: {
				options: {
					separator: ';'
				},
				files: {
					'tmp/<%= pkg.name %>.js': ['tmp/digyna-cms_bower.js', 'assets/mypanel/js/*.js', '!assets/mypanel/js/digyna-cms.min.js']
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
			main: {
				options: {
					banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/<%= pkg.name %>.min.js': ['tmp/<%= pkg.name %>.js']
				}
			},
			users: {
				options: {
					banner: '/*! users.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/users.min.js': ['assets/mypanel/js/modules/src/users.js']
				}
			},
			customers: {
				options: {
					banner: '/*! customers.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/customers.min.js': ['assets/mypanel/js/modules/src/customers.js']
				}
			},
			profile: {
				options: {
					banner: '/*! profile.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/profile.min.js': ['assets/mypanel/js/modules/src/profile.js']
				}
			},
			home: {
				options: {
					banner: '/*! home.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/home.min.js': ['assets/mypanel/js/modules/src/home.js']
				}
			},
			banners: {
				options: {
					banner: '/*! banners.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/banners.min.js': ['assets/mypanel/js/modules/src/banners.js']
				}
			},
			config: {
				options: {
					banner: '/*! config.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/config.min.js': ['assets/mypanel/js/modules/src/config.js']
				}
			},
			contacts: {
				options: {
					banner: '/*! contacts.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/contacts.min.js': ['assets/mypanel/js/modules/src/contacts.js']
				}
			},
			people: {
				options: {
					banner: '/*! people.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/people.min.js': ['assets/mypanel/js/modules/src/people.js']
				}
			},
			products: {
				options: {
					banner: '/*! products.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/products.min.js': ['assets/mypanel/js/modules/src/products.js']
				}
			},
			sliders: {
				options: {
					banner: '/*! sliders.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/sliders.min.js': ['assets/mypanel/js/modules/src/sliders.js']
				}
			},
			sales: {
				options: {
					banner: '/*! sales.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/sales.min.js': ['assets/mypanel/js/modules/src/sales.js']
				}
			},
			themes: {
				options: {
					banner: '/*! themes.min.js <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/js/modules/dist/themes.min.js': ['assets/mypanel/js/modules/src/themes.js']
				}
			}
		},
		cssmin: {
			target: {
				files: {
					'assets/mypanel/css/<%= pkg.name %>.min.css': ['tmp/digyna-cms_bower.css', 'assets/mypanel/css/main.css']
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
					ignorePath: '../../../'
				},
				src: ['assets/mypanel/css/*.min.css'],
				dest: 'application/views/mypanel/includes/header.php',
			},
			css_header: {
				options: {
					scriptTemplate: '<rel type="text/css" src="{{ path }}"></rel>',
					openTag: '<!-- start css template tags -->',
					closeTag: '<!-- end css template tags -->',
					ignorePath: '../../../'
				},
				src: ['assets/mypanel/css/*.css','!assets/mypanel/css/login.css','!assets/mypanel/css/digyna-cms.min.css'],
				dest: 'application/views/mypanel/includes/header.php'
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
                    ignorePath: '../../../'
				},
				src: ['assets/mypanel/js/*min.js'],
				dest: 'application/views/mypanel/includes/footer_js.php'
			},
			js_footer: {
				options: {
					scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
					openTag: '<!-- start js template tags -->',
					closeTag: '<!-- end js template tags -->',
					ignorePath: '../../../'
				},
				src: ['assets/mypanel/js/*.js','!assets/mypanel/js/digyna-cms.min.js'],
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
						'main.css': 'assets/mypanel/css/main.css',
						'modal.css': 'assets/mypanel/css/modal.css',
						'digyna-cms.min.js': 'assets/mypanel/js/digyna-cms.min.js',
						'digyna-cms.min.css': 'assets/mypanel/css/digyna-cms.min.css',
						'app.js': 'assets/mypanel/js/app.js',
						'home.min.js': 'assets/mypanel/js/modules/dist/home.min.js',
						'banners.min.js': 'assets/mypanel/js/modules/dist/banners.min.js',
						'config.min.js': 'assets/mypanel/js/modules/dist/config.min.js',
						'contacts.min.js': 'assets/mypanel/js/modules/dist/contacts.min.js',
						'customers.min.js': 'assets/mypanel/js/modules/dist/customers.min.js',
						'people.min.js': 'assets/mypanel/js/modules/dist/people.min.js',
						'products.min.js': 'assets/mypanel/js/modules/dist/products.min.js',
						'profile.min.js': 'assets/mypanel/js/modules/dist/profile.min.js',
						'sales.min.js': 'assets/mypanel/js/modules/dist/sales.min.js',
						'sliders.min.js': 'assets/mypanel/js/modules/dist/sliders.min.js',
						'themes.min.js': 'assets/mypanel/js/modules/dist/themes.min.js',
						'users.min.js': 'assets/mypanel/js/modules/dist/users.min.js'
					} ],
					replacement: 'md5'
				},
				files: {
					src: [
					'application/views/mypanel/includes/header.php',
					'application/views/mypanel/includes/footer_js.php',
					'application/views/mypanel/home.php',
					'application/views/mypanel/adverts/banners/manage.php',
					'application/views/mypanel/adverts/sliders/manage.php',
					'application/views/mypanel/config/manage.php',
					'application/views/mypanel/contacts/manage.php',
					'application/views/mypanel/customers/manage.php',
					'application/views/mypanel/people/manage.php',
					'application/views/mypanel/products/manage.php',
					'application/views/mypanel/profile/manage.php',
					'application/views/mypanel/sales/manage.php',
					'application/views/mypanel/themes/manage.php',
					'application/views/mypanel/users/manage.php'
					]
				}
			}
		}
    });

    require('load-grunt-tasks')(grunt);
    grunt.loadNpmTasks('grunt-mocha-webdriver');
	grunt.loadNpmTasks('grunt-composer');

    grunt.registerTask('default', ['wiredep', 'bower_concat', 'bowercopy', 'concat', 'uglify', 'cssmin', 'tags', 'cachebreaker']);
    grunt.registerTask('packages', ['composer:update']);
    grunt.registerTask('debug', ['tags','cachebreaker']);

};
