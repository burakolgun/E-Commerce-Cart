<?php

namespace Coupon;


use Cart\Cart;

class Service
{
    private $strategy;
    private $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->strategy = new Amount();
        if ($coupon->getDiscountType() === \DiscountType::RATE) {
            $this->strategy = new Rate();
        }

        $this->coupon = $coupon;
    }

    public function applyCoupon()
    {
        $cart = Cart::getInstance();
        $discount = 0;

        if ($cart->getTotalAmountAfterCampaign() >= $this->coupon->getMinimumCartAmount()) {
            $discount = $this->strategy->applyCoupon($discount);
            if ($this->strategy === \DiscountType::RATE) {
                $discount = $cart->getTotalAmountAfterCampaign() * ($this->coupon->getDiscount() / 100);
            } else {

            }

            $cart->setTotalAmountAfterDiscounts($cart->getTotalAmountAfterCampaign() - $discount);
            $cart->setCouponDiscount($discount);
        }
    }

    public function calculateAppliedDiscountAfterCoupon(Cart $cart)
    {
        $appliedDiscountsByCategory = $cart->getAppliedDiscountByCategories();

        foreach ($appliedDiscountsByCategory as $category => $products) {

        }
    }

}