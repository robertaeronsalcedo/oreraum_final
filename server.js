var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var port = process.env.PORT || 3000;

io.on('connection', function (socket) {
	console.log("Connected!");

	socket.on('chat', function(data){
		io.emit('chat', data);
	});

	socket.on('notification', function(data){
		io.emit('notification', data);
	});

	socket.on('disconnect', function () {
		io.emit('user disconnected');
	});

	
});