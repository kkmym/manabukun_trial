<?php

namespace ManabuKun\Domain\Entities;

use ManabuKun\Domain\ValueObjects\PostContent;
use ManabuKun\Domain\ValueObjects\PostId;
use ManabuKun\Domain\ValueObjects\UserId;

abstract class Post extends AggregateRoot
{
    private PostId $postId;
    private UserId $userId;
    private PostContent $postContent;
    private ?Likes $likes;

    private function __construct()
    {
        // empty
    }

    public static function createPost(PostId $postId, UserId $userId, PostContent $postContent, ?Likes $likes = new Likes()): static
    {
        $newInstance = new static();
        $newInstance->postId = $postId;
        $newInstance->userId = $userId;
        $newInstance->postContent = $postContent;
        $newInstance->likes = $likes;

        return $newInstance;
    }

    public function addLike(UserId $userId)
    {
        $newLike = new LikeToPost($userId, new PostId(($this->postId)()));
        $this->likes = $this->likes->add($newLike);
    }

    public function removeLike(UserId $userId)
    {
        $this->likes->remove($userId);
    }

    public function getId(): PostId
    {
        return $this->postId;
    }

    public function getContent(): PostContent
    {
        return $this->postContent;
    }

    public function getLikes(): Likes
    {
        return $this->likes;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    abstract public function isThreadParent(): bool;
}
