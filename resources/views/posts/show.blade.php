<x-layout>
    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
        <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
            <img src="{{ $post->thumbnail  ? asset('/storage/' . $post->thumbnail) : '/images/illustration-1.png' }}" alt="" class="rounded-xl">

            <p class="mt-4 block text-gray-400 text-xs">
                Published <time>{{$post->created_at->diffForHumans()}}</time>
            </p>
            <x-views-count :count="$post->views_count" class="justify-center mt-4"/>
            <div class="flex items-center lg:justify-center text-sm mt-4">
                <img src="{{$post->author->avatar ? asset('/storage/' . $post->author->avatar) : '/images/lary-avatar.svg'}}" class="rounded-xl w-16" alt="Lary avatar">
                <div class="ml-3 text-left">
                    <h5 class="font-bold">
                        <a href="/?author={{$post->author->username}}">
                            {{$post->author->name}}
                        </a>
                    </h5>
                </div>

            </div>
            <div class="mt-4">
                @auth
                    @if($post->author->id != auth()->id())
                        <div>
                            @if($post->author->subscribes->contains('user_id', auth()->id()))
                                <x-favorite-button :method="'DELETE'" :name="'author_id'" :action="'/subscribe'" :id="$post->author->id" class="bg-gray-400 hover:bg-gray-500">Unfollow</x-favorite-button>
                            @else
                                <x-favorite-button :id="$post->author->id" :name="'author_id'" :action="'/subscribe'"  class="bg-blue-400 hover:bg-blue-500">Follow</x-favorite-button>
                            @endif
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <div class="col-span-8">
            <div class="hidden lg:flex justify-between mb-6">
                <a href="/"
                   class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>

                    Back to Posts
                </a>

                <div class="space-x-2">
                    <a href="/?category={{$post->category->slug}}"
                       class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                       style="font-size: 10px">{{$post->category->name}}</a>

                </div>
            </div>
            @auth
                <div>
                    @if($post->favorites->contains(auth()->id()))
                        <x-favorite-button :method="'DELETE'" :id="$post->id" class="bg-gray-400 hover:bg-gray-500">Unfavorite</x-favorite-button>
                    @else
                        <x-favorite-button :id="$post->id" class="bg-blue-400 hover:bg-blue-500">Favorite</x-favorite-button>
                    @endif
                </div>
            @endauth
            <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                {{$post->title}}
            </h1>

            <div class="space-y-4 lg:text-lg leading-loose">
                {!! $post->body !!}
            </div>

            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @include('posts._add-comment-form')

                @foreach($post->comments as $comment)
                    <x-post-comment :comment="$comment"/>
                @endforeach
            </section>
        </div>
    </article>
</x-layout>
