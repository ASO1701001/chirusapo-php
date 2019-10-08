<?php
namespace Classes\Controllers;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Controller {
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
}