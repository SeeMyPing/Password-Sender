<?php

namespace App\Controller;

class HomeController {
    private $container;
    public function __construct($container) {
        $this->container = $container;
    }

    public function welcome($arg = null) {
        echo "$arg";
    }
}