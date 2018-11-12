<?
include_once('src/Category/Category.php');
include_once('src/Cart/Cart.php');
include_once('src/Product/Product.php');
include_once('src/Cart/Service.php');
include_once('src/DiscountType/DiscountType.php');
include_once('src/Campaign/Campaign.php');
include_once('src/Campaign/Service.php');
include_once('src/Campaign/Service.php');
include_once('src/Coupon/Coupon.php');
include_once('src/Coupon/Service.php');
include_once('src/Delivery/Delivery.php');
include_once('src/Delivery/Service.php');

$foodCategory = new \Category\Category('Food');
$electronicCategory = new \Category\Category('Electronic');
$mainBoardCategory = new \Category\Category('MainBoard', $electronicCategory);
$computerCategory = new \Category\Category('Computer');
$cart1 = \Cart\Cart::getInstance();
$discountTypeRate = DiscountType::RATE;
$discountTypeAmount = DiscountType::AMOUNT;

$product = new \Product\Product("Apple", 100, $foodCategory);
$product6 = new \Product\Product("Fan", 100, $electronicCategory);
$product7 = new \Product\Product("Huwa", 100, $electronicCategory);
$product8 = new \Product\Product("Asus", 100, $computerCategory);
$product9 = new \Product\Product("Dell", 100, $computerCategory);
$product10 = new \Product\Product("Monitor", 100, $electronicCategory);
$product11 = new \Product\Product("Apple", 100, $foodCategory);
$product2 = new \Product\Product("Armut", 100, $foodCategory);
$product3 = new \Product\Product("Muz", 100, $foodCategory);
$product4 = new \Product\Product("Kayisi", 100, $foodCategory);
$product5 = new \Product\Product("Asus-MX4c", 100, $mainBoardCategory);
$cartService = new \Cart\Service();

$cartService->addProductToCart($product);
$cartService->addProductToCart($product2, 3);
$cartService->addProductToCart($product, 4);
$cartService->addProductToCart($product3);
$cartService->addProductToCart($product4);
$cartService->addProductToCart($product3);
$cartService->addProductToCart($product5);
$cartService->addProductToCart($product5);
$cartService->addProductToCart($product5);
$cartService->addProductToCart($product5, 12);
$cartService->addProductToCart($product6, 13);
$cartService->addProductToCart($product7, 15);
$cartService->addProductToCart($product8, 2);
$cartService->addProductToCart($product9, 5);
$cartService->addProductToCart($product9, 7);
$cartService->addProductToCart($product10, 2);
$cartService->addProductToCart($product11, 1);
echo ("<br>");

$coupon1 = new \Coupon\Coupon(100, 20, DiscountType::RATE);

echo "toplam ". $cartService->getTotalAmountBeforeDiscount();

echo  "<br>food";
echo $cartService->getTotalAmountBeforeDiscountByCategory("Food");
echo  "MainBoard <br>";
echo $cartService->getTotalAmountBeforeDiscountByCategory("MainBoard");
echo  "<br>Electronic <br>";
echo $cartService->getTotalAmountBeforeDiscountByCategory("Electronic");
echo  "<br> Comp <br>";
echo $cartService->getTotalAmountBeforeDiscountByCategory("Computer");


echo "<br>";
foreach ($cart1->getProducts() as $category => $productList) {
    echo "<br>" . $category;
    foreach ($productList as $product) {
        echo "<br>";
        echo $product->getTitle() . "-------";
        echo $product->getQuantity() . "------";
        echo $product->getCategory() !== null ? $product->getCategory()->getTitle() : null;
    }
}


echo "Creating new Campaign <br>";

$foodCampaign2 = new \Campaign\Campaign($foodCategory, 10, 1, $discountTypeRate);
$electronicCampaign = new \Campaign\Campaign($electronicCategory, 10, 1, $discountTypeRate);
$mainBoard = new \Campaign\Campaign($mainBoardCategory, 10, 1, $discountTypeRate);
$computer = new \Campaign\Campaign($computerCategory, 100, 1, $discountTypeRate);



//echo '<pre>' . var_export($foodCampaign, true) . '</pre>';
//echo '<pre>' . var_export($electronicCampaign, true) . '</pre>';
//echo '<pre>' . var_export($computerCampaign, true) . '</pre>';

echo "grouped Prods";

$cartService->applyDiscount($electronicCampaign, $mainBoard, $foodCampaign2, $computer);


$couponService = new \Coupon\Service($coupon1->getDiscountType());
$couponService->applyCoupon($coupon1);


echo '<pre>' . var_export($cart1->getTotalAmountAfterCampaign(), true) . '</pre>';
echo '<pre>' . var_export($cartService->getCategoryCount(), true) . '</pre>';
echo '<pre>' . var_export($cartService->getProductCount(), true) . '</pre>';


$delivery = new \Delivery\Delivery(10, 10);

$deliveryService = new \Delivery\Service();

echo '<pre>' . "Get TOTAL AMOUNT AFTER DISCOUNT ----" . var_export($cart1->getTotalAmountAfterDiscounts(), true) . '</pre>';
echo '<pre>' . "Get COUPON DISCOUNT - ---" . var_export($cart1->getCouponDiscount(), true) . '</pre>';
echo '<pre>' . "Get CAMPAIGN DISCOUNT- -- -" . var_export($cart1->getCampaignDiscount(), true) . '</pre>';
echo '<pre>' . "Get DELIVERY COST-----" . var_export($deliveryService->getDeliveryCost($delivery), true) . '</pre>';

$table = '<table>';
$table .= '<tr>';
$table .= '<th> Category Name </th>';
$table .= '<th> Product Name </th>';
$table .= '<th> Quantity </th>';
$table .= '<th> Unit Price </th>';
$table .= '<th> Total Price </th>';
$table .= '<th> Total Discount </th>';
$table .= '</tr>';
$table .= '<tr>';
foreach ($cart1->getProducts() as $category => $productList) {
    foreach ($productList as $product) {
        $table .= '<tr>';
        $table .= "<td> $category </td>";
        $table .= '<td>' . $product->getTitle() . '</td>';
        $table .= '<td>' . $product->getQuantity() . '</td>';
        $table .= '<td>' . $product->getPrice() . '</td>';
        $table .= '<td>' . $product->getPrice() * $product->getQuantity() . '</td>';
        $table .= '</tr>';
    }
}
$table .= '<td> </td>';
$table .= '<td> </td>';
$table .= '<td> </td>';
$table .= '<td> </td>';
$table .= '<td> </td>';
$table .= '<td> </td>';
$table .= '</tr>';
$table .= '</table>';

echo $table;


