<?php

namespace tests\Unit;

use Cart\Cart;
use Cart\Service;
use Category\Category;
use DiscountType\DiscountType;
use Product\Product;
use Tests\TestBase;

class Coupon extends TestBase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testShouldBeCreatedNewCoupon()
    {
        $this->assertInstanceOf(\Coupon\Coupon::class, new \Coupon\Coupon(10,20,DiscountType::RATE));
    }

    public function testDiscountTypeShouldBeEqual()
    {
        $coupon = new \Coupon\Coupon(10,20,DiscountType::RATE);
        $this->assertEquals(DiscountType::RATE, $coupon->getDiscountType());
    }

    public function testApplyCouponToCartWithRate()
    {
        $a = Cart::getInstance();
        $foodCategory = new Category('Food');
        $product = new Product("Apple", 100, $foodCategory);
        $cartService = new Service();
        $cartService->addProductToCart($product);
        $coupon = new \Coupon\Coupon(10,20,DiscountType::RATE);
        $couponService = new \Coupon\Service($coupon);
        $couponService->applyCoupon($cartService);

        $this->assertEquals(80, Cart::getInstance()->getTotalAmountAfterDiscounts());
    }

    public function testApplyCouponToCartWithAmount()
    {
        $foodCategory = new Category('Food');
        $product = new Product("Apple", 250, $foodCategory);
        $cartService = new Service();
        $cartService->addProductToCart($product);
        $coupon = new \Coupon\Coupon(25,50,DiscountType::AMOUNT);
        $couponService = new \Coupon\Service($coupon);
        $couponService->applyCoupon($cartService);

        $this->assertEquals(200, Cart::getInstance()->getTotalAmountAfterDiscounts());
    }

    public function testCouponMinimumCartAmount()
    {
        $foodCategory = new Category('Food');
        $product = new Product("Apple", 250, $foodCategory);
        $cartService = new Service();
        $cartService->addProductToCart($product);
        $coupon = new \Coupon\Coupon(400,50,DiscountType::AMOUNT);
        $couponService = new \Coupon\Service($coupon);
        $couponService->applyCoupon($cartService);

        $this->assertEquals(250, Cart::getInstance()->getTotalAmountAfterDiscounts());
    }
}