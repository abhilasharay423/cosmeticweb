<?php
include_once 'connect.php';

$user_id = $_COOKIE['user_id'] ?? '';
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
      <h1>about us</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium <br>
        modi neque aut, voluptatem saepe non nemo sequi quas, animi reiciendis <br>
        vitae doloremque sed facilis est illo quisquam fugit obcaecati omnis.</p>
         <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
</div>

<div class="who">
  <div class="box-container">
    <div class="box">
     <div class="heading">
        <span style="color: red; text-transform: capitalize; font-size:2rem;">who we are</span>
        <h1>We are passionate about making beautiful more beautiful</h1>
        <img src="../images/separator.png">
     </div>
     <p>Maria is a Roman-born pastry chef who spent 15 years in his city Rome <br>
        perfecting his craft and exceptional creations. Vestibulum rhoncus ornare <br>
        tincudunt. Etiam pretium metus sit amet est aliquet vulputate. Fusce et cursus <br>
        ligula. Sed accumsan dictum porta. Aliquam rutrum ullamcorper velit hendrerit <br>
        convallis. </p>
        <div class="flex-btn">
            <a href="shop.php" class="btn">explore more menu</a>
            <a href="shop.php" class="btn">visit our shop</a>
        </div>
    </div>
    <div class="img-box">
        <img src="../images/about0.jpg" class="img">
    </div>
  </div>  
</div>
<!-----banner who end---->
<div class="help">
  <div class="box-container">
    <div class="box">
      <img src="../images/icon0.webp">
      <h1>100% secure payments</h1>
      <p>Feel the summer mood with our latest exclusive clothes collection featuring 
         bright colors and hand-painted ornaments!</p>
    </div>
    <div class="box">
      <img src="../images/icon.webp">
      <h1>beauty assistant</h1>
      <p>Feel the summer mood with our latest exclusive clothes collection featuring 
         bright colors and hand-painted ornaments!</p>
    </div>
    <div class="box">
      <img src="../images/icon1.webp">
      <h1>help center</h1>
      <p>Feel the summer mood with our latest exclusive clothes collection featuring 
         bright colors and hand-painted ornaments!</p>
    </div>
  </div>
</div>
<!------help section end---->
<div class="exclusive">
  <div class="detail">
    <h1>EXCLUSIVE cosmetics <br> SUMMER COLLECTION 2025</h1>
    <p>Feel the summer mood with our latest exclusive clothes collection <br> featuring 
         bright colors and hand-painted ornaments!</p>
         <a href="shop.php" class="btn">shop now</a>
  </div>
</div>
<!----exclisive section end---->
<div class="cms-banner">
  <div class="box-container">
    <div class="box">
      <img src="../images/cms-banner.png">
        <div class="detail">
          <span>get upto 35% discount</span>
          <h1>on popular <br> brands</h1>
          <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
    <div class="box">
      <img src="../images/cms-banner0.png">
        <div class="detail">
          <span>flat 15% discount</span>
          <h1>on men's <br>skin care</h1>
          <a href="shop.php" class="btn">shop now</a>
        </div>
    </div>
  </div>
</div>
<!----cms banner section end---->
<div class="story">
  <div class="box">
    <div class="heading">
      <span style="color: wheat; text-transform:uppercase; padding-bottom: .5rem; font-size: 2.3rem;">
        fresh & latest</span>
        <h1>Discount up to 30% for your <br> first purchase.</h1>
        <span style="color: wheat; text-transform: uppercase; padding-bottom: .5rem; font-size: 2.3rem;">
         get 20% extra</span>
    </div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde <br>
     voluptates, et saepe placeat quia doloribus, ut, beatae est rerum <br>
     nulla laudantium. Eaque hic consectetur facilis minus voluptatem <br>
     similique, rerum dolorum! Lorem ipsum dolor sit amet consectetur <br>
      adipisicing elit. Debitis quod quisquam mollitia corporis neque <br>
      autem laudantium, minus, ea quo magnam iste placeat doloribus <br>
      tempora commodi hic nulla fuga cum. Temporibus!</p>
      <a href="contact.php" class="btn">our services</a>
  </div>
