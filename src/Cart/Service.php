<?php

namespace Cart;

use Campaign\Campaign;
use Product\Product;

class Service
{
    public function addProductToCart(Product $newItem, $quantity = 1)
    {
        $cart = Cart::getInstance();
        $isNew = true;

        foreach ($cart->getProducts() as $category) {
            foreach ($category as $product) {
                if ($product->getTitle() === $newItem->getTitle()) {
                    $this->addQuantityToProduct($product, $quantity);
                    $isNew = false;
                }
            }
        }

        if ($isNew) {
            $products = $cart->getProducts();
            $newItem->setQuantity($quantity);
            is_array($products[$newItem->getCategory()->getTitle()]) ?: $products[$newItem->getCategory()->getTitle()] = [];
            array_push($products[$newItem->getCategory()->getTitle()], $newItem);
            $cart->setProducts($products);
        }

        return $cart;
    }

    public function addQuantityToProduct(Product $product, $quantity)
    {
        echo $product->getQuantity();
        $product->setQuantity($product->getQuantity() + $quantity);
    }


    public function getTotalAmountBeforeDiscount()
    {
        $cart = Cart::getInstance();
        $totalAmount = 0;

        foreach ($cart->getProducts() as $category => $products) {
            foreach ($products as $product) {
                $totalAmount += $product->getQuantity() * $product->getPrice();
            }
        }

        return $totalAmount;
    }

    public function getTotalAmountBeforeDiscountByCategory($category)
    {
        $cart = Cart::getInstance();
        $totalAmounts = 0;

        foreach ($cart->getProducts()[$category] as $product) {
            $totalAmounts += $product->getQuantity() * $product->getPrice();
        }

        return $totalAmounts;
    }

    public function calculateTotalAmountAfterDiscount()
    {
        $productsWithoutDiscount = 0;
        $amount = 0;
        $cart = Cart::getInstance();
        $discountAppliedCategories = $cart->getAppliedDiscountByCategories();
        $allProducts = $cart->getProducts();

        foreach ($allProducts as $category => $products) {
            foreach ($products as $product) {
                $amount += $product->getPrice() * $product->getQuantity();
            }

            if (!array_key_exists($category, $discountAppliedCategories)) {
                $productsWithoutDiscount += $amount;
            }

            $amount = 0;
        }

        $cart->setTotalAmountAfterCampaign($this->calculateTotalAmountAfterCampaign() + $productsWithoutDiscount);
        $cart->setCampaignDiscount($this->getTotalAmountBeforeDiscount() - $cart->getTotalAmountAfterCampaign());
        $cart->setTotalAmountAfterDiscounts($cart->getTotalAmountAfterDiscounts() + $cart->getTotalAmountAfterCampaign());
    }

    public function applyDiscount(...$campaigns)
    {
        $cart = Cart::getInstance();
        $discounts = [];
        empty($cart->getAppliedDiscount()) ?: $discounts[] = $cart->getAppliedDiscount();

        foreach ($campaigns as $campaign) {
            if ($campaign instanceof Campaign) {
                $discounts[] = $campaign;
            }
        }

        $existingCampaigns = \Campaign\Service::getExistingCampaigns(\Campaign\Service::groupCampaignByCategory($discounts));
        $allowedCampaigns = \Campaign\Service::getAllowedCampaigns($existingCampaigns);
        $bestCampaigns = \Campaign\Service::getBestCampaigns($allowedCampaigns);

        $appliedDiscountCategories = [];

        foreach ($bestCampaigns as $category => $campaign) {
            $totalAmountForThisCategory = $this->getTotalAmountBeforeDiscountByCategory($category);

            if ($campaign->getDiscountType() === \DiscountType::RATE) {
                $appliedDiscountCategories[$category] = ($totalAmountForThisCategory - ($totalAmountForThisCategory * ($campaign->getDiscount() / 100)));
            } elseif ($campaign->getDiscountType() === \DiscountType::AMOUNT) {
                $appliedDiscountCategories[$category] = $totalAmountForThisCategory - $campaign->getDiscount();
            }
        }

        $cart->setAppliedDiscountByCategories($appliedDiscountCategories);
        $this->calculateTotalAmountAfterDiscount();
    }

    public function calculateTotalAmountAfterCampaign()
    {
        $cart = Cart::getInstance();
        $totalAmount = 0;

        foreach ($cart->getAppliedDiscountByCategories() as $category => $amountOfAfterDiscount) {
            $totalAmount += $amountOfAfterDiscount;
        }

        return $totalAmount;
    }

    /**
     * @param Product[] $productList
     * @return int
     */
    public function getTotalCountForProduct($productList)
    {
        $count = 0;
        foreach ($productList as $product) {
            $count += $product->getQuantity();
        }

        return $count;
    }

    public function getCategoryCount()
    {
        return count(Cart::getInstance()->getProducts());
    }

    public function getProductCount()
    {
        $count = 0;

        foreach (Cart::getInstance()->getProducts() as $category => $products) {
            $count += count($products);
        }

        return $count;
    }
}