// note, io(<port>) will create a http server for you
var port = process.env.PORT || 3000;
var io = require('socket.io')(port);

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