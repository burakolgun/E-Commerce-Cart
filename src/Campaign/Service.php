<?php

namespace Campaign;

use Cart\Cart;

class Service
{
    /**
     * @param Campaign[] $campaigns
     * @return array
     */
    public static function groupCampaignByCategory($campaigns)
    {
        $groupedCampaigns = [];
        foreach ($campaigns as $campaign) {
            is_array($groupedCampaigns[$campaign->getCategory()->getTitle()]) ?: $groupedCampaigns[$campaign->getCategory()->getTitle()] = [];
            $groupedCampaigns[$campaign->getCategory()->getTitle()][] = $campaign;
        }

        return $groupedCampaigns;
    }


    public static function getExistingCampaigns($groupedCampaigns)
    {
        $cart = Cart::getInstance();
        $existCampaigns = [];
        foreach ($cart->getProducts() as $category => $product) {
            if (array_key_exists($category, $groupedCampaigns) && $cart->getProducts()[$category]) {
                $existCampaigns[$category] = $groupedCampaigns[$category];
            }
        }

        return $existCampaigns;
    }

    public static function getAllowedCampaigns($existCampaigns)
    {
        $cart = Cart::getInstance();
        $allowedCampaigns = [];
        $cartService = new \Cart\Service();

        foreach ($existCampaigns as $category => $campaigns) {
            foreach ($campaigns as $campaign) {
                if ($campaign->getMinProductCount() <= $cartService->getTotalCountForProduct($cart->getProducts()[$category])) {
                    $allowedCampaigns[$category][] = $campaign;
                }
            }
        }

        return $allowedCampaigns;
    }

    public static function getBestCampaigns($existCampaigns)
    {
        foreach ($existCampaigns as $category => $campaigns) {
            if (count($existCampaigns[$category]) > 0) {
                $min = 0;
                foreach ($campaigns as $campaign) {
                    if ($min < $campaign->getDiscount()) {
                        $min = $campaign->getDiscount();
                        $existCampaigns[$category] = $campaign;
                    }
                }
            } else {
                $existCampaigns[$category] = $existCampaigns[$category][0];
            }
        }

        return $existCampaigns;
    }
}