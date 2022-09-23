<?php
include('../db/connect.php');
?>
<?php
if (!isset($_SESSION['dangnhap_home'])) {
    header('Location: login.php');
}
if (isset($_GET['loginn'])) {
    $logout = $_GET['loginn'];
} else {
    $logout = '';
}
if ($logout == 'logout') {
    session_destroy();
    header('Location: index.php');
}
?>
<?php
if (isset($_POST['booking'])) {
    $madonhang = rand(0,9999);
    $occasion = $_POST['occasion'];
    $food_name = $_POST['food_name'];
    $loaiban = $_POST['loaiban'];
    $kh_name = $_POST['kh_name'];
    $kh_phone = $_POST['kh_phone'];
    $songuoi = $_POST['songuoi'];
    $ngaythang = $_POST['ngaythang'];
    $gio = $_POST['gio'];

$sql_insert_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(madonhang,ngaythang,loaiban,songuoi,food_name,occasion,gio,kh_name,kh_phone)
values('$madonhang','$ngaythang','$loaiban','$songuoi','$food_name','$occasion','$gio','$kh_name','$kh_phone')");
$check = mysqli_query($con,$sql_insert_donhang);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIEN RESTAURANT</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../frontend/res.css">
    <link rel="stylesheet" href="./webstyle.css">
    <link rel="stylesheet" href="../fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrer-policy="no-referrer" />
    <script>
        src = "https://kit.fontawesome.com/54f0cb7e4a.js";
        crossorigin = "anonymous"
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
    <section class="top">
        <div class="container">
            <div class="row justify-content">
                <div class="logo"><img src="../frontend/image/logo.png" alt=""></div>
                <div class="logout">
                    <p>XIN CHÀO : <?php echo $_SESSION['dangnhap_home'] ?> </p>
                    <button class="logout-button"><a href="?loginn=logout">LOG OUT</a></button>
                </div>
                <div class="menu-bar">
                    <span></span>
                </div>
                
                <div class="menu-items">
                    <ul>
                        <a href="#home">Home</a><br>
                        <a href="#aboutus">About us</a> <br>
                        <a href="#menu">Menu</a><br>
                        <a href="#gallery">Gallery</a><br>
                        <a href="#room">Party Room</a><br>
                        <a href="#contact">Contact</a>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="home" class="background">
        <div class="background-content" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
            <h2>European Restaurant </h2>
            <p>Come and experience it yourself!</p>
            <a href="#booking">
                <button class="background-content btn">BOOK NOW</button>
            </a>
        </div>
    </section>

    <!---------------------------------------------ABOUT-US------------------------------------->
    <section id="aboutus" class="about section-pading ">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>About Us</h2>
                </div>
            </div>
            <div class="row">
                <div class="about-item" data-aos="fade-up-right" data-aos-easing="linear" data-aos-duration="1500">
                    <h2>WELCOME TO KIEN RESTAURANT</h2>
                    <p>
                        Our restaurant was established and grown in 2008 after those arduous days. The finest dishes of
                        Europe can be found right on the menu of our restaurant.
                        If the cooking method creates the soul of a dish, the ingredients make up its body. Kien
                        Restaurant has chosen a rather thorny path in choosing ingredients for its dishes, and has
                        written its own story.
                        With a menu of European dishes, the restaurant has worked hard to find the source of fresh
                        European ingredients right after the harvest.
                        The restaurant has a rich menu to satisfy the dining needs of customers.
                    </p>
                </div>
                <div class="about-item" data-aos="fade-up-left" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="about-item-img">
                        <span>+10 years of experience</span>
                        <img src="../frontend/image/content1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--------------------------------------------------------MENU---------------------------------------------------->
    <section id="menu" class="menu section-pading">

        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>MENU LIST</h2>
                </div>
            </div>
            <div class="row">
                <div class="menu-title">
                    <?php
                    $sql_category = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id  ASC");
                    ?>

                    <?php
                    while ($row_category = mysqli_fetch_array($sql_category)) {
                    ?>
                        <button class="menu-button" data-title="<?php echo $row_category['category_id'] ?>"><?php echo $row_category['category_name'] ?></button>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            $sql_category = mysqli_query($con, "SELECT * FROM tbl_category");
            ?>
            <?php
            while ($row_category = mysqli_fetch_array($sql_category)) {
            ?>
                <div class="menu-content " id="<?php echo $row_category['category_id'] ?>">
                    <?php
                    $id = $row_category['category_id'];
                    $sql_product = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE category_id = $id ");
                    ?>
                    <?php
                    while ($row_product = mysqli_fetch_array($sql_product)) {
                    ?>
                        <div class="list-items">
                            <div class="list-item">
                                <img src="../upload/<?php echo $row_product['sanpham_image'] ?>" alt="">
                                <p><?php echo $row_product['sanpham_name'] ?></p>
                            </div>
                            <div class="list-price">
                                <p><?php echo $row_product['sanpham_gia']?>$</p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>

            <?php
            }
            ?>


    </section>


    <!---------------------------------------------Some foods------------------------------------------->
    <section id="gallery" class="some-foods">
        <div class="title">
            <h2>our gallery</h2>
        </div>
        <div class="some-foods container row">
            <div class="some-foods-item">
                <h2>Pan-fried Salmon</h2>
                <img src="../frontend/image/br1.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Vegetarian Salad </h2>
                <img src="../frontend/image/br2.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Chicken Breast Salad</h2>
                <img src="../frontend/image/br3.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Goose Breast</h2>
                <img src="../frontend/image/br4.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Dessert</h2>
                <img src="../frontend/image/br5.jpg" alt="">
            </div>
            <div class="some-foods-item">
                <h2>Vegetarian Sandwich</h2>
                <img src="../frontend/image/sandwich.jpg" alt="">
            </div>
        </div>
    </section>
    <!----------------------------------ROOM------------------------------------>
    <section id="room" class="room">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>Party Room</h2>
                </div>
            </div>
            <div class="row">
                <div class="room-items">
                    <img src="../frontend/image/room1.jpg" alt="">
                    <div class="room-items-text">
                        <h2>COUPLE</h2>
                        <p>Capacity 2-3 peoples,suitable for Couple</p>
                    </div>
                </div>
                <div class="room-items">
                    <img src="../frontend/image/family.jpg" alt="">
                    <div class="room-items-text">
                        <h2>FAMILY</h2>
                        <p>Capacity 8-10 peoples,suitable for Family</p>
                    </div>
                </div>
                <div class="room-items">
                    <img src="../frontend/image/vip2.jpg" alt="">
                    <div class="room-items-text">
                        <h2>VIP</h2>
                        <p>Capacity 10-15 peoples.Completely private room. Separate entrance. Private party menu options
                            available</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-----------------------------------------BOOKING---------------------------------------->
    <section id='booking' class="booking section-padding">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>booking</h2>
                </div>
            </div>
            <div class="booking-form">
                <form action="" method="post">
                    <h1>BOOKING FORM</h1>
                    <p>PLEASE FILL OUT ALL FIELDS. THANKS!</p>
                    <div class="row justify-content">
                        <div class="booking-form-item">
                        <label for="occasion" name="occasion"></label>
                        <p>Occasion</p>
                            <select id="occasion" name="occasion" required>
                                <option value="Occasion"> Occasion</option>
                                <option value="Birthday"> Birthday</option>
                                <option value="Wedding"> Wedding</option>
                                <option value="Wedding"> Wedding</option>
                            </select>
                        </div>
                        <div class="booking-form-item">
                            <p>Food name</p>
                            <input type="text" placeholder="Food" id="food_name" name="food_name" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Room you want to use<p>
                            <input type="text" placeholder="Room" id="loaiban" name="loaiban" required>
                        </div>
                        <div class="booking-form-item">
                             <p>Your name<p>
                            <input type="text" placeholder="Name" id="kh_name" name="kh_name" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Your number<p>
                            <input type="text" placeholder="Contact No." id="kh_phone" name="kh_phone" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Number of guests<p>
                            <input type="number" placeholder="Quantity" id="songuoi" name="songuoi" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Day you will come</p>
                            <input type="date" id="ngaythang" name="ngaythang" required>
                        </div>
                        <div class="booking-form-item">
                            <p>Time you wil come</p>
                            <input type="time" id="gio" name="gio" required>
                        </div>
                    </div>
                    <button type="submit" name="booking">SUBMIT</button>
                </form>
            </div>
        </div>
    </section>


    <!-----------------------------------------FOOTER---------------------------------------->

    <section id="contact" class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-item">
                    <h2>Address</h2>
                    <p>57 Nguyen Cuu Van, P17 <br> Q.Binh Thanh, TP HCM</p>
                </div>
                <div class="footer-item">
                    <h2>Opening Hours</h2>
                    <p>Monday - Saturday <br> 10:00 AM - 21:00 PM </p>
                    <p>Sunday <br> 10:00 AM - 22:00 PM </p>
                </div>
                <div class="footer-item">
                    <h2>Contact Us</h2>
                    <p><i class="fas fa-phone"></i> 0388314851 <br> <i class="far fa-envelope"></i>
                        nguyenkiencke@gmail.com</p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/trungkiennnnn/">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/kiennecacban/">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="footer-copyright">
                Copyright © 2021. All rights reserved.
            </div>
        </div>
    </section>

    <script src="./webscript.js"></script>
    <script>
        AOS.init();
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>