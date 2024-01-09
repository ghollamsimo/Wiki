<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="/wiki/public/style/index.css">
</head>
<body>

<!-- header -->
<header>
   <?php include_once  '../../wiki/public/../include/navbar.php' ?>
    <div class = "banner">
        <div class = "contain">
            <h1 class = "banner-title">
                <span>Wiki</span> Blog
            </h1>
            <p>everything that you want to know about art & design</p>
            <form>
                <input type = "text" class = "search-input" placeholder="find your food . . .">
                <button type = "submit" class = "search-btn">
                    <i class = "fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>
<!-- end of header -->

<!-- blog -->
<section class = "blog" id = "blog">
    <div class = "contain">
        <div class = "title">
            <h2>Latest Blog</h2>
            <p>recent blogs about art & design</p>
        </div>

        <div class = "blog-content">
            <!-- item -->
            <?php
            $wikis = $data['wiki'];
            foreach ($wikis as $wiki) :
                ?>
            <div class = "blog-item">
                <div class = "blog-img">
                    <img src = "/wiki/public/../image/<?php $wiki->getImage() ?>" alt = "">
                </div>
                <div class = "blog-text">
                    <span><?php echo $wiki->getDate() ?></span>
                    <h2><?php echo $wiki->getTitle()?>></h2>
                    <p><?php echo $wiki->getDescreption()?>
                        <a  href = "#">Read More</a>
                    </p>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- end of blog -->


<!-- design -->
<section class="design" id="design">
    <div class="contain">
        <div class="title">
            <h2>Recent Arts & Designs</h2>
            <p>recent arts & designs on the blog</p>
        </div>

        <div class="design-content">
            <!-- item -->
            <div class="design-item">
                <div class="design-img">
                    <img src="/wiki/public/../image/art-design-5.jpg" alt="">
                </div>
                <div class="design-title">
                    <a href="#">make an awesome art portfolio for college or university</a>
                </div>
            </div>
            <!-- end of item -->
            <!-- item -->
            <div class="design-item">
                <div class="design-img">
                    <img src="images/art-design-2.jpg" alt="">
                </div>
                <div class="design-title">
                    <a href="#">make an awesome art portfolio for college or university</a>
                </div>
            </div>
            <!-- end of item -->
            <!-- item -->
            <div class="design-item">
                <div class="design-img">
                    <img src="images/art-design-3.jpg" alt="">
                </div>
                <div class="design-title">
                    <a href="#">make an awesome art portfolio for college or university</a>
                </div>
            </div>
            <!-- end of item -->
            <!-- item -->
            <div class="design-item">
                <div class="design-img">
                    <img src="images/art-design-4.jpg" alt="">
                </div>
                <div class="design-title">
                    <a href="#">make an awesome art portfolio for college or university</a>
                </div>
            </div>
            <!-- end of item -->
            <!-- item -->
            <div class="design-item">
                <div class="design-img">
                    <img src="images/art-design-5.jpg" alt="">
                </div>
                <div class="design-title">
                    <a href="#">make an awesome art portfolio for college or university</a>
                </div>
            </div>
            <!-- end of item -->
            <!-- item -->
            <div class="design-item">
                <div class="design-img">
                    <img src="images/art-design-6.jpg" alt="">
                </div>
                <div class="design-title">
                    <a href="#">make an awesome art portfolio for college or university</a>
                </div>
            </div>
            <!-- end of item -->
        </div>
    </div>
</section>
<!-- end of design -->


<!-- about -->
<section class = "about" id = "about">
    <div class = "container">
        <div class = "about-content">
            <div>
                <img src = "images/about-bg.jpg" alt = "">
            </div>
            <div class = "about-text">
                <div class = "title">
                    <h2>Catherine Doe</h2>
                    <p>art & design is my passion</p>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id totam voluptatem saepe eius ipsum nam provident sapiente, natus et vel eligendi laboriosam odit eos temporibus impedit veritatis ut, illo deserunt illum voluptate quis beatae quod. Necessitatibus provident dicta consectetur labore!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam corrupti natus, eos quia recusandae voluptatem veniam modi officiis minima provident rem sint porro fuga quos tempora ea suscipit vero velit sed laudantium eaque necessitatibus maxime!</p>
            </div>
        </div>
    </div>
</section>
<!-- end of about -->

<!-- footer -->
<?php include_once  '../../wiki/public/../include/footer.php' ?>
<!-- end of footer -->


</body>
</html>