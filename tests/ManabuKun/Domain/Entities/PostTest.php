<?php

use ManabuKun\Domain\Entities\LikeToPost;
use ManabuKun\Domain\Entities\Post;
use ManabuKun\Domain\ValueObjects\PostContent;
use ManabuKun\Domain\ValueObjects\PostId;
use ManabuKun\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testForNow()
    {
        $rawPostId = 1234;
        $postId = new PostId($rawPostId);

        $rawUserId = 5001;
        $userId = new UserId($rawUserId);

        $rawContent = "とりあえず解決したけどよくわからない話";
        $postContent = new PostContent($rawContent);

        $post = Post::createPost($postId, $userId, $postContent);
        $this->assertEquals($postId, $post->getId());
        $this->assertEquals($postContent, $post->getContent());

        $post->addLike($userId);
        $this->assertCount(1, $post->getLikes()->all());

        $post->removeLike($userId);
        $this->assertCount(0, $post->getLikes()->all());

        $notExistsUserId = new UserId(99999);
        $post->removeLike($notExistsUserId);
        $this->assertCount(0, $post->getLikes()->all());
    }
}
