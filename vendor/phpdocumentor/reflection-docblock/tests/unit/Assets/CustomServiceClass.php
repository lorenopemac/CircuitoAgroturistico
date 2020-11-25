<?php

declare(strict_types=1);

namespace phpDocumentor\Reflection\Assets;

use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter\PassthroughFormatter;
use phpDocumentor\Reflection\FqsenResolver;
use phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod;

final class CustomServiceClass implements Tag, StaticMethod
{
    public $formatter;

    public function getName() : string
    {
        return 'spy';
    }

    public static function create($body, PassthroughFormatter $formatter = null)
    {
        $tag = new self();
        $tag->formatter = $formatter;

        return $tag;
    }

    public function render(?Formatter $formatter = null) : string
    {
        return $this->getName();
    }

    public function __toString() : string
    {
        return $this->getName();
    }
}
