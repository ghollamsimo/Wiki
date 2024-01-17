<?php
include_once '../../wiki/public/../include/navbar.php';
$categorey = $data['category'];
?>

<div class = "contain mt-10 category">
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
