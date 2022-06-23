<?php

namespace ManabuKun\Domain\Entities;

use ManabuKun\Domain\ValueObjects\PostContent;
use ManabuKun\Domain\ValueObjects\PostId;

class Post extends AggregateRoot
{
    private PostId $postId;
    private PostContent $postContent;
    private ?Likes $likes;

    private function __construct()
    {
        // empty
    }

    public static function createPost(PostId $postId, PostContent $postContent): self
    {
        $newInstance = new self();
        $newInstance->postId = $postId;
        $newInstance->postContent = $postContent;
        $newInstance->likes = new Likes();

        return $newInstance;
    }

    public function addLike(LikeToPost $newLike)
    {
        $this->likes = $this->likes->add($newLike);
    }

    public function removeLike()
    {
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
}
