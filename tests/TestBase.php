<?php

namespace Tests;

use Cart\Cart;
use Cart\Service;
use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        Cart::$instance = null;
        Service::$appliedDiscount = false;
    }

    const PRODUCT_NAME_FOR_TEST = 'Apple';
    const MIN_PRODUCT_PRICE_FOR_TEST = 1;
    const MID_PRODUCT_PRICE_FOR_TEST = 10;
    const MAX_PRODUCT_PRICE_FOR_TEST = 100;
}