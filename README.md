# Community-

in this component we are responsible the community of our company .


## Installation
1-you should run apache server and mysql ,so install [Xampp](https://www.apachefriends.org/download.html).<br />
2-install [composer](https://getcomposer.org/download/).
Use the framework [slim](http://www.slimframework.com/) to install slim.

```bash
php composer-setup.php --install-dir=bin
composer require slim/slim "^3.12"
composer create-project --prefer-dist laravel/laravel myProjectName
```

## Usage

```php
<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();
```

## Contributing
Pull requests are welcome for every one in the company-2 For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[ABH](https://www.facebook.com/youssef.ashraf.906)
