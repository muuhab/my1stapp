@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {{-- <form action="PostsController@store" method="POST" > --}}
        {{-- <form action="{{ route('posts.store') }}" method="POST"> --}}
        <form action="{{ action('PostsController@store') }}" method="POST" enctype="multipart/form-data"    >
            {{@csrf_field()}}
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input type="text" class="form-control" name="title" id="exampleFormControlInput1" >
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Body</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="3"></textarea>
          </div>
         <select name="category_id" class="form-control" id="">

            @foreach ($cat as $item)
         <option value="{{$item->id}}">{{$item->name}}</option>
                
            @endforeach
         </select>
         
          <div class=" form-group">
              <input type="file" name="cover_image">
          </div>
          
          <button type="submit" class="btn btn-dark">Submit</button>

   </form>
    
</div>

@endsection