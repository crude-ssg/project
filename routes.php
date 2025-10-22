<?php

use App\BasicPagesController;
use App\ProductsController;
use CrudeSSG\Data;
use CrudeSSG\Router;

$routes = new Router();

$routes->get('/', [BasicPagesController::class, 'home'])->withSsg();
$routes->get('/about', [BasicPagesController::class, 'about'])->withSsg();

$routes->get('/products', [ProductsController::class, 'list'])->withSsg();

$routes->get('/products/{product}', [ProductsController::class, 'detail'])
    ->withSsg(

        fn() => Data::load('products')->wire('product', 'slug')
        // The above is equivalent to manually wiring params like this:
        // [
        //     ['product' => 'wireless-bluetooth-headphones'],
        //     ['product' => 'smart-watch-pro'],
        //     ['product' => 'ergonomic-office-chair'],
        //     ['product' => 'gaming-laptop-x15'],
        //     ['product' => 'stainless-steel-cookware-set'],
        //     ['product' => '4k-ultra-hd-smart-tv'],
        //     ['product' => 'portable-solar-charger'],
        //     ['product' => 'electric-standing-desk'],
        //     ['product' => 'robot-vacuum-cleaner'],
        //     ['product' => 'noise-cancelling-earbuds'],
        // ]
    );

$routes->get('/shop/{shop}/view/{product}', [ProductsController::class, 'shop'])
    ->withSsg(
        fn() => Data::load('shops')->map(fn($shop) => [
            'shop' => $shop['slug'],
            'product' => Data::load('products')->where('shop', $shop['slug'])->pluck('slug')
        ])->all()
    );

return $routes;