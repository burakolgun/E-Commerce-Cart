<?php

namespace Category;

class Category
{
    private $title;
    private $parent;

    public function __construct(string $name, Category $parent = null)
    {
        $this->setTitle($name);
        $this->setParent($parent);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}