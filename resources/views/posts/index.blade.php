<x-layout>
    @include('posts._posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            <x-posts-grid :posts="$posts" />

            {{$posts->links()}}
        @else
            <p>No posts yet. Please check back.</p>
        @endif
    </main>
</x-layout>
