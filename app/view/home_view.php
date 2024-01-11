<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font awesome icon -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="/wiki/public/style/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

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
            <p>everything that you want to know about Evrething</p>
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
        <div class="parent-title">
        <div class = "title">
            <h2>Latest Wikis</h2>
            <p>recent Wiki</p>
        </div>

            <div class="btn">
                <button class="original-button" data-modal-target="crud-modal" data-modal-toggle="crud-modal">Add New Wiki</button>
            </div>
        </div>

        <div class = "blog-content">
            <!-- item -->
            <?php
            $wikis = $data['wiki'];
            foreach ($wikis as $wiki) :
                ?>
            <div class = "blog-item">
                <div class = "blog-img">
                    <img src="/wiki/public/../image/<?php echo $wiki->getImage(); ?>" alt="">
                </div>
                <div class = "blog-text">
                    <span><?php echo $wiki->getDate() ?></span>
                    <h2><?php echo $wiki->getTitle()?>></h2>
                    <p><?php echo $wiki->getDescreption()?>
                        <a  href = "/wiki/public/home/Singlewiki/<?= $wiki->getId() ?>">Read More</a>
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
                <img src = "/wiki/public/../image/about-bg.jpg" alt = "">
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




<!-- Modal toggle -->


<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Create New Wiki
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="post">


                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-fit border-2 border-gray-300 border-dashed rounded-lg cursor-pointer ">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" name="img" type="file" class="hidden"/>
                    </label>
                </div>


                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                        <input type="text" name="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Tag</label>
                            <select name="tag" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="">Select Tag</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>

                        <select id="category" name="cat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                            <?php
                            $categories = $data['category'];
                            foreach ($categories as $category) :
                                ?>
                                <option selected=""><?php echo $category->getCategory(); ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Wiki Description</label>
                        <textarea id="description" name="desc" rows="9" class="block p-2.5 w-full text-sm text-gray-900  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write product description here"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new Wiki
                </button>
            </form>
        </div>
    </div>
</div>

<!-- end of about -->

<!-- footer -->
<?php include_once  '../../wiki/public/../include/footer.php' ?>
<!-- end of footer -->


</body>
</html>