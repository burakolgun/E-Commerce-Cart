<?php

namespace Coupon;

use Cart\Cart;

interface ICalculate
{
    public function applyCoupon(Cart $cart, $discount);
}