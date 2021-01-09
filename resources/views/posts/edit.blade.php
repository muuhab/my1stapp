@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {{-- <form action="PostsController@store" method="POST" > --}}
        <form action="{{ route('posts.update',$post->id) }}" method="Post" enctype="multipart/form-data">
            {{-- {{@csrf_field()}} --}}
            @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input type="text" class="form-control" name= 'title' value="{{$post->title}}" id="exampleFormControlInput1" >
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Body</label>
            <textarea class="form-control" id="exampleFormControlTextarea1"  rows="3" name="body">{{$post->body }}</textarea>
          </div>
          <select name="category_id" class="form-control" id="">
            <?php $slec=$post->category_id ?>

            @foreach ($cat as $item)
         <option value="{{$item->id}}"   <?php if($slec==$item->id) { ?> selected <?php } ?> >{{$item->name}}</option>
                
            @endforeach
         </select>
          <div class=" form-group">
            <input type="file" name="cover_image">
            
        </div>
          <button type="submit" class="btn btn-dark">Submit</button>
          <input name="_method" type="hidden" value="PUT">

          

   </form>
    
</div>

@endsection