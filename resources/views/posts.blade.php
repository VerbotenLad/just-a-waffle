<!DOCTYPE html>

<title>MY blog</title>
<link rel="stylesheet" href="/app.css">

<body>
    @foreach ($posts as $post)
        <article class="{{ $loop->even ? 'myMarginer' : '' }}">
            <h1>
                <a href="/posts/{{$post->getSlug()}}">
                    {{$post->title}}
                </a>

            </h1>

            <div>{{$post->excerpt}}
            </div>

        </article>
    @endforeach
</body>
