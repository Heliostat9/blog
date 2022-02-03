@props(['count'])

<div  {{$attributes(['class' => 'flex mt-2'])}}>
    <img src="/images/eye-solid.svg" class="block w-5 m-1">
    <p>{{$count}}</p>
</div>
