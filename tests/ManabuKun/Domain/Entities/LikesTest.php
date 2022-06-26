<?php

use ManabuKun\Domain\Entities\Likes;
use ManabuKun\Domain\Entities\LikeToPost;
use ManabuKun\Domain\ValueObjects\PostId;
use ManabuKun\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class LikesTest extends TestCase
{
    public function testLikesAdd()
    {
        $likes = new Likes();
        $this->assertCount(0, $likes->all());

        $userId = new UserId(1006);
        $postId1 = new PostId(50006);
        $likes->add(new LikeToPost($userId, $postId1));
        $this->assertCount(1, $likes->all());
    }

    public function testLikesConstructor()
    {
        $userId1 = new UserId(1001);
        $postId1 = new PostId(50001);
        $like1 = new LikeToPost($userId1, $postId1);

        $userId2 = new UserId(1002);
        $postId2 = new PostId(50002);
        $like2 = new LikeToPost($userId2, $postId2);

        $myLikes = [$like1, $like2];

        $likes = new Likes(...$myLikes);

        $this->assertCount(2, $likes->all());
    }
}
