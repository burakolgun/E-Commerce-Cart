<?php

namespace tests\Unit;

use Campaign\Campaign;
use Cart\Cart;
use Cart\Service;
use Category\Category;
use DiscountType\DiscountType;
use Product\Product;
use Tests\TestBase;

class CampaignTest extends TestBase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testShouldBeCreatedNewCampaign()
    {
        $category = new Category('Fuel');
        $this->assertInstanceOf(Campaign::class, new Campaign($category, 50, 2, DiscountType::RATE));
    }

    public function testDiscountTypeShouldBeEqual()
    {
        $category = new Category('Fuel');
        $campaign = new Campaign($category, 50, 2, DiscountType::RATE);
        $this->assertEquals(DiscountType::RATE, $campaign->getDiscountType());
    }

    public function testApplyCampaignToCartWithRate()
    {
        $foodCategory = new Category('Food');
        $product = new Product("Apple", 100, $foodCategory);
        $cartService = new Service();
        $cartService->addProductToCart($product);
        $campaign = new Campaign($foodCategory, 50, 1, DiscountType::RATE);
        $cartService->applyDiscount($campaign);
        $this->assertEquals(50, Cart::getInstance()->getTotalAmountAfterDiscounts());
    }

    public function testApplyCampaignToCartWithAmount()
    {
        $foodCategory = new Category('Food');
        $product = new Product("Apple", 100, $foodCategory);
        $cartService = new Service();
        $cartService->addProductToCart($product);
        $campaign = new Campaign($foodCategory, 22, 1, DiscountType::AMOUNT);
        $cartService->applyDiscount($campaign);

        $this->assertEquals(78, Cart::getInstance()->getTotalAmountAfterDiscounts());
    }

    public function testBestCampaign()
    {
        $foodCategory = new Category('Food');
        $product1 = new Product("Apple", 100, $foodCategory);
        $product2 = new Product("PineApple", 250, $foodCategory);
        $cartService = new Service();
        $cartService->addProductToCart($product1);
        $cartService->addProductToCart($product2);
        $campaign1 = new Campaign($foodCategory, 22, 1, DiscountType::AMOUNT);
        $campaign2 = new Campaign($foodCategory, 50, 1, DiscountType::AMOUNT);
        $cartService->applyDiscount($campaign1, $campaign2);

        $this->assertEquals(300, Cart::getInstance()->getTotalAmountAfterDiscounts());
    }
}