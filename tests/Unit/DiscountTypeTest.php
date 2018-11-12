<?php

namespace tests\Unit;

use Tests\TestBase;
use DiscountType\DiscountType;

class DiscountTypeTest extends TestBase
{
    public function testCreateInstanceWithAmountType()
    {
        $discountType = new DiscountType(DiscountType::AMOUNT);
        $this->assertInstanceOf(DiscountType::class, $discountType);
    }


    public function testCreateInstanceWithRateType()
    {
        $discountType = new DiscountType(DiscountType::RATE);
        $this->assertInstanceOf(DiscountType::class, $discountType);
    }

    public function testCreatedInstanceTypeShouldBeRate()
    {
        $discountType = new DiscountType(DiscountType::RATE);
        $this->assertEquals(DiscountType::RATE, $discountType->getDiscountType());
    }

    public function testCreatedInstanceTypeShouldBeAmount()
    {
        $discountType = new DiscountType(DiscountType::AMOUNT);
        $this->assertEquals(DiscountType::AMOUNT, $discountType->getDiscountType());
    }

    public function testChangeDiscountType()
    {
        $discountType = new DiscountType(DiscountType::AMOUNT);
        $discountType->setDiscountType(DiscountType::RATE);
        $this->assertEquals(DiscountType::RATE, $discountType->getDiscountType());
    }
}