<?php

class BasicPagesController
{
    public static function home()
    {
        return \CrudeSSG\Page::make('home.twig');
    }

    public static function about()
    {
        return \CrudeSSG\Page::make('about.twig');
    }
}