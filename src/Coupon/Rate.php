<?php

namespace Coupon;

use Cart\Cart;

class Rate implements ICalculate
{
    public function applyCoupon(Cart $cart, $discount)
    {
        return $cart->getTotalAmountAfterCampaign() * ($discount / 100);
    }
}