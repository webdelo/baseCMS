module.exports = function(grunt) {

    grunt.initConfig({
        concat: {
            dist: {
                src: ['js/*js'],
                dest: 'dist/js/all.js'
            }
        },
        uglify: {
            options: {
                banner: '/* Created by RainXC */'
            },
            dist: {
                files: {
                    'dist/js/all.min.js': ['dist/js/all.js']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-newer');

    grunt.registerTask('default', ['concat', 'uglify'])
};