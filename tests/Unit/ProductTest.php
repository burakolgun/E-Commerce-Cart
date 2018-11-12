<?php

namespace Tests\Unit;

use Model\Category;
use Model\Product;
use Tests\TestBase;

class ProductTest extends TestBase
{
    public function testCanBeCreatedProduct()
    {
        $category = new Category('Food');
        $this->assertInstanceOf(Product::class, new Product($category,self::PRODUCT_NAME_FOR_TEST, 100));
    }

    public function testProductNameShouldBeString()
    {
        $category = new Category('Food');
        $product = new Product($category, self::PRODUCT_NAME_FOR_TEST, self::MAX_PRODUCT_PRICE_FOR_TEST);
        $this->assertEquals($product->getTitle(), self::PRODUCT_NAME_FOR_TEST);
    }

    public function testCanBeCreatedProductWithCategory()
    {
        $category = new Category('Food');

        $this->assertInstanceOf(Product::class, new Product(self::PRODUCT_NAME_FOR_TEST, self::MAX_PRODUCT_PRICE_FOR_TEST, $category));
    }

    public function testProductPriceShouldBeFloat()
    {
        $category = new Category("food");
        $product = new Product($category,self::PRODUCT_NAME_FOR_TEST, 100.250);

        $this->assertEquals(100.250, $product->getPrice());
    }
}