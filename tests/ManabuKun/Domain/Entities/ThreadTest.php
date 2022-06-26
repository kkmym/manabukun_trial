<?php

use ManabuKun\Domain\Entities\PostThreadChild;
use ManabuKun\Domain\Entities\PostThreadParent;
use ManabuKun\Domain\Entities\Thread;
use ManabuKun\Domain\ValueObjects\PostContent;
use ManabuKun\Domain\ValueObjects\PostId;
use ManabuKun\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;

class ThreadTest extends TestCase
{
    public function testNoChild()
    {
        $rawParentPostId = 101;
        $rawParentUserId = 5001;
        $rawParentContent = "スレッドの親投稿";

        $parentPost = PostThreadParent::createPost(
            new PostId($rawParentPostId),
            new UserId($rawParentUserId),
            new PostContent($rawParentContent)
        );

        $thread = new Thread($parentPost);

        $parentInThread = $thread->getParent();
        $this->assertEquals($rawParentPostId, ($parentInThread->getPostId())());
        $this->assertEquals(0, count($thread->getAllChildren()));
    }

    public function testTwoChildren()
    {
        $rawParentPostId = 101;
        $rawParentUserId = 5001;
        $rawParentContent = "スレッドの親投稿";

        $rawChild1PostId = 102;
        $rawChild1UserId = 5002;
        $rawChild1Content = "スレッドの子投稿";

        $rawChild2PostId = 103;
        $rawChild2UserId = 5003;
        $rawChild2Content = "スレッドの子投稿";

        $parentPost = PostThreadParent::createPost(
            new PostId($rawParentPostId),
            new UserId($rawParentUserId),
            new PostContent($rawParentContent)
        );

        $child1Post = PostThreadChild::createChildPost(
            new PostId($rawChild1PostId),
            new UserId($rawChild1UserId),
            new PostContent($rawChild1Content),
            new PostId($rawParentPostId)
        );

        $child2Post = PostThreadChild::createChildPost(
            new PostId($rawChild2PostId),
            new UserId($rawChild2UserId),
            new PostContent($rawChild2Content),
            new PostId($rawParentPostId)
        );

        // わざと child1 child2 をひっくり返しておく
        $thread = new Thread($parentPost, ...[$child2Post, $child1Post]);

        $children = $thread->getAllChildren();
        $this->assertEquals(2, count($children));

        // child1 child2 の順番が thread 内では正しいことを期待
        $this->assertEquals($rawChild1PostId, ($children[0]->getPostId())());
        $this->assertEquals($rawChild2PostId, ($children[1]->getPostId())());
    }

    public function testAddNewChild()
    {
        $rawParentPostId = 101;
        $rawParentUserId = 5001;
        $rawParentContent = "スレッドの親投稿";

        $rawChild1PostId = 102;
        $rawChild1UserId = 5002;
        $rawChild1Content = "スレッドの子投稿";

        $rawChild2PostId = 105;
        $rawChild2UserId = 5005;
        $rawChild2Content = "スレッドの子投稿（あとから追加）";

        $parentPost = PostThreadParent::createPost(
            new PostId($rawParentPostId),
            new UserId($rawParentUserId),
            new PostContent($rawParentContent)
        );

        $child1Post = PostThreadChild::createChildPost(
            new PostId($rawChild1PostId),
            new UserId($rawChild1UserId),
            new PostContent($rawChild1Content),
            new PostId($rawParentPostId)
        );

        $thread = new Thread($parentPost, ...[$child1Post]);
        $this->assertEquals(1, count($thread->getAllChildren()));

        $newChildPost = PostThreadChild::createChildPost(
            new PostId($rawChild2PostId),
            new UserId($rawChild2UserId),
            new PostContent($rawChild2Content),
            new PostId($rawParentPostId)
        );

        $thread->addChild($newChildPost);
        $this->assertEquals(2, count($thread->getAllChildren()));

        $children = $thread->getAllChildren();
        $this->assertEquals($rawChild1PostId, ($children[0]->getPostId())());
        $this->assertEquals($rawChild2PostId, ($children[1]->getPostId())());
    }
}
