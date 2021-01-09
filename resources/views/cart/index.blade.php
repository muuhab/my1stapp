@extends('layouts.app')
@section('content')
@if (Session::has('cart'))
<div class="container">
<div class="row">
    <div class="col-6">
        <ul class="list-group">
            @foreach ($post as $item)
            <li class="list-group-item">
                <strong>{{$item['item']['title']}}</strong>
                <span class="badge ">
                    {{$item['Qt']}}
                </span>
            </li>
                
            @endforeach
        </ul>
    </div>
</div>
</div>
    @else
    <div class="row">
        <div class="col-6">
            <h2>No Items in Cart</h2>
        </div>
    </div>
@endif
@endsection