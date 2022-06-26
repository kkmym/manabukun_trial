<?php

namespace ManabuKun\Domain\Entities;

use ManabuKun\Domain\Entities\LikeToPost;
use ManabuKun\Domain\ValueObjects\UserId;

/**
 * ▼phpでファーストクラスコレクションを作る
 * https://zenn.dev/tasteck/articles/94cad3eea8c99a
 */

class Likes
{
    private array $likes;

    public function __construct(?LikeToPost ...$likes)
    {
        $this->likes = $likes;
    }

    public function all(): array
    {
        return $this->likes;
    }

    /**
     * @todo selfを返すのがよいか、それともメンバ変数 $likes の更新のみでよいか。検討する。
     */
    public function add(LikeToPost $newLike): void
    {
        $this->likes = array_merge($this->likes, [$newLike]);
    }

    public function remove(UserId $userId): void
    {
        $this->likes = array_filter($this->likes, function (LikeToPost $like) use ($userId) {
            return $like->getUserId() != $userId;
        });
    }
}
