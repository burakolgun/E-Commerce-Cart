<?php

namespace Delivery;

class Delivery
{
    const FIXED_COST = 2.99;
    private $costPerDelivery;
    private $costPerProduct;
    private $fixedCost;

    public function __construct($costPerDelivery, $costPerProduct, $fixedCost = self::FIXED_COST)
    {
        $this->setCostPerDelivery($costPerDelivery);
        $this->setCostPerProduct($costPerProduct);
        $this->setFixedCost($fixedCost);
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

    /**
     * @return mixed
     */
    public function getFixedCost()
    {
        return $this->fixedCost;
    }

    /**
     * @param mixed $fixedCost
     */
    public function setFixedCost($fixedCost)
    {
        $this->fixedCost = $fixedCost;
    }
}