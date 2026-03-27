<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'connect.php';

$warning_msg = [];
$success_msg = [];

$user_id = $_SESSION['user_id'] ?? '';

if (isset($_POST['add_to_cart'])) {

    /* GET PRODUCT ID */
    $product_id = trim($_POST['product_id'] ?? '');

    /* LOGIN CHECK */
    if ($user_id === '') {
        $warning_msg[] = 'Please login first';
    }

    /* PRODUCT VALIDATION */
    if ($product_id === '') {
        $warning_msg[] = 'Invalid product';
    }

    /* CHECK CART & WISHLIST */
    if (empty($warning_msg)) {

        // already in cart
        $check_cart = $conn->prepare(
            "SELECT id FROM cart WHERE user_id = ? AND product_id = ? LIMIT 1"
        );
        $check_cart->execute([$user_id, $product_id]);

        if ($check_cart->fetch()) {
            $warning_msg[] = 'Product already exists in your cart';
        }

        // already in wishlist
        $check_wishlist = $conn->prepare(
            "SELECT id FROM wishlist WHERE user_id = ? AND product_id = ? LIMIT 1"
        );
        $check_wishlist->execute([$user_id, $product_id]);

        if ($check_wishlist->fetch()) {
            $warning_msg[] = 'Product already exists in your wishlist';
        }
    }

    /* FETCH PRODUCT PRICE */
    if (empty($warning_msg)) {

        $price_stmt = $conn->prepare(
            "SELECT price FROM products WHERE id = ? LIMIT 1"
        );
        $price_stmt->execute([$product_id]);
        $product = $price_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            $warning_msg[] = 'Product not found';
        }
    }

    /* INSERT INTO CART */
    if (empty($warning_msg)) {

        $cart_id = uniqid('cart_', true);
        $qty = 1;

        $insert = $conn->prepare(
            "INSERT INTO cart (id, user_id, product_id, price, quantity)
             VALUES (?, ?, ?, ?, ?)"
        );

        if ($insert->execute([
            $cart_id,
            $user_id,
            $product_id,
            $product['price'],
            $qty
        ])) {
            $success_msg[] = 'Product added to cart 🛒';
        } else {
            $warning_msg[] = 'Failed to add product to cart';
        }
    }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
<?php if (!empty($warning_msg)): ?>
    swal({
        title: "Oops!",
        text: "<?= implode("\n", $warning_msg); ?>",
        icon: "error",
        button: "Ok",
    });
<?php elseif (!empty($success_msg)): ?>
    swal({
        title: "Success!",
        text: "<?= implode("\n", $success_msg); ?>",
        icon: "success",
        button: "Ok",
    });
<?php endif; ?>
</script>
