@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <?php $na=DB::table('categories')->select('name')->where('id',$id)->get(); ?>
    <h4>Category Name: @foreach ($na as $item)
        <span class="text-danger">{{$item->name}}</span> 
        
    @endforeach</h4>
    @if (count($cat) > 0 )
    @foreach ($cat as $post)
     <div class="card p-3 m-3 mb-3">
         <div class="row">
             <div class="col-4">
                 <img src="/storage/cover_images/{{$post->cover_image}}" style="width: 100px;">

                
             </div>
             <div class="col-4">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                {{-- <h3>{{$post->categories->name}}</h3> --}}
                <small>Writtem at {{$post->created_at}} by {{$post->user->name}}</small>
                <br>
                <a class="btn btn-success" href="/cart/{{$post->id}}">Add To Cart</a>


             </div>


         </div>

    
     </div>
        
    @endforeach
    {{-- {{$posts->links()}} --}}
    @else 
        <p>no posts found</p>
    @endif
@endsection