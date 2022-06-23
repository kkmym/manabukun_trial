<?php

namespace ManabuKun\Domain\Entities;

use ManabuKun\Domain\ValueObjects\PostId;
use ManabuKun\Domain\ValueObjects\UserId;

class LikeToPost
{
    private UserId $userId;
    private PostId $postId;

    public function __construct(UserId $userId, PostId $postId)
    {
        $this->userId = $userId;
        $this->postId = $postId;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }
}
