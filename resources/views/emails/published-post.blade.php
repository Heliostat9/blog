<!DOCTYPE html>
<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-blue-500 text-white rounded-xl p-4">
        <h1 class="">Published post: {{$post->title}}</h1>
        <p>
            <a href="http://localhost:8000/posts/{{$post->slug}}"
               class="inline-block my-4  px-5 py-2 bg-blue-400 rounded-xl">View post</a>
        </p>

        <p>Author: {{$post->author->name}}</p>

        <p class="text-justify mt-4">
            {{$post->excerpt}}
        </p>
    </div>
</body>
</html>
