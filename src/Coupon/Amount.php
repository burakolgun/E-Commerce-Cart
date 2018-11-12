<?php

namespace Coupon;

class Amount implements ICalculate
{
    public function calculate($totalAmount, $discount)
    {
        return $discount;
    }
}