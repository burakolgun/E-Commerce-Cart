<?php

namespace Coupon;

class Rate implements ICalculate
{
    public function calculate($totalAmount, $discount)
    {
        return $totalAmount * ($discount / 100);
    }
}