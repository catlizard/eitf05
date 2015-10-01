module.exports = function(grunt) {
    'use strict';

    // Force use of Unix newlines
    grunt.util.linefeed = '\n';

    RegExp.quote = function(string) {
        return string.replace(/[-\\^$*+?.()|[\]{}]/g, '\\$&');
    };

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'js/*.js'
            ]
        },
        less: {
            assets: {
                options: {
                    strictMath: true,
                    sourceMap: true,
                    compress: false,
                    cleancss: true,
                    outputSourceFiles: true
                },
                files: {
                    'assets/css/style.min.css': 'assets/less/style.less',
                }
            }
        },
        watch: {
            less: {
                files: [
                    'assets/less/style.less',
                ],
                tasks: ['less']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    'assets/css/style.min.css',
                ]
            }
        },
        clean: {
            dist: [
                'assets/css/style.min.css',
            ]
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-banner');

    grunt.registerTask('default', [
        'clean',
        'less',
    ]);

    grunt.registerTask('dev', [
        'watch'
    ]);
};