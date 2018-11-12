<?
include_once('./src/Category/Category.php');
include_once('./src/Cart/Cart.php');
include_once('./src/Product/Product.php');
include_once('./src/Cart/Service.php');
include_once('./src/DiscountType/DiscountType.php');
include_once('./src/Campaign/Campaign.php');
include_once('./src/Campaign/Service.php');
include_once('./src/Campaign/Service.php');
include_once('./src/Coupon/ICalculate.php');
include_once('./src/Coupon/Amount.php');
include_once('./src/Coupon/Rate.php');
include_once('./src/Coupon/Coupon.php');
include_once('./src/Coupon/Service.php');
include_once('./src/Delivery/Delivery.php');
include_once('./src/Delivery/Service.php');

$foodCategory = new \Category\Category('Food');
$electronicCategory = new \Category\Category('Electronic');
$mainBoardCategory = new \Category\Category('MainBoard', $electronicCategory);
$computerCategory = new \Category\Category('Computer');
$cart = \Cart\Cart::getInstance();
$discountTypeRate = DiscountType::RATE;
$discountTypeAmount = DiscountType::AMOUNT;

$product = new \Product\Product("Apple", 100, $foodCategory);
$product6 = new \Product\Product("Fan", 100, $electronicCategory);
$product7 = new \Product\Product("Huawei", 100, $electronicCategory);
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

$coupon1 = new \Coupon\Coupon(100, 25, DiscountType::RATE);

$foodCampaign2 = new \Campaign\Campaign($foodCategory, 10, 1, $discountTypeRate);
$electronicCampaign = new \Campaign\Campaign($electronicCategory, 10, 1, $discountTypeRate);
$mainBoard = new \Campaign\Campaign($mainBoardCategory, 10, 25, $discountTypeRate);
$computer = new \Campaign\Campaign($computerCategory, 25, 1, $discountTypeRate);

$cartService->applyDiscount($electronicCampaign, $mainBoard, $foodCampaign2, $computer);


$couponService = new \Coupon\Service($coupon1);
$couponService->applyCoupon();

$delivery = new \Delivery\Delivery(10, 10);

$deliveryService = new \Delivery\Service();

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

$totalAmountsAfterDiscountByCategory = $cart->getAppliedDiscountByCategories();
foreach ($cart->getProducts() as $category => $productList) {
    $table .= '<tr>';
    $table .= '<th>' . $category . '</th>';
    $table .= '<td>' . '</td>';
    $table .= '<td>' . '</td>';
    $table .= '<td>' . '</td>';
    $table .= '<td>' . '</td>';
    $table .= '<th>' . $totalAmountsAfterDiscountByCategory[$category] . '</th>';
    $table .= '</tr>';
    foreach ($productList as $product) {
        $table .= '<tr>';
        $table .= '<td>' . '</td>';
        $table .= '<td>' . $product->getTitle() . '</td>';
        $table .= '<td>' . $product->getQuantity() . '</td>';
        $table .= '<td>' . $product->getPrice() . '</td>';
        $table .= '<td>' . $product->getPrice() * $product->getQuantity() . '</td>';
        $table .= '<tr>';
    }
}

$table .= '</table>';

echo $table;
echo '<pre>' . "TOTAL AMOUNT && DELIVERY COST " . var_export($cart->getTotalAmountAfterDiscounts() . ' - ' . $deliveryService->getDeliveryCost($delivery) , true) . '</pre>';
