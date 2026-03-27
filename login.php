<?php
session_start();
include 'connect.php';

$warning_msg = [];

if (isset($_POST['login'])) {

    $email    = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $warning_msg[] = "All fields are required";
    } else {

        $stmt = $conn->prepare(
            "SELECT id, name, password 
             FROM users 
             WHERE email = :email 
             LIMIT 1"
        );
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($password, $user['password'])) {

                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];

                setcookie(
                    'user_id',
                    $user['id'],
                    time() + (60 * 60 * 24 * 30),
                    "/"
                );

                header("Location: home.php");
                exit;

            } else {
                $warning_msg[] = "Incorrect password";
            }

        } else {
            $warning_msg[] = "Email not found";
        }
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
    <link rel="stylesheet" href="../css/user_style.css?v=<?= time(); ?>">

    <title>Cosmika A Cosmetic Website Template</title>
</head>
<body>

<?php include 'user_header.php'; ?>

<div class="banner">
    <div class="detail">
        <h1>Login</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
             Laudantium modi neque aut, voluptatem saepe non nemo  <br>
             sequi quas, animi reiciendis vitae doloremque sed  <br>
             facilis est illo quisquam fugit obcaecati omnis.</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>login</span>
    </div>
</div>

<div class="form-container" style="margin-left:300px; margin-top:20px; margin-bottom:20px;">
    <form action="" method="post" class="login">
        <h3>Login</h3>

        <div class="input-field">
            <p>Your email <span>*</span></p>
            <input type="email" name="email" placeholder="Enter your email" maxlength="100" required class="box">
        </div>

        <div class="input-field">
            <p>Your password <span>*</span></p>
            <input type="password" name="password" placeholder="Enter your password" maxlength="50" required class="box">
        </div>

        <p class="link" style="margin-left: 10px;">Don't have an account? <a href="register.php">Register now</a></p>
        <button type="submit" name="login" class="btn" style="margin-left: 5px;">Login</button>
    </form>
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
<?php endif; ?>
</script>

<script src="../js/user_script.js"></script>

</body>
</html>
