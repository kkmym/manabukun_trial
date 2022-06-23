<?php

namespace ManabuKun\Domain\ValueObjects;

class UserId
{
    private int $userId;

    public function __construct(int $id)
    {
        $this->userId = $id;
    }

    public function __invoke(): int
    {
        return $this->userId;
    }
}
