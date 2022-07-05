<?php

use ManabuKun\Domain\ValueObjects\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testScalaValue()
    {
        $cat = Category::ENGINEERING;
        $this->assertEquals('1', $cat->value);
        $this->assertEquals('ENGINEERING', $cat->name);
    }

    public function testCategoryName()
    {
        $cat = Category::PROJECT_MANAGEMENT;
        $this->assertStringContainsString('プロジェクトマネジメント', $cat->categoryName());
    }
}
