<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'] ?? '';

if($user_id == ''){
   header('location:login.php');
   exit;
}

$success_msg = [];
$warning_msg = [];

/* ================= DELETE ITEM ================= */
if(isset($_POST['delete'])){

    $cart_id = (int)$_POST['wishlist_id'];

    $stmt = $conn->prepare("DELETE FROM wishlist WHERE id = ? AND user_id = ?");
    $stmt->execute([$wishlist_id, $user_id]);

    $success_msg[] = "wishlist item deleted";
}

/* ================= UPDATE QTY ================= 
if(isset($_POST['update_wishlist'])){

    $cart_id = (int)$_POST['wishlist_id'];
    $qty = (int)$_POST['qty'];

    if($qty < 1) $qty = 1;

    $stmt = $conn->prepare("UPDATE wishlist SET qty = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$qty, $wishlist_id, $user_id]);

    $success_msg[] = "wishlist updated successfully";
}*/

/* ================= EMPTY CART ================= 
if(isset($_POST['empty_wishlist'])){

    $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $success_msg[] = "wishlist emptied successfully";
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/user_style.css?v=<?= time(); ?>">
<title>Cart</title>
</head>
<body>

<?php include 'user_header.php'; ?>

<div class="products">
<div class="heading">
<h1 style="text-align:center;">Products in your wishlist</h1>
<img src="../images/separator.png">
</div>
<div class="box-container">

<?php
  $select_wishlist = $conn->prepare("SELECT * FROM whishlist WHERE user_id = ?");
  $select_wishlist->execute([$user_id]);

  if($select_wishlist->rowCount() > 0){
    while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
        $select_products =$conn->prepare("SELECT * FROM products WHERE id = ?");
        $select_products->execute([$fetch_wishlist]);

        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

          


?>
<form action="" method="post" class="box<?php if($fetch_products['stock'] == 0){echo'disabled';} ?>">
    <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
    <div class="icon">
        <div class="icon-box">
            <img src="../images/products/<?= $fetch_products['thumb_one'] ?>" class="img1">
            <img src="../images/products/<?= $fetch_products['thumb_two'] ?>" class="img2">
        </div>
    </div>
    <?php if($fetch_products['stock']> 9){ ?>
    <span class="stock" style="color: green;">in stock</span>
    <?php }elseif($fetch_products['stock']> 9){ ?>
    <span class="stock" style="color: red;">out of stock</span>
    <?php }else{ ?>
    <span class="stock" style="color: red;">hurry only <?= $fetch_products['stock'] ?></span>
    <?php } ?>
    <div class="flex">
        <p class="price">
            <?= $fetch_products['stock'] ?>
        </p>
    </div>
    <div class="content">
        <div class="button">
            <div><h3 class="name"><?= $fetch_products['name']; ?></h3></div>
        </div>
        <button type="submit" name="add_to cart"><i class="bx bx-cart"></i></button>
        <a href="view_page.php?get_id=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
        <button type="submit" name="delete" onclick="return confirm('remove from wishlist');"></button>
    </div>
    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
    <div class="flex-btn">
        <input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2">
        <a href="chechout.php?get_id=<?= $fetch_products['id']; ?>" class="btn" style="width: 100%;">Buy now</a>
    
    </div>
</form>
<?php 
         }
        }
    }
  }else{
            echo'
            <div class="empty">
            <p> no products added  in your wishlist</p>
            </div>
            ';
        }

?>

</div>

<?php include 'user_footer.php'; ?>
<!-- SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/user_script.js"></script>
</body>
</html>