<?php

namespace Coupon;


use Cart\Cart;

class Service
{
    private $strategy;
    private $coupon;

    /**
     * @var Cart $cart
     */
    private $cart;

    public function __construct(Coupon $coupon)
    {
        $this->strategy = new Amount();
        if ($coupon->getDiscountType() === \DiscountType::RATE) {
            $this->strategy = new Rate();
        }

        $this->cart = Cart::getInstance();
        $this->coupon = $coupon;
    }

    public function applyCoupon()
    {
        if ($this->cart->getTotalAmountAfterCampaign() >= $this->coupon->getMinimumCartAmount()) {
            $discount = $this->strategy->calculate($this->cart->getTotalAmountAfterCampaign(), $this->coupon->getDiscount());
            $this->cart->setTotalAmountAfterDiscounts($this->cart->getTotalAmountAfterCampaign() - $discount);
            $this->cart->setCouponDiscount($discount);
        }

        $this->calculateAppliedDiscountAfterCouponByCategories();
    }

    public function calculateAppliedDiscountAfterCouponByCategories()
    {
        $appliedDiscountsByCategory = $this->cart->getAppliedDiscountByCategories();
        $tempAppliedDiscountsByCategory = [];

        $discount = $this->coupon->getDiscountType() === \DiscountType::AMOUNT ? $this->coupon->getDiscount() / count($this->cart->getProducts()) : $this->coupon->getDiscount();

        foreach ($this->cart->getProducts() as $category => $products) {
            if (empty($appliedDiscountsByCategory[$category])) {
                $tempAppliedDiscountsByCategory[$category] = $this->strategy->calculate($this->cart->getTotalAmountsBeforeDiscountByCategory()[$category], $discount);
            } else {
                $tempAppliedDiscountsByCategory[$category] = $this->strategy->calculate($appliedDiscountsByCategory[$category], $discount);

            }
        }

        $this->cart->setAppliedDiscountByCategories($tempAppliedDiscountsByCategory);
    }
}