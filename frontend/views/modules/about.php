<?php
$data = $args['data'];
?>

<section id="about" data-module="about">
    <h2 class="title"><?= $data['title'] ?></h2>
    <img class="image" src="<?= $data['image']['src'] ?>" alt="<?= $data['image']['alt'] ?>">
    <div class="text"><?= wpautop($data['text']) ?></div>
</section>