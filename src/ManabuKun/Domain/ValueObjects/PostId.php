<?php

namespace ManabuKun\Domain\ValueObjects;

class PostId
{
    private int $postId;

    public function __construct(int $id)
    {
        $this->postId = $id;
    }

    public function __invoke(): int
    {
        return $this->postId;
    }
}
