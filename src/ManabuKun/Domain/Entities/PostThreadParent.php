<?php

namespace ManabuKun\Domain\Entities;

class PostThreadParent extends Post
{
    public function isThreadParent(): bool
    {
        return true;
    }
}
