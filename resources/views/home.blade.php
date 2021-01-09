@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <a href="/posts/create" class="btn btn-primary">Create Post</a>
                   <h1> Your Blog Posts</h1>
                   @if (count($posts)>0)
                       
                   
                   <table class="table table-striped">
                        <tr>
                            <td> Title</th>
                            <th> </th>
                            <th> </th>
                        </tr>
                        @foreach ($posts as $post)
                        <tr>
                            <td> {{$post->title}}</td>
                        <td> <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a></td>
                            <td> <form action="{{ route('posts.destroy',$post->id) }}" method="Post" >
                                @csrf
                                {{-- <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Delete</a> --}}
                                <input type="submit" value="Delete" class="btn btn-danger">
                                <input name="_method" type="hidden" value="Delete">
                           
                            </form></td>
                            
                        </tr>
                        @endforeach
                        @else
                        <p> You Have No Posts</p>
                        @endif
                        


                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
