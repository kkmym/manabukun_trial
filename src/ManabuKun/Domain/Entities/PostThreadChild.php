<?php

namespace ManabuKun\Domain\Entities;

use ManabuKun\Domain\ValueObjects\PostContent;
use ManabuKun\Domain\ValueObjects\PostId;
use ManabuKun\Domain\ValueObjects\UserId;

class PostThreadChild extends Post
{
    private PostId $parentPostId;

    public static function createChildPost(PostId $postId, UserId $userId, PostContent $postContent, PostId $parentPostId, ?Likes $likes = new Likes()): self
    {
        $childPost = self::createPost($postId, $userId, $postContent, $likes);
        $childPost->parentPostId = $parentPostId;
        return $childPost;
    }

    public function isThreadParent(): bool
    {
        return false;
    }

    public function getParentPostId(): PostId
    {
        return $this->parentPostId;
    }
}
