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

if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $verify_delete =$conn->prepare("SELECT * FROM users WHERE id ?");
    $verify_delete->execute([$delete_id]);

    if($delete_id->rowcount() > 0){
        $delete_user = $conn->prepare("DELETE FROM users WHERE id = ?");
        $delete_user->execute([$delete_id]);

        $success_msg[] = 'user deleted ';
    }else{
        $warning_msg[] = 'user already deleted';
    }
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
      <h1>registered user's</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium <br>
        modi neque aut, voluptatem saepe non nemo sequi quas, animi reiciendis <br>
        vitae doloremque sed facilis est illo quisquam fugit obcaecati omnis.</p>
         <span><a href="dashboard.php">dashboard</a><i class="bx bx-right-arrow-alt"></i>registered user's</span>
    </div>
</div>

<div class="user-container">
<div class="heading">
    <h1 style="font-size: 50px; padding-bottom: 10px;">registered user's</h1>
</div>
<form action="" method="post"  class="search-form">
  <input type="text" name="search_box" placeholder="search_user's" maxlength="100" required>
    <button type="submit" name="search_btn" class="bx bx-search-alt"></button> 
</form>
<div class="box-container">
    <?php 
    if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
        $search_box = $_POST['search_box'];
          $search_box = htmlspecialchars($_POST['search_box']);
        $select_user = $conn->prepare("SELECT * FROM users WHERE name LIKE '%{$search_box}%' OR email LIKE '%{$search_box}%'");
        $select_user->execute();

    }else{
        $select_user = $conn->prepare("SELECT * FROM users");
        $select_user->execute();

    }
    if($select_user->rowCount() > 0){
        while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){

    
   
    ?>
    <div class="box">
        <img src="../uploaded_files/<?= $fetch_user['image'] ;?>">
        <div class="detail">
            <p>user id : <span><?= $fetch_user['id']; ?></span></p>
             <p>user name : <span><?= $fetch_user['name']; ?></span></p>
              <p>user email: <span><?= $fetch_user['email']; ?></span></p>
       
   
     <form action="" method="post">
        <input type="hidden" name="delete_id" value="<?= $fetch_user['id']; ?>">
        <button type="submit" name="delete" onclick="return confirm('delete this account')" class="btn">delete user</button>
      </form>
     </div>
    </div>
    <?php 
        }
     }elseif(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
        header('location:notfound.php');
     }else{
            echo'
         <div class="empty">
          <p>no user registered yet! </p>
          </div>';
        }
    
    ?>
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
