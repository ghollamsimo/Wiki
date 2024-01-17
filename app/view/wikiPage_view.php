<?php  include_once  '../../wiki/public/../include/navbar.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div id="show-data" class="container"></div>
<div id="main-data" class="container">
    <?php
    $wikis = $data['wiki'];
    foreach ($wikis as $wiki) : ?>
        <div class="card">
            <div class="card__header">
                <img class="h-[10rem]" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wiki->getImage()); ?>" alt="">
            </div>
            <div class="card__body">
                <span class="tag tag-blue"><?php echo $wiki->getNameCtaegory() ?></span>
                <h4><?php echo $wiki->getTitle() ?></h4>
                <p><?php echo substr($wiki->getDescreption(), 0, 120) ?>
                    <a class="font-extrabold text-blue-500" href="/wiki/public/home/Singlewiki/<?= $wiki->getId() ?>">Read More</a>
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

<script src="/wiki/public/../js/search.js"></script>
