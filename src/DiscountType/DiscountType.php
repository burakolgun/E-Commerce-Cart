<?php

namespace DiscountType;

class DiscountType
{
    const AMOUNT = "amount";
    const RATE = "rate";

    private $discountType;

    public function __construct($discountType)
    {
        $this->discountType = $discountType;
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