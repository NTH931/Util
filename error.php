<?php 
$response = $_GET["code"] ?? 100;
?>
<style>
  body {background-color: white}
  h1, h2, h3, h4, h5, h6 {color: black}
  a {padding-left: 47vw; color: blue; text-decoration: underline; cursor: pointer}
  h1 {padding-left: 42vw; padding-top: 10vh;}
  </style>

<h1><?php
  switch ($response) {
    case 400: echo "400 Bad Request"; break;
    case 401: echo "401 Unauthorized"; break;
    case 402: echo "402 Payment Required"; break;
    case 403: echo "403 Forbidden"; break;
    case 404: echo "404 Not Found"; break;
    case 405: echo "405 Method Not Allowed"; break;
    case 406: echo "406 Not Acceptable"; break;
    case 407: echo "407 Proxy Authentication Required"; break;
    case 408: echo "408 Request Time-out"; break;
    case 409: echo "409 Conflict"; break;
    case 410: echo "410 Gone"; break;
    case 411: echo "411 Length Required"; break;
    case 412: echo "412 Precondition Failed"; break;
    case 413: echo "413 Request Entity Too Large"; break;
    case 414: echo "414 Request-URI Too Large"; break;
    case 415: echo "415 Unsupported Media Type"; break;
    case 416: echo "416 Requested range not satisfiable"; break;
    case 417: echo "417 Expectation Failed"; break;
    case 500: echo "500 Internal Server Error (Server)"; break;
    case 501: echo "501 Not Implemented (Server)"; break;
    case 502: echo "502 Bad Gateway (Server)"; break;
    case 503: echo "503 Service Unavailable (Server)"; break;
    case 504: echo "504 Gateway Time-out (Server)"; break;
    case 505: echo "505 HTTP Version not supported (Server)"; break;
    default: echo $response;
  }
?></h1>
<a onclick='history.back()'>Go back</a>