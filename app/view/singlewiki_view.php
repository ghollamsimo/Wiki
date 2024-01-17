<link rel="stylesheet" href="/wiki/public/style/index.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


<?php include_once  '../../wiki/public/../include/navbar.php' ?>
<div class="max-w-screen-lg mx-auto">




    <main class="mt-10">
<?php
$wikis = $data['wiki'];
$categories = $data['categories'];
$wikitag = $data['wikitag'];
?>
        <div class="mb-4 md:mb-0 w-full mx-auto relative">
            <div class="px-4 lg:px-0">
                <div class="flex justify-between">
                <h2 class="text-4xl font-semibold text-gray-800 leading-tight">
                    <?= $wikis->getTitle()?>
                </h2>
<?php if (isset($_SESSION['iduser'])):
        if ($_SESSION['role'] === 'Auteur'):
?>
                    <input type="hidden" name="idwiki" value="<?= $wikis->getId() ?>">
                    <button data-modal-target="popup-modal-<?= $wikis->getId() ?>" name="delete" data-modal-toggle="popup-modal-<?= $wikis->getId() ?>" class="border-2 p-3 rounded bg-red-500 text-white">Delete</button>
                    <button data-modal-target="crud-modal-<?= $wikis->getId()?>" name="edit" data-modal-toggle="crud-modal-<?= $wikis->getId()?>" class="border-2 p-3 rounded bg-green-500 text-white">Edite</button>
                </div>
                <?php else: ?>
                <div class="flex"></div>
                <?php endif; ?>
                <?php endif; ?>

                <span class="py-2 text-green-700 inline-flex items-center justify-center mb-2">
                    <?php echo '' . $wikis->getNameCtaegory()?>
                </span>


            </div>

            <img class="h-[30rem]" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wikis->getImage()); ?>" width="" alt="">
        </div>

        <div class="flex flex-col lg:flex-row lg:space-x-12">

            <div class="px-4 lg:px-0 mt-12 text-gray-700 text-lg leading-relaxed w-full lg:w-3/4">

                <div class="border-l-4 border-gray-500 pl-4 mb-6  rounded">
                 <?= $wikis->getDescreption() ?>
                </div>



            </div>

            <div class="w-full lg:w-1/4 m-auto mt-12 max-w-screen-sm">
                <div class="p-4 border-t border-b md:border md:rounded">
                    <div class="flex py-2">
                        <img src="https://randomuser.me/api/portraits/men/97.jpg"
                             class="h-10 w-10 rounded-full mr-2 object-cover" />
                        <div>
                            <p class="font-semibold text-gray-700 text-sm"> By <?php echo $_SESSION['Nom']; ?> </p>
                            <p class="font-semibold text-gray-600 text-xs"> Editor </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php //endforeach;?>
    </main>
</div>

    <?php include_once  '../../wiki/public/../include/footer.php' ?>



<div id="popup-modal-<?= $wikis->getId() ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow ">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="popup-modal-<?= $wikis->getId() ?>">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                <div class="flex justify-center">
                <form method="post" >
                    <input type="hidden" name="idwiki" value="<?= $wikis->getId() ?>">
                    <button data-modal-hide="popup-modal" name="delete" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Yes, I'm sure
                    </button>
                </form>
                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>





<div id="crud-modal-<?= $wikis->getId()?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Edite Wiki
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="crud-modal-<?= $wikis->getId()?>">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idwiki">

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
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Tags</label>
                        <?php foreach ($data['tag'] as $tag): ?>
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="tag_<?php echo $tag->getIdTag(); ?>" name="tag[]" value="<?php echo $tag->getIdTag(); ?>" class="mr-2">
                                <label for="tag_<?php echo $tag->getIdTag(); ?>"><?php echo $tag->getNameTag(); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>


                    <div class="col-span-8">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Wiki Description</label>
                        <textarea id="description" name="desc" rows="9" class="block p-2.5 w-full text-sm text-gray-900  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write product description here"></textarea>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $wikis->getId() ?>">
                <input type="hidden" name="etat" value="<?= $wikis->getEtat() ?>">
                <button type="submit" name="edit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Edit Wiki
                </button>
            </form>
        </div>
    </div>
</div>
