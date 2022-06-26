<?php

namespace ManabuKun\Domain\Entities;

class Thread
{
    private PostThreadParent $parent;
    private ?array $children;

    public function __construct(PostThreadParent $parent, ?PostThreadChild ...$children)
    {
        $this->parent = $parent;
        $this->children = $this->_sortedChildren($children);
    }

    private function _sortedChildren(?array $children): ?array
    {
        usort($children, function ($child1, $child2) {
            return ($child1->getPostId())() - ($child2->getPostId())();
        });

        return $children;
    }

    public function getParent(): PostThreadParent
    {
        return $this->parent;
    }

    public function getAllChildren(): ?array
    {
        return $this->children;
    }

    public function addChild(PostThreadChild $newChild): void
    {
        $newChildren = array_merge($this->children, [$newChild]);
        $this->children = $this->_sortedChildren($newChildren);
    }
}
