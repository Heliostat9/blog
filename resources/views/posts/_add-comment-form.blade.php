<x-panel>
    @auth
        <form action="/posts/{{$post->slug}}/comments" method="POST">
            @csrf

            <header class="flex items-center">
                <img src="{{auth()->user()->avatar ? asset('/storage/' . auth()->user()->avatar ) : '/images/lary-avatar.svg'}}"
                     alt=""
                     width="40"
                     height="40"
                     class="rounded-full">

                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <div class="mt-6">
                    <textarea
                        name="body"
                        class="w-full text-sm focus:outline-none focus:ring"
                        rows="5"
                        placeholder="Quick, thing of something to say!"
                        required></textarea>
            </div>

            @error('body')
                <p class="text-sm text-red-500">{{$message}}</p>
            @enderror

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    @else
        <p class="font-semibold">
            <a href="/register" class="hover:underline">Register</a> or
            <a href="/login" class="hover:underline">log in</a> to leave a comment.
        </p>
    @endauth
</x-panel>
