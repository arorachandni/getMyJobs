var http = require('http');

var server = http.createServer();
  
var io = require('socket.io').listen(server);

io.on('connection', function(socket){
  socket.on('message', function(msg){
    console.log('message: ' + msg);
  });
});
 
server.listen(8083);