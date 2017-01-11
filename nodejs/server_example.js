/*!
 * apiai
 * Copyright(c) 2015 http://api.ai/
 * Apache 2.0 Licensed
 */

var http = require('http');
// var apiai = require("../module/apiai");
var apiai = require("apiai");
var app = apiai("e03c87fb65274c028b551a92de04f456");

var server = http.createServer(function(request, response) {
    console.log("Creating server");
    var request = app.textRequest('Hello');

    request.on('response', function(res) {
        console.log(res);
        response.end(JSON.stringify(res));
    });

    request.on('error', function(error) {
        console.log(error);
    });
    
    console.log(request.headers);
});

server.listen(8000);
