module.exports = function(grunt) {
    grunt.initConfig({
      uglify: {
        my_target: {
          files: {
            'amd/build/mitschat.min.js' : ['amd/src/mitschat.js']
          }
        }
      }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify'); // load the given tasks
    grunt.registerTask('default', ['uglify:my_target']); // Default grunt tasks maps to grunt
};