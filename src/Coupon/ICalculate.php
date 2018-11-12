<?php

namespace Coupon;

interface ICalculate
{
    public function calculate($totalAmount, $discount);
}