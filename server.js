// note, io(<port>) will create a http server for you
var io = require('socket.io')(3000);

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