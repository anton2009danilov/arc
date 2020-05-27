<?php


namespace Framework\command;


class registerRoutesCommand
{
    public $kernel;


    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function execute() {
        $this->routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->kernel->containerBuilder->set('route_collection', $this->kernel->routeCollection);
    }
}