<?php

namespace ManabuKun\Domain\ValueObjects;

enum Category: string
{
    case ENGINEERING = '1';
    case PROJECT_MANAGEMENT = '2';
    case OPERATION = '3';

    public function categoryName(): string
    {
        return match ($this) {
            Category::ENGINEERING => "技術・エンジニアリング",
            Category::PROJECT_MANAGEMENT => "進行・プロジェクトマネジメント",
            Category::OPERATION => "運用・オペレーション"
        };
    }
}
