<?php

namespace Delivery;

use Cart\Cart;

class Service
{
    public static function getDeliveryCost(Delivery $delivery, \Cart\Service $cartService)
    {
        Cart::getInstance()->setDeliveryCost(
            ($delivery->getCostPerDelivery() * $cartService->getCategoryCount()) +
            ($delivery->getCostPerProduct() * $cartService->getProductCount()) +
            $delivery->getFixedCost()
        );

        return Cart::getInstance()->getDeliveryCost();
    }
}