<!DOCTYPE html>

<title>MY blog</title>
<link rel="stylesheet" href="/app.css">

<body>
    <?php foreach ($posts as $post) : ?>
        <article>
            <h1>
                <a href="/posts/<?= $post->getSlug()?>">
                    <?=$post->title?>
                </a>

            </h1>

            <div><?=$post->excerpt?></div>

        </article>
    <?php endforeach; ?>
</body>
