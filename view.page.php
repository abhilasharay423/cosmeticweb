<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

$warning_msg = [];
$success_msg = [];

$user_id = $_SESSION['user_id'] ?? '';

 $get_id = $_GET['get_id'];

include '../components/add_to_cart.php';
include '../components/add_to_wishlist.php';

      

     

        

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
      <h1>view product</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium <br>
        modi neque aut, voluptatem saepe non nemo sequi quas, animi reiciendis <br>
        vitae doloremque sed facilis est illo quisquam fugit obcaecati omnis.</p>
         <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>view product</span>
    </div>
</div>

<div class="view_page">
    <div class="heding" style="margin-top: 3rem;">
        <span>product description</span>
        <h1>we are passionate about making beautiful more beautiful</h1>
        <img src="../images/separator.png">
    </div>
    <?php 
    if(isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];

        $select_product = $conn->prepare("SELECT * FROM products WHERE id ='$get_id'");
        $select_product->execute();

        if($select_product->rowCount() > 0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){

         
    ?>
    <form action="" method="post" class="box">
        <div class="thumb">
        <div class="big-image">
            <img src="../images/products/<?= $fetch_products['thumb_one']; ?>">
        </div>
        <div class="small-image">
            <img src="../images/products/<?= $fetch_products['thumb_two']; ?>">
            <img src="../images/products/<?= $fetch_products['thumb_three']; ?>">
            <img src="../images/products/<?= $fetch_products['thumb_four']; ?>">
            <img src="../images/products/<?= $fetch_products['thumb_one']; ?>">
        </div>
    </div>
    <div class="detail">
        <?php if($fetch_products['stock']> 9){ ?>
    <span class="stock" style="color: green;">in stock</span>
    <?php }elseif($fetch_products['stock']> 9){ ?>
    <span class="stock" style="color: red;">out of stock</span>
    <?php }else{ ?>
    <span class="stock" style="color: red;">hurry only <?= $fetch_products['stock'] ?></span>
    <?php } ?>
    <p class="price">
            <?= $fetch_products['stock'] ?>
        </p>
        <div><h3 class="name"><?= $fetch_products['name']; ?></h3></div>
        <p class="product-detail">
            <?= $fetch_products['product-detail'] ?>
        </p>
            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

            <button type="submit" name="add_to cart" class="btn"><i class="bx bx-cart"></i>add to wishlist</button>
                    <input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2">
            <button type="submit" name="add_to wishlist" class="btn"><i class="bx bx-heart">add to cart</i></button>
    </div>
    </form>
    <?php 
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


<script>
    <?php include '../js/user_script.js' ?>
</script>
</body>
</html>
