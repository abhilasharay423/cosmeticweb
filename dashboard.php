<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . '/../components/connect.php';

$warning_msg = [];
$success_msg = [];

$seller_id = $_SESSION['seller_id'] ?? '';
if($seller_id == ''){
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
<link rel="stylesheet" href="../css/admin_style.css?v=<?= time(); ?>">

<title>Cosmika A Cosmetic Website Template</title>
</head>
<body>


<?php include __DIR__ . '/../components/admin_header.php'; ?>

<div class="banner">
    <div class="detail">
      <h1>dashboard</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium <br>
        modi neque aut, voluptatem saepe non nemo sequi quas, animi reiciendis <br>
        vitae doloremque sed facilis est illo quisquam fugit obcaecati omnis.</p>
         <span><a href="dashboard.php">admin</a><i class="bx bx-right-arrow-alt"></i>dashboard</span>
    </div>
</div>

<div class="dashboard">
    <div class="heading">
        <h1>dashboard</h1>
        <img src="../images/separator.png">
    </div>
    <div class="box-container">
        <h3>welcome !</h3>
        <p><?= $fetch_profile['name'] ?></p>
        <a href="update.php" class="btn">update profile</a>
    </div>
    <div class="box">
        <?php 
        $total_pendings = 0;
        $select_pendings = $conn->prepare("SELECT * FROM orders WHERE payment_status = ? AND seller_id = ?");
        $select_pendings->execute(['pending',$seller_id]);

        while($fetch_pending = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pending['price'];
        }
        ?>
        <h3>$ <?= $total_pendings; ?>/-</h3>
        <p>total pending</p>
        <a href="admin_order.php" class="btn">see orders</a>
    </div>

     <div class="box">
        <?php 
        $total_confirm = 0;
        $select_confirm = $conn->prepare("SELECT * FROM orders WHERE payment_status = ? AND seller_id = ?");
        $select_confirm->execute(['completed',$seller_id]);

        while($fetch_confirm = $select_confirm->fetch(PDO::FETCH_ASSOC)){
            $total_confirm += $fetch_confirm['price'];
        }
        ?>
        <h3>$ <?= $total_confirm; ?>/-</h3>
        <p>total confirm</p>
        <a href="admin_order.php" class="btn">see orders</a>
    </div>

    <div class="box">
        <?php 
       
        $select_message = $conn->prepare("SELECT * FROM message ");
        $select_message->execute();
        $total_message = $select_message->rowCount();
      
        ?>
        <h3> <?= $total_message; ?></h3>
        <p>total message</p>
        <a href="admin_message.php" class="btn">see message</a>
    </div>

<div class="box">
        <?php 
       
        $select_sellers = $conn->prepare("SELECT * FROM sellers ");
        $select_sellers->execute();
        $total_sellers = $select_sellers->rowCount();
      
        ?>
        <h3> <?= $total_sellers; ?></h3>
        <p>total sellers</p>
        <a href="sellers.php" class="btn">registered sellers</a>
    </div>

<div class="box">
        <?php 
       
        $select_users = $conn->prepare("SELECT * FROM users ");
        $select_users->execute();
        $total_users = $select_users->rowCount();
      
        ?>
        <h3> <?= $total_users; ?></h3>
        <p>total users</p>
        <a href="users.php" class="btn">registered users</a>
    </div>

<div class="box">
        <?php 
       
        $select_products = $conn->prepare("SELECT * FROM products");
        $select_products->execute();
        $total_products = $select_products->rowCount();
      
        ?>
        <h3> <?= $total_products; ?></h3>
        <p> products added</p>
        <a href="add_products.php" class="btn">add new products</a>
    </div>

<div class="box">
        <?php 
       
        $select_active_products = $conn->prepare("SELECT * FROM products WHERE seller_id = ? AND status = ?");
        $select_active_products->execute([$seller_id, 'active']);
        $total_active_products = $select_active_products->rowCount();
      
        ?>
        <h3> <?= $total_active_products; ?></h3>
        <p>active products </p>
        <a href="add_products.php" class="btn">active products</a>
    </div>

    <div class="box">
        <?php 
       
        $select_deactive_products = $conn->prepare("SELECT * FROM products WHERE seller_id = ? AND status = ?");
        $select_deactive_products->execute([$seller_id, 'deactive']);
        $total_deactive_products = $select_deactive_products->rowCount();
      
        ?>
        <h3> <?= $total_deactive_products; ?></h3>
        <p>deactive products </p>
        <a href="add_products.php" class="btn">deactive products</a>
    </div>

  <div class="box">
        <?php 
       
        $select_review = $conn->prepare("SELECT * FROM review");
        $select_review->execute();
        $total_review = $select_review->rowCount();
      
        ?>
        <h3> <?= $total_review; ?></h3>
        <p>total review </p>
        <a href="comments.php" class="btn">view reviews</a>
    </div>

      <div class="box">
        <?php 
       
        $select_orders = $conn->prepare("SELECT * FROM orders WHERE seller_id = ?");
        $select_orders->execute([$seller_id]);
        $total_orders = $select_orders->rowCount();
      
        ?>
        <h3> <?= $total_orders; ?></h3>
        <p>total order </p>
        <a href="admin_order.php" class="btn">view orders</a>
    </div>


</div>










<?php include __DIR__ . '/../components/admin_footer.php'; ?>


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

<script src="../js/admin_script.js"></script>

<?php include __DIR__ . '/../components/alert.php'; ?>


</body>
</html>
