<?php

namespace ManabuKun\Domain\Entities;

use ManabuKun\Domain\Entities\LikeToPost;

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

    public function add(LikeToPost $newLike): self
    {
        return new self(...array_merge($this->likes, [$newLike]));
    }
}
