<?php

namespace Tests\Unit;

use Category\Category;
use Tests\TestBase;

class CategoryTest extends TestBase
{
    public function testCanBeCreatedCategory()
    {
        $category = new Category('Electronic');
        $this->assertInstanceOf(Category::class, $category);
    }

    public function testCategoryNameShouldBeEqual()
    {
        $category = new Category('Electronic');
        $this->assertEquals($category->getTitle(), 'Electronic');
    }

    public function testCategoryShouldBeHasAParent()
    {
        $parentCategory = new Category('Computer');
        $category = new Category('DisplayCard', $parentCategory);

        $this->assertInstanceOf(Category::class, $category->getParent());
    }

    public function testCategorysParentClassNameShouldBeEqual()
    {
        $parentCategory = new Category('Computer');
        $category = new Category('DisplayCard', $parentCategory);

        $this->assertEquals($category->getParent()->getTitle(), 'Computer');
    }



}