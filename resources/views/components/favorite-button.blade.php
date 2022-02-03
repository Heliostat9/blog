@props(['method' => 'POST', 'id', 'action' => '/favorites', 'name' => 'post_id'])

<form action="{{$action}}" method="POST">
    @csrf
    @method($method)

    <input type="hidden" name="{{$name}}" value="{{$id}}">

    <button {{$attributes(['class' => 'mb-4 px-4 py-2  hover:transition-all rounded-xl text-white transition-all'])}}>
        {{$slot}}
    </button>
</form>
