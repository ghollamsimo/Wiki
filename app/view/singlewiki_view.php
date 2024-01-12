<link rel="stylesheet" href="/wiki/public/style/index.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


<?php include_once  '../../wiki/public/../include/navbar.php' ?>
<div class="max-w-screen-lg mx-auto">




    <main class="mt-10">
<?php  $wikis = $data['wiki'];
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
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="border-2 p-3 rounded bg-red-500 text-white">Delete</button>
                </div>
                <?php else: ?>
                <div class="flex"></div>
                <?php endif; ?>
                <?php endif; ?>
                <span class="py-2 text-green-700 inline-flex items-center justify-center mb-2">
                    Cryptocurrency
                </span>
            </div>

            <img src="/wiki/public/../image<?= $wikis->getImage() ?>" class="w-full object-cover lg:rounded" style="height: 28em;"/>
        </div>

        <div class="flex flex-col lg:flex-row lg:space-x-12">

            <div class="px-4 lg:px-0 mt-12 text-gray-700 text-lg leading-relaxed w-full lg:w-3/4">

                <div class="border-l-4 border-gray-500 pl-4 mb-6 italic rounded">
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



<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow ">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="popup-modal">
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
