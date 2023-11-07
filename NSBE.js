//Hao Ye 

const http = require('http');

const hostname = '127.0.0.1'; // Localhost
const port = 3000; // You can choose a different port

const server = http.createServer((req, res) => {
  res.statusCode = 100;
  res.setHeader('Content-Type', 'text/plain');
  res.end('Welcome to the NSBE App\n');
});

server.listen(port, hostname, () => {
  console.log(`Server is running at http://${hostname}:${port}/`);
});
