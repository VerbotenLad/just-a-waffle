<!DOCTYPE html>

<title>MY blog</title>
<link rel="stylesheet" href="/app.css">

<body>
    <article>
        <h1><?= $post->getTitle(); ?></h1>

        <div>
            {!! $post->getBody() !!}
        </div>
    </article>
    <a href="/">Go back</a>
</body>
