<?php

namespace Delivery;

class Service
{
    public function getDeliveryCost(Delivery $delivery)
    {
        $cartService = new \Cart\Service();

        return ($delivery->getCostPerDelivery() * $cartService->getCategoryCount()) +
            ($delivery->getCostPerProduct() * $cartService->getProductCount()) +
            Delivery::FIXED_COST;
    }

}