<?php

namespace Thor\Http\Web;

use Twig\Environment;
use JetBrains\PhpStorm\Pure;
use Thor\Http\Routing\Router;
use Thor\Http\Server\HttpServer;
use Thor\Security\SecurityInterface;
use Thor\Common\Configuration\Configuration;
use Thor\Database\PdoExtension\PdoCollection;
use Thor\Http\Request\ServerRequestInterface;

/**
 * Handles a ServerRequestInterface and send a ResponseInterface.
 *
 * In comparison with an HttpServer, this server handles a Twig Environment.
 *
 * @package          Thor/Http/Server
 * @copyright (2021) Sébastien Geldreich
 * @license          MIT
 */
class WebServer extends HttpServer
{

    /**
     * @param Router                 $router
     * @param SecurityInterface|null $security
     * @param PdoCollection          $pdoCollection
     * @param Configuration          $language
     * @param Environment|null       $twig
     */
    #[Pure]
    public function __construct(
        Router $router,
        ?SecurityInterface $security,
        PdoCollection $pdoCollection,
        Configuration $language,
        public ?Environment $twig = null
    ) {
        parent::__construct($router, $security, $pdoCollection, $language);
    }

    /**
     * Gets the Twig Environment of the server.
     *
     * @return Environment
     */
    public function getTwig(): Environment
    {
        return $this->twig;
    }

}
