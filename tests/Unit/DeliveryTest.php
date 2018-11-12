<?php

namespace tests\Unit;

use Cart\Service;
use Category\Category;
use Delivery\Delivery;
use Product\Product;
use Tests\TestBase;

class DeliveryTest extends TestBase
{
    public function testCreatedInstanceShouldBeDelivery()
    {
        $this->assertInstanceOf(Delivery::class, new Delivery(10, 10));
    }

    public function testCostPerDeliveryShouldBeEqual()
    {
        $delivery = new Delivery(20, 30);
        $this->assertEquals(20, $delivery->getCostPerDelivery());
    }

    public function testCostPerProductShouldBeEqual()
    {
        $delivery = new Delivery(20, 30);
        $this->assertEquals(30, $delivery->getCostPerProduct());
    }

    public function testShouldBeEqualDeliveryCostToFixedCostIfYouDidNotGive()
    {
        $delivery = new Delivery(20, 30);
        $this->assertEquals($delivery->getFixedCost(), Delivery::FIXED_COST);
    }

    public function testShouldBeEqualDeliveryCostToYouAssign()
    {
        $delivery = new Delivery(20, 30, 500.25);
        $this->assertEquals($delivery->getFixedCost(), 500.25);
    }

    public function testDeliveryCost()
    {
        $foodCategory = new Category('Food');
        $product = new Product("Apple", 100, $foodCategory);
        $cartService = new Service();
        $cartService->addProductToCart($product);
        $delivery = new Delivery(4, 4, 5);

        $this->assertEquals(13, \Delivery\Service::getDeliveryCost($delivery, $cartService));
    }
}