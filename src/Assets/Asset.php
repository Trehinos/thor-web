<?php

namespace Thor\Http\Web\Assets;

use Thor\Http\Web\Node;
use Thor\Http\Web\TextNode;
use Thor\Http\UriInterface;
use Thor\FileSystem\Stream\Stream;
use Thor\FileSystem\Stream\StreamInterface;

class Asset extends Node implements AssetInterface
{

    /**
     * @param AssetType            $type
     * @param string               $name
     * @param string               $filename
     * @param UriInterface         $uri
     * @param StreamInterface|null $file
     */
    public function __construct(
        public readonly AssetType $type,
        public readonly string $name,
        public readonly string $filename,
        public UriInterface $uri,
        protected ?StreamInterface $file = null,
    ) {
        parent::__construct('');
        $this->file ??= Stream::createFromFile("{$this->filename}", "r");
        $this->setNode();
    }

    /**
     * @return void
     */
    protected function setNode(): void
    {
        $attrs = $this->getType()->getHtmlArguments();
        $this->setName($attrs['tag']);
        foreach (array_merge($attrs['attrs'], [$attrs['src'] => "{$this->uri}"]) as $attr => $value) {
            $this->setAttribute($attr, $value);
        }
        if ($this->type === AssetType::JAVASCRIPT) {
            $this->addChild(new TextNode('', $this));
        }
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        $this->file->rewind();
        return $this->file->getContents();
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return AssetType
     */
    public function getType(): AssetType
    {
        return $this->type;
    }

}
