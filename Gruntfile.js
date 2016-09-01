module.exports = function(grunt){

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		uglify: {
			options:{
				mangle: false
			},
			my_target: {
				files: [{
					expand: true,
					cwd: 'public/custom/js/',
					src: '**/*.js',
					dest: 'public/final/js/',
					ext: '.min.js'
				}]
			}
		},

		less: {
			development: {
				options:{
					paths: ['public/custom/less/']
				},
				files: {
					"public/custom/css/estilo.css": "public/custom/less/estilo.less",
					"public/custom/css/estiloAdm.css": "public/custom/less/estiloAdm.less"
				}
			}
		},

		cssmin: {
			minify: {
				expand: true,
				cwd: 'public/custom/css/',
				src: ['*.css'],
				dest: 'public/final/css/',
				ext: '.min.css'
			}
		},

		concat: {
			basic: {
				src: ['public/final/css/*.min.css', '!public/final/css/estiloAdm.min.css', '!public/final/css/bootstrap-theme.min.css', '!public/final/css/bootstrap.min.css','!public/final/css/dataTables.bootstrap.min.css','!public/final/css/jquery.dataTables.min.css'],
				dest: 'public/final/css/final.css'
			}
		},

		// imagemin:{
		// 	png:{
		// 		options:{
		// 			optmizationLevel: 7
		// 		},
		// 		files: [{
		// 			expand: true,
		// 			cwd: 'public/custom/img/',
		// 			src: ['**/*.png'],
		// 			dest: 'public/final/img/'
		// 		}]
		// 	},
		// 	jpg:{
		// 		options:{
		// 			progressive: true
		// 		},
		// 		files: [{
		// 			expand: true,
		// 			cwd: 'public/custom/img/',
		// 			src: ['**/*.jpg'],
		// 			dest: 'public/final/img/'
		// 		}]
		// 	}
		// },

		copy: {
			public: {
				expand: true,
				cwd: 'public/final/',
				src: '**',
				dest: 'dist'
			}
		},

		clean: {

			dist: {
				src: 'dist'
			}
		},

		watch : {
	      dist : {
	        files : [
	          'public/custom/less/*.less',
	          'public/custom/css/*.css',
	          'public/custom/js/*.js'
	        ],

	        tasks : ['uglify', 'less', 'cssmin', 'concat', 'clean', 'copy']
	      }
	    }
	});

	//Plugins
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	// grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');

	//Tarefas
	// grunt.registerTask('dist', ['uglify', 'less', 'cssmin', 'concat', 'imagemin', 'clean', 'copy']);
	grunt.registerTask('dist', ['uglify', 'less', 'cssmin', 'concat', 'clean', 'copy']);
	grunt.registerTask('default', ['dist']);
	grunt.registerTask('w', ['watch']);
	
}