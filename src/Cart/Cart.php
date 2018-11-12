<?php

namespace Cart;

use Product\Product;

class Cart
{
    /**
     * @var Product[]
     */
    private $products = [];

    private $totalDiscount = 0.0;
    private $deliveryCost = 0.0;
    private $appliedDiscount;
    private $appliedDiscountByCategories = [];
    private $totalAmountsBeforeDiscountByCategory = [];
    private $totalAmountAfterCampaign;
    private $totalAmountAfterDiscounts;
    private $campaignDiscount = 0.0;
    private $couponDiscount = 0.0;
    private $totalAmountAfterCoupon;

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Cart();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     */
    public function setProducts(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return float
     */
    public function getTotalDiscount(): float
    {
        return $this->totalDiscount;
    }

    /**
     * @param float $totalDiscount
     */
    public function setTotalDiscount(float $totalDiscount)
    {
        $this->totalDiscount = $totalDiscount;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountAfterCoupon()
    {
        return $this->totalAmountAfterCoupon;
    }

    /**
     * @param mixed $totalAmountAfterCoupon
     */
    public function setTotalAmountAfterCoupon($totalAmountAfterCoupon)
    {
        $this->totalAmountAfterCoupon = $totalAmountAfterCoupon;
    }



    /**
     * @return float
     */
    public function getDeliveryCost(): float
    {
        return $this->deliveryCost;
    }

    /**
     * @param float $deliveryCost
     */
    public function setDeliveryCost(float $deliveryCost)
    {
        $this->deliveryCost = $deliveryCost;
    }

    /**
     * @return mixed
     */
    public function getAppliedDiscount()
    {
        return $this->appliedDiscount;
    }

    /**
     * @param mixed $appliedDiscount
     */
    public function setAppliedDiscount($appliedDiscount)
    {
        $this->appliedDiscount = $appliedDiscount;
    }

    /**
     * @return array
     */
    public function getAppliedDiscountByCategories(): array
    {
        return $this->appliedDiscountByCategories;
    }

    /**
     * @param array $appliedDiscountByCategories
     */
    public function setAppliedDiscountByCategories(array $appliedDiscountByCategories)
    {
        $this->appliedDiscountByCategories = $appliedDiscountByCategories;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountAfterCampaign()
    {
        return $this->totalAmountAfterCampaign;
    }

    /**
     * @param mixed $totalAmountAfterCampaign
     */
    public function setTotalAmountAfterCampaign($totalAmountAfterCampaign)
    {
        $this->totalAmountAfterCampaign = $totalAmountAfterCampaign;
    }

    /**
     * @return float
     */
    public function getCampaignDiscount(): float
    {
        return $this->campaignDiscount;
    }

    /**
     * @param float $campaignDiscount
     */
    public function setCampaignDiscount(float $campaignDiscount)
    {
        $this->campaignDiscount = $campaignDiscount;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountAfterDiscounts()
    {
        return $this->totalAmountAfterDiscounts;
    }

    /**
     * @param mixed $totalAmountAfterDiscounts
     */
    public function setTotalAmountAfterDiscounts($totalAmountAfterDiscounts)
    {
        $this->totalAmountAfterDiscounts = $totalAmountAfterDiscounts;
    }

    /**
     * @return float
     */
    public function getCouponDiscount(): float
    {
        return $this->couponDiscount;
    }

    /**
     * @param float $couponDiscount
     */
    public function setCouponDiscount(float $couponDiscount)
    {
        $this->couponDiscount = $couponDiscount;
    }

    /**
     * @return array
     */
    public function getTotalAmountsBeforeDiscountByCategory(): array
    {
        return $this->totalAmountsBeforeDiscountByCategory;
    }

    /**
     * @param array $totalAmountsBeforeDiscountByCategory
     */
    public function setTotalAmountsBeforeDiscountByCategory(array $totalAmountsBeforeDiscountByCategory)
    {
        $this->totalAmountsBeforeDiscountByCategory = $totalAmountsBeforeDiscountByCategory;
    }
}