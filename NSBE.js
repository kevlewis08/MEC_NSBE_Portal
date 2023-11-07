//Hao Ye 

const http = require('http');

const hostname = '127.0.0.1'; // Localhost
const port = 3000; // You can choose a different port

const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/html');

  // Define routes and responses
  if (req. url === '/') {
    res.end('Welcome to the NSBE App!<br><a href="/meetings">Chapter Meetings</a><br><a href="/events">Events</a><br><a href="/membership">Membership</a>');
  } else if (req.url === '/meetings') {
    res.end('Chapter Meetings Page - Add content and links to specific meetings here.');
  } else if (req.url === '/events') {
    res.end('Events Page - Add content and links to specific events here.');
  } else if (req.url === '/membership') {
    res.end('Membership Page - Add information and registration links here.');
  } else {
    res.statusCode = 404; // Not Found
    res.end('Page not found.');
  }
});

server.listen(port, hostname, () => {
  console.log(`Server is running at http://${hostname}:${port}/`);
});

