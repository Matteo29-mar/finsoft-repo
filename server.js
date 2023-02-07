const http = require('http');
const hostname = 'localhost';

const port = 5001

const server = http.createServer((req, res) => {
if(req.url === '/' && req.method === 'GET'){
res.statusCode = 200;

res.setHeader('Content-Type', 'text/plain');

res.end('questa e una semplice web app di matteo');
}else{
    res.statusCode = 404;
    res.end();
}


});

server.listen(port, hostname, () => {

console.log(`Server running at http://${hostname}:${port}/`);

})
