<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

$warning_msg = [];
$success_msg = [];

$user_id = $_SESSION['user_id'] ?? '';
if($user_id == ''){
   header('location:login.php');
   exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Boxicons -->
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="../css/user_style.css?v=<?= time(); ?>">

<title>Cosmika A Cosmetic Website Template</title>
</head>
<body>

<?php include 'user_header.php'; ?>

<div class="banner">
    <div class="detail">
      <h1>my order</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium <br>
        modi neque aut, voluptatem saepe non nemo sequi quas, animi reiciendis <br>
        vitae doloremque sed facilis est illo quisquam fugit obcaecati omnis.</p>
         <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>my order</span>
    </div>
</div>

<div class="orders">
    <div class="heading">
        <h1>my orders</h1>
        <img src="../images/separator.png">
    </div>

    <div class="box-container">
       <?php
$select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
$select_orders->execute([$user_id]);

if($select_orders->rowCount() > 0){

    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){

        $product_id = $fetch_orders['product_id'];

        $select_products = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
        $select_products->execute([$product_id]);

        if($select_products->rowCount() > 0){

            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
?>
            <div class="box">

                <a href="view_order.php?get_id=<?= $fetch_orders['id'] ?>">
                    <div class="icon-box">
                        <img src="../images/products/<?= $fetch_products['thumb_one']; ?>" class="img1">
                        <img src="../images/products/<?= $fetch_products['thumb_three']; ?>" class="img2">
                    </div>
                </a>

                <p class="date">
                    <i class="bx bxs-calendar-alt"></i>
                    <span><?= $fetch_orders['order_date']; ?></span>
                </p>

                <div class="content">
                    <div class="row">
                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                        <p class="price">₹<?= $fetch_products['price']; ?></p>

                        <p class="status"
                           style="color:
                           <?php
                               if($fetch_orders['status'] == 'confirm'){ echo 'green'; }
                               elseif($fetch_orders['status'] == 'canceled'){ echo 'red'; }
                               else { echo 'orange'; }
                           ?>">
                           <?= $fetch_orders['status']; ?>
                        </p>
                    </div>

                    <a href="rating.php?get_id=<?= $fetch_products['id']; ?>" class="btn">
                        give rating
                    </a>
                </div>

            </div>
<?php
        }
    }

} else {
    echo '<p class="empty">no orders placed yet!</p>';
}
?> 
        
        
       
    </div>
</div>









<?php include 'user_footer.php'; ?>

<!-- SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
<?php if(!empty($warning_msg)): ?>
    swal({
        title: "Oops!",
        text: "<?= implode("\\n", $warning_msg); ?>",
        icon: "error",
        button: "Ok",
    });
<?php elseif(!empty($success_msg)): ?>
    swal({
        title: "Success!",
        text: "<?= implode("\\n", $success_msg); ?>",
        icon: "success",
        button: "Ok",
    });
<?php endif; ?>
</script>

<script src="../js/user_script.js"></script>
</body>
</html> 