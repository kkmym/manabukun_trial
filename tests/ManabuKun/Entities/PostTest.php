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

        $rawContent = "とりあえず解決したけどよくわからない話";
        $postContent = new PostContent($rawContent);

        $post = Post::createPost($postId, $postContent);
        $this->assertEquals($postId, $post->getId());
        $this->assertEquals($postContent, $post->getContent());

        $post->addLike(new LikeToPost(new UserId(1003), $postId));
        $this->assertCount(1, $post->getLikes()->all());
    }
}
