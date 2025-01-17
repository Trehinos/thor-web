<?php

namespace Thor\Http\Web;

final class Html
{

    private function __construct()
    {
    }

    /**
     * @param string $iconName
     * @param string $iconCollection
     *
     * @return Node
     */
    public static function icon(string $iconName, string $iconCollection = 'fas'): Node
    {
        return self::node(
            'i',
            [
                'class' => "$iconCollection fa-$iconName",
            ],
            ['']
        );
    }

    /**
     * @param string $tag
     * @param array $attrs
     * @param Node[]|string[] $content
     *
     * @return Node
     */
    public static function node(string $tag, array $attrs = [], array $content = []): Node
    {
        $node = new Node($tag);
        foreach ($attrs as $name => $value) {
            $node->setAttribute($name, $value);
        }
        foreach ($content as $childNode) {
            if (is_string($childNode)) {
                $node->addChild(new TextNode($childNode));
                continue;
            }
            $node->addChild($childNode);
        }
        return $node;
    }

    /**
     * @param Node|null $icon
     * @param string    $label
     * @param array     $attrs
     *
     * @return Node
     */
    public static function button(?Node $icon, string $label, array $attrs = []): Node
    {
        return self::node(
            'button',
            $attrs,
            [$icon, new TextNode($label)]
        );
    }

    /**
     * @param array $attrs
     * @param array $content
     *
     * @return Node
     */
    public static function div(array $attrs = [], array $content = ['']): Node
    {
        return self::node('div', $attrs, $content);
    }

}
