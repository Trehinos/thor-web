<?php

namespace Thor\Http\Web;

use Thor\Http\HttpKernel;
use Thor\Common\Configuration\Configuration;

/**
 * WebKernel of Thor. It is by default instantiated with the `index.php` entry point.
 *
 * Works like the HttpKernel but with a WebServer instead of HttpServer.
 *
 * @see              WebServer
 *
 * @package          Thor/Http
 * @copyright (2021) Sébastien Geldreich
 * @license          MIT
 */
class WebKernel extends HttpKernel
{

    /**
     * @param WebServer $webServer
     */
    public function __construct(protected WebServer $webServer)
    {
        parent::__construct($webServer);
    }

    /**
     * This function return a new kernel.
     *
     * It loads the configuration files and use it to instantiate the Kernel.
     *
     * @see Configurations::getWebConfiguration()
     */
    public static function create(): static
    {
        self::guardHttp();
        return self::createFromConfiguration(Configurations::getWebConfiguration());
    }

    /**
     * This static function returns a new WebKernel with specified configuration.
     *
     * @param Configuration $config
     *
     * @return static
     */
    public static function createFromConfiguration(Configuration $config): static
    {
        return new self($config['server']);
    }

}
