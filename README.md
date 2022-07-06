
# Project Title

It is a MicroFramework that has been created with the educational goal of the MVC architecture.


## About this project
In this project I've used Composer, for autoloading process, and I've used "DOTENV" to manage configs.

In this MicroFramework, you can set an exact Route or a dynamic route, and also you can set middlewares, Global middlewares, or middlewares for a specific route.


# Documentation
### Route definition
you can use the following syntax to add a route: 

```php
<?php 
    Route::add($method,$uri,$action,$middleware);
?>
```
The method parameter is an array or a string of method or methods that this route can support

The "URI" parameter is a string URI for this route.

The action parameter can be an array or a string, that if be an array, the first index of this should be its controller, and the second index should be its method, for example: 
```php
    <?php
    # array
    $action = ['HomeController','index'];

    # string
    $action = "HomeController@index"; 
    ?>
```

The middleware parameter is an array that is an empty array by default, if complete this parameter is, one or more middleware will be set for only this route.
```php
    <?php
        $middlewares = [IEBlocker::class,MobileBlocker::class];
    ?>
```
But if you want to add a global middleware you should use the following method:
```php
    <?php
        GlobalMiddleware::set(IEBlocker::class);
    ?>
```

And you can add a route with a specific method, like this:
```php
    <?php
        Route::get($uri, $action, $middleware);
        Route::post($uri, $action, $middleware);
        Route::put($uri, $action, $middleware);
        Route::patch($uri, $action, $middleware);
        Route::delete($uri, $action, $middleware);
        Route::options($uri, $action, $middleware);
    ?>
```

## Dynamic Route
You can add a route like this:
```php
    <?php
        Route::get('products/electrical/mobile/{moblie_id}','productController@get');
    ?>
```
And you can get this moblie_id with routeParams attribute in the request class

## Tech Stack

**Server:** PHP, Composer, DOTENV, MedooLibrary


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Authors

- [@MasoudHarooni](https://www.github.com/masoudharooni)
