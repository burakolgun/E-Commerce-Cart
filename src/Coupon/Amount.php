<?php

namespace Coupon;


use Cart\Cart;

class Amount implements ICalculate
{
    public function applyCoupon(Cart $cart, $discount)
    {
        return $cart->getTotalAmountAfterCampaign() - $discount;
    }
}