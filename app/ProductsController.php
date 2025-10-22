<?php

namespace App;

use CrudeSSG\Data;
use CrudeSSG\Page;
use CrudeSSG\Request;

class ProductsController
{
    public static function list(Request $request)
    {
        $products = Data::load('products')->all();
        return Page::make('product-list.twig')->with('products', $products);
    }

    public static function detail(Request $request)
    {
        $slug = $request->getRouteParam('product');
        $product = Data::load('products')->where('slug', $slug)->first();
        return Page::make('product-detail.twig')->with('product', $product);
    }

    public static function shop(Request $request)
    {
        $shop = Data::load('shops')
            ->where('slug', $request->getRouteParam('shop'))
            ->first();

        $product = Data::load('products')
            ->where('shop', $request->getRouteParam('shop'))
            ->where('slug', $request->getRouteParam('product'))
            ->first();

        return Page::make('product-detail.twig')
            ->with('shop', $shop)
            ->with('product', $product);
    }
}