<?php
$data = $args['data'];
$socials = get_globals_socials();
?>

<section id="contact" data-module="contact">
    <h2 class="title"><?= $data['title'] ?></h2>
    <p class="lead"><?= nl2br($data['lead']) ?></p>
    <div class="info">
        <div>
            <h3>Office</h3>
            <p><?= nl2br($data['address']) ?></p>
        </div>
        <div>
            <h3>Mobile</h3>
            <p><?= $data['phone'] ?></p>
        </div>
    </div>
    <h3>Socials</h3>
    <div class="socials">
        <?php foreach ($socials as $item) : ?>
            <a target="_blank" href="<?= $item['link'] ?>" aria-label="Link zu <?= $item['title'] ?>">
                <img src="<?= $item['icon']['src'] ?>" alt="<?= $item['icon']['alt'] ?>">
            </a>
        <?php endforeach; ?>
    </div>
</section>