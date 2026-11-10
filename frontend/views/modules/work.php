<?php
$data = $args['data'];
?>

<section id="work" data-module="work">
    <h2 class="title"><?= $data['title'] ?></h2>
    <div class="slider-wrap">
        <button class="arrow prev" aria-label="Zurück" data-slider-prev>&lsaquo;</button>
        <div class="slider" data-slider>
            <?php foreach ($data['projects'] as $project) : ?>
                <a class="card" href="<?= $project['url'] ?>">
                    <img class="image" src="<?= $project['image']['src'] ?>" alt="<?= $project['image']['alt'] ?>">
                    <div class="info">
                        <h3 class="card-title"><?= $project['title'] ?></h3>
                        <p class="card-description"><?= $project['description'] ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <button class="arrow next" aria-label="Weiter" data-slider-next>&rsaquo;</button>
    </div>
    <div class="dots" data-slider-dots></div>
</section>