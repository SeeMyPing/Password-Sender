<?php

namespace App\Controller;

class HomeController extends Controller {

    public function welcome() {
        var_dump($this->encrypt("hello", "secret"));
        //echo $this->container['render']->render("home.twig");
    }
}