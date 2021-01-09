@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <h3>Category Name: {{$post->categories->name}}</h3>

    <img src="/storage/cover_images/{{$post->cover_image}}" style="width: 100px">
    <div>
        <br>
        {{$post->body }}
    </div>
<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>

<br>
<a class="btn btn-success" href="/cart/{{$post->id}}">Add To Cart</a>
    <hr>
    @if (!Auth::guest())
    @if(Auth::user()->id==$post->user_id)
        
    
    <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
    <form action="{{ route('posts.destroy',$post->id) }}" method="Post" >
        @csrf
        {{-- <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Delete</a> --}}
        <input type="submit" value="Delete" class="btn btn-danger">
        <input name="_method" type="hidden" value="Delete">
   
    </form>
    @endif
    @endif
    
@endsection