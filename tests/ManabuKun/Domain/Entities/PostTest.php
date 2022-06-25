<?php

use ManabuKun\Domain\Entities\PostThreadChild;
use ManabuKun\Domain\Entities\PostThreadParent;
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

        $post = PostThreadParent::createPost($postId, $userId, $postContent);
        $this->assertEquals($postId, $post->getId());
        $this->assertEquals($postContent, $post->getContent());
        $this->assertEquals($userId, $post->getUserId());

        $post->addLike($userId);
        $this->assertCount(1, $post->getLikes()->all());

        $post->removeLike($userId);
        $this->assertCount(0, $post->getLikes()->all());

        $notExistsUserId = new UserId(99999);
        $post->removeLike($notExistsUserId);
        $this->assertCount(0, $post->getLikes()->all());
    }

    public function testChildPost()
    {
        $rawPostId = 2001;
        $rawUserId = 50001;
        $rawContent = "スレッドの子投稿";
        $rawParentPostId = 1001;

        $childPost = PostThreadChild::createChildPost(
            new PostId($rawPostId),
            new UserId($rawUserId),
            new PostContent($rawContent),
            new PostId($rawParentPostId)
        );

        $this->assertEquals($rawParentPostId, ($childPost->getParentPostId())());
    }
}
