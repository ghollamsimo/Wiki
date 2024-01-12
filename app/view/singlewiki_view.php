<link rel="stylesheet" href="/wiki/public/style/index.css">

<?php include_once  '../../wiki/public/../include/navbar.php' ?>
<div class="max-w-screen-lg mx-auto">




    <main class="mt-10">
<?php  $wikis = $data['wiki'];
//die();
//foreach ($wikis as $wiki) :

?>
        <div class="mb-4 md:mb-0 w-full mx-auto relative">
            <div class="px-4 lg:px-0">
                <h2 class="text-4xl font-semibold text-gray-800 leading-tight">
                    <?= $wikis->getTitle()?>
                </h2>
                <span class="py-2 text-green-700 inline-flex items-center justify-center mb-2">
                    Cryptocurrency
                </span>
            </div>

            <img src="https://images.unsplash.com/photo-1587614387466-0a72ca909e16?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80" class="w-full object-cover lg:rounded" style="height: 28em;"/>
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

