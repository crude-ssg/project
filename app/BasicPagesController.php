<?php

namespace App;

use CrudeSSG\Page;

class BasicPagesController
{
    public static function home()
    {
        return Page::make('home.twig');
    }

    public static function about()
    {
        return Page::make('about.twig');
    }
}