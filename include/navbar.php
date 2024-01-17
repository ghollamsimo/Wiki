<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
<link rel="stylesheet" href="/wiki/public/style/index.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


<nav class = "navbar w-full">
    <div class = "contain">
        <a href = "/wiki/public/home" class = "navbar-brand">Wiki</a>
        <div class = "navbar-nav">
            <a href = "/wiki/public/home">home</a>
            <a href = "/wiki/public/home/wikis">Wiki</a>
            <a href = "/wiki/public/home/categories">Category</a>
        </div>
        <form id="search-form" method="post">
            <input type = "text" class = "text-black border-2 search-input rounded p-5" name="nom" id="getname" placeholder="find your Special Wiki . . .">
        </form>
        <div>
            <?php if (isset($_SESSION['iduser'])):
                if ($_SESSION['role'] === 'Auteur'):
            ?>
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = ! dropdownOpen"
                        class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                    <img class="object-cover w-full h-full"
                         src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80"
                         alt="Your avatar">
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"
                     style="display: none;"></div>

                <div x-show="dropdownOpen"
                     class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                     style="display: none;">
                    <a href="/wiki/public/home/logout"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                </div>
            </div>
            <?php endif;?>
            <?php else: ?>
            <form action="/wiki/public/home/login">
            <button class="original-button">Login</button>
            </form>
            <?php endif; ?>


        </div>
    </div>
</nav>

<script src="/wiki/public/../js/search.js"></script>


