<?php

namespace Coupon;


use Cart\Cart;
use DiscountType\DiscountType;

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
        if ($coupon->getDiscountType() === DiscountType::RATE) {
            $this->strategy = new Rate();
        }

        $this->cart = Cart::getInstance();
        $this->coupon = $coupon;
    }

    public function applyCoupon(\Cart\Service $cartService)
    {
        if (\Cart\Service::$appliedDiscount) {
            if ($this->cart->getTotalAmountAfterCampaign() >= $this->coupon->getMinimumCartAmount()) {
                $discount = $this->strategy->calculate($this->cart->getTotalAmountAfterCampaign(), $this->coupon->getDiscount());
                $this->cart->setTotalAmountAfterDiscounts($this->cart->getTotalAmountAfterCampaign() - $discount);
                $this->cart->setCouponDiscount($discount);
            }

            $this->calculateAppliedDiscountAfterCouponByCategories();

            return true;
        }

        $cartService->applyDiscount();

        return $this->applyCoupon($cartService);
    }

    public function calculateAppliedDiscountAfterCouponByCategories()
    {
        $appliedDiscountsByCategory = $this->cart->getAppliedDiscountByCategories();
        $tempAppliedDiscountsByCategory = [];

        $discount = $this->coupon->getDiscountType() === DiscountType::AMOUNT ?
            $this->coupon->getDiscount() / count($this->cart->getProducts()) :
            $this->coupon->getDiscount();

        foreach ($this->cart->getProducts() as $category => $products) {

            $tempAppliedDiscountsByCategory[$category] = empty($appliedDiscountsByCategory[$category]) ?
                $this->strategy->calculate($this->cart->getTotalAmountsBeforeDiscountByCategory()[$category], $discount) :
                $this->strategy->calculate($appliedDiscountsByCategory[$category], $discount);
        }

        $this->cart->setAppliedDiscountByCategories($tempAppliedDiscountsByCategory);
    }
}