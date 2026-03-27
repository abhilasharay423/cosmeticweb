<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

$warning_msg = [];
$success_msg = [];

$user_id = $_SESSION['user_id'] ?? '';

$seller_id = $_SESSION['seller_id'] ?? '';
if($seller_id == ''){
   header('location:login.php');
   exit;
}

$select_product = $conn->prepare("SELECT * FROM products WHERE seller_id = ?");
$select_product->execute([$seller_id]);
$total_product = $select_product->rowCount();

$select_order = $conn->prepare("SELECT * FROM order WHERE seller_id = ?");
$select_order->execute([$seller_id]);
$total_order = $select_order->rowCount();
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
      <h1>my profile</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium <br>
        modi neque aut, voluptatem saepe non nemo sequi quas, animi reiciendis <br>
        vitae doloremque sed facilis est illo quisquam fugit obcaecati omnis.</p>
         <span><a href="dashboard.php">home</a><i class="bx bx-right-arrow-alt"></i>my profile</span>
    </div>
</div>

<div class="profile">
    <div class="heading">
        <h1>seller profile</h1>
        <img src="../images/separator.png" alt="">
    </div>
    <div class="details">
        <div class="user">
            <img src="../uploaded_files/<?= $fetch_profile['image'] ?>">
            <h3><?= $fetch_profile['name'] ?>"</h3>
            <p>seller</p>
            <a href="update.php" class="btn">update profile</a>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="flex">
                    <i class="bx bxs-food-menu"></i>
                    <h3><?= $total_order; ?></h3>
                </div>
                <a href="order.php" class="btn">view orders</a>
            </div>
            <div class="box">
                <div class="flex">
                    <i class="bx bxs-chat"></i>
                    <h3><?= $total_products; ?></h3>
                </div>
                <a href="contact.php" class="btn">stotal products</a>
            </div>
        </div>
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
