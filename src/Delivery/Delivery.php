<?php

namespace Delivery;

class Delivery
{
    const FIXED_COST = 2.99;
    private $costPerDelivery;
    private $costPerProduct;

    public function __construct($costPerDelivery, $costPerProduct)
    {
        $this->costPerDelivery = $costPerDelivery;
        $this->costPerProduct = $costPerProduct;
    }

    /**
     * @return mixed
     */
    public function getCostPerDelivery()
    {
        return $this->costPerDelivery;
    }

    /**
     * @param mixed $costPerDelivery
     */
    public function setCostPerDelivery($costPerDelivery)
    {
        $this->costPerDelivery = $costPerDelivery;
    }

    /**
     * @return mixed
     */
    public function getCostPerProduct()
    {
        return $this->costPerProduct;
    }

    /**
     * @param mixed $costPerProduct
     */
    public function setCostPerProduct($costPerProduct)
    {
        $this->costPerProduct = $costPerProduct;
    }
}