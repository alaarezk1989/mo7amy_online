<?php

namespace App\Libraries;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;

class CustomUrlGenerator extends UrlGenerator
{
    public function __construct(RouteCollection $routes, Request $request)
    {
        parent::__construct($routes, $request);
    }

    /**
     * {@inheritdoc}
     */
    protected function getRootUrl($scheme, $root = null)
    {
        return parent::getRootUrl($scheme, $root) . '/some/folder/';
    }
}
