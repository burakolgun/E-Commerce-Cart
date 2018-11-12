<?php

namespace Campaign;

use Category\Category;

class Campaign
{
    private $category;
    private $minProductCount;
    private $discountType;
    private $discount = 0.0;

    /**
     * Campaign constructor.
     * @param $category
     * @param float $discount
     * @param $minProductCount
     * @param $discountType
     */
    public function __construct(Category $category, float $discount, int $minProductCount, $discountType)
    {
        $this->setCategory($category);
        $this->setDiscount($discount);
        $this->setMinProductCount($minProductCount);
        $this->setDiscountType($discountType);

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getMinProductCount()
    {
        return $this->minProductCount;
    }

    /**
     * @param mixed $minProductCount
     */
    public function setMinProductCount($minProductCount)
    {
        $this->minProductCount = $minProductCount;
    }

    /**
     * @return mixed
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }

    /**
     * @param mixed $discountType
     */
    public function setDiscountType($discountType)
    {
        $this->discountType = $discountType;
    }
}