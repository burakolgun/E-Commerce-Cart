<?php

namespace Tests\Unit;


use Category\Category;
use Product\Product;
use Tests\TestBase;

class ProductTest extends TestBase
{
    public function testCanBeCreatedProduct()
    {
        $category = new Category('Food');
        $this->assertInstanceOf(Product::class, new Product(self::PRODUCT_NAME_FOR_TEST, 100, $category));
    }

    public function testProductNameShouldBeEqual()
    {
        $category = new Category('Food');
        $product = new Product(self::PRODUCT_NAME_FOR_TEST, 100, $category);
        $this->assertEquals($product->getTitle(), self::PRODUCT_NAME_FOR_TEST);
    }

    public function testCanBeCreatedProductWithCategory()
    {
        $category = new Category('Food');
        $this->assertInstanceOf(Product::class, new Product(
            self::PRODUCT_NAME_FOR_TEST, self::MAX_PRODUCT_PRICE_FOR_TEST, $category)
        );
    }

    public function testProductsCategoryShouldBeCategoryInstance()
    {
        $category = new Category('Food');
        $product = new Product(self::PRODUCT_NAME_FOR_TEST, self::MAX_PRODUCT_PRICE_FOR_TEST, $category);
        $this->assertInstanceOf(Category::class, $product->getCategory());
    }

    public function testProductPriceShouldBeFloat()
    {
        $category = new Category("food");
        $product = new Product(self::PRODUCT_NAME_FOR_TEST, 100.250, $category);
        $this->assertEquals(100.250, $product->getPrice());
    }

    public function testProductQuantityShouldBeNull()
    {
        $category = new Category("food");
        $product = new Product(self::PRODUCT_NAME_FOR_TEST, 100.250, $category);
        $this->assertEquals(null, $product->getQuantity());
    }

    public function testProductQuantityShouldBeInteger()
    {
        $category = new Category("food");
        $product = new Product(self::PRODUCT_NAME_FOR_TEST, 100.250, $category);
        $product->setQuantity(1.55);
        $this->assertEquals(1, $product->getQuantity());
    }

}