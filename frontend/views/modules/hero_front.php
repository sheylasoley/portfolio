<?php
$data = $args['data'];
?>

<section id="hero" data-module="hero-front">
    <img class="image" src="<?= $data['image']['src'] ?>" alt="<?= $data['image']['alt'] ?>">
    <h1 class="title"><?= $data['title'] ?></h1>
    <p class="subtitle"><?= $data['subtitle'] ?></p>
</section>