<?php

namespace ManabuKun\Domain\ValueObjects;

class PostContent
{
    private string $content;
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function __invoke(): string
    {
        return $this->content;
    }
}
