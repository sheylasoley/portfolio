<?php
$project = get_project_by_id(get_the_ID());
?>

<main data-page="project">
    <section class="hero">
        <img class="image" src="<?= $project['image']['src'] ?>" alt="<?= $project['image']['alt'] ?>">
        <p class="preline">Project</p>
        <h1 class="title"><?= $project['title'] ?></h1>
    </section>
    <section class="content">
        <p class="lead"><?= $project['lead'] ?></p>
        <div class="text"><?= wpautop($project['text']) ?></div>
        <a class="back" href="<?= home_url('/#work') ?>">&larr; Zurück zu Work</a>
    </section>
</main>