<?php

namespace ManabuKun\Domain\Entities;

class PostThreadChild extends Post
{
    public function isThreadParent(): bool
    {
        return false;
    }
}
