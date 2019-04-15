<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/dbConc.php';

$app = new \Slim\App;
// ---------------------------------------------//

// post Routes
require '../src/routes/posts.php';
// vacancy Routes
require '../src/routes/vacancies.php';

$app->run();




