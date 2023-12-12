<?php

namespace Thor\Http\Web;

use Thor\Http\ProtocolVersion;
use Thor\Http\Response\HttpStatus;
use Thor\Http\Response\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Thor\FileSystem\Stream\Stream;

class TwigResponse extends Response
{

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __construct(
        protected Environment $environment,
        string $filename,
        array $params = [],
        HttpStatus $status = HttpStatus::OK,
        array $headers = [],
        ProtocolVersion $version = ProtocolVersion::HTTP11,
    ) {
        parent::__construct(
            $version,
            $headers,
            Stream::create($this->environment->render($filename, $params)),
            $status
        );
    }

}
