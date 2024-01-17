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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>



<!-- header -->  <?php
$categories = $data['categories'];
$categorey = $data['category'];
include_once  '../../wiki/public/../include/navbar.php'
?>


<header>


    <div class = "banner">
        <div class = "contain">
            <h1 class = "banner-title">
                <span>Wiki</span> Blog
            </h1>
            <p>everything that you want to know about Evrething</p>

        </div>
    </div>
</header>
<!-- end of header -->

<!-- blog -->
<section>
    <div class="parent-title ml-20">
        <div class = "title">
            <h2>Latest Wikis</h2>
            <p>recent Wiki</p>
        </div>
        <?php if(isset($_SESSION['iduser'])):
            if ($_SESSION['role'] === 'Auteur'):
                ?>
                <input type="hidden" name="userid">
                <div class="btn">
                    <button class="original-button" data-modal-target="crud-modal" data-modal-toggle="crud-modal">Add New Wiki</button>
                </div>

            <?php endif; ?>
        <?php else: ?>
            <div></div>
        <?php endif;?>
    </div>
    <div id="show-data" class="container"></div>
    <div id="main-data" class="container"
    >
        <?php
        $wikis = $data['wiki'];

        foreach ($wikis as $wiki) :
            ?>
            <div class="card">
                <div class="card__header">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wiki->getImage()); ?>" alt="">
                </div>
                <div class="card__body">
                    <span class="tag tag-blue"><?php echo $wiki->getNameCtaegory() ?></span>
                    <h4><?php echo $wiki->getTitle() ?></h4>
                    <p><?php echo substr($wiki->getDescreption(), 0, 120) ?>
                        <a class="font-extrabold" href="/wiki/public/home/Singlewiki/<?= $wiki->getId() ?>">Read More</a>
                    </p>
                </div>
                <div class="card__footer">
                    <div class="user">
                        <div class="user__info">
                            <h5>Jane Doe</h5>
                            <small class="text-xs"><?php echo $wiki->getDate() ?> </small>
                            <input type="hidden" name="etat" value="<?= $wiki->getEtat() ?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>



<section class = "about" id = "about">
    <div class="title">
        <h2 class="text-center">Our Catgory</h2>
    </div>
    <div class = "contain category">
        <?php foreach ($categorey as $category): ?>
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow ">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 "><?= $category->getNameCategory() ?></h5>
                </a>
                <a href="/wiki/public/home/multiplewikis/<?= $category->getId() ?>" class="inline-flex items-center text-blue-600 hover:underline">
                    See our wikis
                    <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                    </svg>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- end of design -->


<!-- about -->




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
            <form class="p-4 md:p-5" method="post" enctype="multipart/form-data">

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
                    <div class="col-span-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                        <input type="text" name="title" id="name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type The Name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>

                        <select id="category" name="cat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                            <?php
                            foreach ($categories as $category) :
                                ?>
                                <option value="<?= $category->getId() ?>" selected=""><?php echo $category->getNameCategory(); ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>


                    <div class="col-span-2 sm:col-span-2">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Tag</label>
                        <?php foreach ($data['tag'] as $tag): ?>
                            <div>
                                <input type="checkbox" id="tag_<?php echo $tag->getIdTag(); ?>" name="tag[]" value="<?php echo $tag->getIdTag(); ?>">
                                <label for="tag_<?php echo $tag->getIdTag(); ?>"> <?php echo $tag->getNameTag(); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="col-span-8">
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

<?php include_once  '../../wiki/public/../include/footer.php' ?>

<script src="/wiki/public/../js/script.js"></script>
<script src="/wiki/public/../js/search.js"></script>
</body>
</html>