</div>
<!----story section end---->
<div class="team">
  <div class="heading">
    <span style="color:red; font-size:2rem; text-transform:capitalize;">our team</span>
    <h1 style="font-size: 1.5rem;">quality & passion with our services</h1>
    <img src="../images/separator.png">
  </div>
  <div class="box-container">
    <div class="box">
      <img src="../images/team.jpg" class="img">
      <div class="content">
        <h2>fiona edwards</h2>
        <p>makeup expert</p>
        <div class="icons">
           <i class="bx bxl-facebook"></i>
                  <i class="bx bxl-instagram"></i>
                  <i class="bx bxl-linkedin"></i>
                  <i class="bx bxl-twitter"></i>
                  <i class="bx bxl-pinterest-alt"></i>
        </div>
      </div>
    </div>
    <!-----team card end--->
     <div class="box">
      <img src="../images/team0.jpg" class="img">
      <div class="content">
        <h2>ralph johnson</h2>
        <p>cosmetic experts</p>
        <div class="icons">
           <i class="bx bxl-facebook"></i>
                  <i class="bx bxl-instagram"></i>
                  <i class="bx bxl-linkedin"></i>
                  <i class="bx bxl-twitter"></i>
                  <i class="bx bxl-pinterest-alt"></i>
        </div>
      </div>
    </div>
    <!-----box card end--->
     <div class="box">
      <img src="../images/team1.jpg" class="img">
      <div class="content">
        <h2>Selena Ansari</h2>
        <p>hair expert</p>
        <div class="icons">
           <i class="bx bxl-facebook"></i>
                  <i class="bx bxl-instagram"></i>
                  <i class="bx bxl-linkedin"></i>
                  <i class="bx bxl-twitter"></i>
                  <i class="bx bxl-pinterest-alt"></i>
        </div>
      </div>
    </div>
    <!-----box card end--->
     <div class="box">
      <img src="../images/team.jpg" class="img">
      <div class="content">
        <h2>fiona edwards</h2>
        <p>manager</p>
        <div class="icons">
           <i class="bx bxl-facebook"></i>
                  <i class="bx bxl-instagram"></i>
                  <i class="bx bxl-linkedin"></i>
                  <i class="bx bxl-twitter"></i>
                  <i class="bx bxl-pinterest-alt"></i>
        </div>
      </div>
    </div>
    <!-----box card end--->
  </div>
</div>
   <!----- team box card end--->
<div class="about">
  <div class="box-container">
    <div class="box">
      <img src="../images/about.jpg">
    </div>
    <div class="box">
      <div class="heading">
        <span>about company</span>
        <h1>latest & trendy cosmetic <br> Provider website</h1>
      </div>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quod voluptatum 
         velit repudiandae eius nihil, ipsam voluptates qui tempora modi vero dolor, aspernatur
          nam omnis! Molestiae, nobis beatae. Exercitationem, vitae? Lorem ipsum dolor sit amet 
          consectetur adipisicing elit. Quisquam, vel veniam rem architecto omnis cupiditate 
          repellat eius aut sit dolorem! Voluptas, a aperiam? Commodi voluptas obcaecati 
          atque rem quasi exercitationem.</p>
          <div class="flex-btn">
            <a href="shop.php" class="btn">explore products</a>
            <a href="contact.php" class="btn">any query contact us</a>
          </div>
    </div>
  </div>
</div>
<!----about section end---->
<div class="choose">
  <div class="box-container">
    <div class="img-box">
      <img src="../images/about1.jpg">
    </div>
    <div class="box">
      <div class="heading">
        <span style="color: red; font-size:2rem; text-transform:capitalize;">why choose us</span>
        <h1>Special Care For Our Every <br> makeup Lovers</h1>
      </div>
      <div class="box-detail">
        <div class="detail">
          <img src="../images/discount.png">
          <h2>discounts option</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <span>1</span>
        </div>
        <div class="detail">
          <img src="../images/gift.png">
          <h2>gift offers</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <span>2</span>
        </div>
        <div class="detail">
          <img src="../images/return.png">
          <h2>best return policy</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <span>3</span>
        </div>
        <div class="detail">
          <img src="../images/support.png">
          <h2>best online support</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <span>4</span>
        </div>
      </div>
    </div>
  </div>
</div>
<img src="../images/lips.webp" class="sub-banner" style="margin-bottom: 2rem 0;">
<!----choose section end---->
<div class="mission">
  <div class="box-container">

    <div class="box">
      <div class="heading">
        <span style="text-transform: capitalize; color: red; font-size: 2rem;">our mission</span>
        <h1 style="font-size: 1.6rem;">latest make up the big smile</h1>
        <img src="../images/separator.png">
      </div>

      <div class="detail">
        <div class="img-box">
          <img src="../images/m-icon.png">
        </div>
        <h2>latest makeup</h2> 
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>

      <div class="detail">
        <div class="img-box">
          <img src="../images/m-icon0.png">
        </div>
        <h2>delivery in 24 hours</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>

      <div class="detail">
        <div class="img-box">
          <img src="../images/m-icon1.png">
        </div>
        <h2>order online</h2>
        <br><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>

      <div class="detail">
        <div class="img-box">
          <img src="../images/m-icon2.png">
        </div>
        <h2>24/7</h2><br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
      </div>
    </div>
     <div class="box">
      <img src="../images/mission.jpg" class="img">
    </div>
    </div>
</div>
<!----mission section end---->
<div class="about-banner">
  <div class="box-container">
    <div class="box">
      <img src="../images/about-banner.png">
      <div class="detail">
        <span>shop seasonal</span>
        <h2>50% off</h2>
        <h1>all seasonal products</h1>
        <a href="shop.php" class="btn">shop now</a>
      </div>
    </div>
    <div class="box">
      <img src="../images/about-banner0.png">
      <div class="detail">
        <span>shop seasonal</span>
        <h2>60% off</h2>
        <h1>all seasonal products</h1>
        <a href="shop.php" class="btn">shop now</a>
      </div>
    </div>
  </div>
</div>









<!----about-banner section end---->
<!----exclisive section end---->
<?php include 'user_footer.php'; ?>




<!-- SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>





<script type="text/javascript" src="../js/user_script.js"></script>
    




</body>

</html>
