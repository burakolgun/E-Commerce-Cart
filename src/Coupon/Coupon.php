<?php

namespace Coupon;

class Coupon
{
    private $minimumCartAmount = 0.0;
    private $discount = 0.0;
    private $discountType;

    public function __construct($minimumCartAmount, $discount, $discountType)
    {
        $this->setMinimumCartAmount($minimumCartAmount);
        $this->setDiscount($discount);
        $this->setDiscountType($discountType);
    }

    /**
     * @return float
     */
    public function getMinimumCartAmount(): float
    {
        return $this->minimumCartAmount;
    }

    /**
     * @param float $minimumCartAmount
     */
    public function setMinimumCartAmount(float $minimumCartAmount)
    {
        $this->minimumCartAmount = $minimumCartAmount;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }

    /**
     * @param mixed $discountType
     */
    public function setDiscountType($discountType)
    {
        $this->discountType = $discountType;
    }

}